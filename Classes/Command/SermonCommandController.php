<?php

/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @author Christoph Fischer <chris@toph.de>
 * @date 2016-06-04
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace TYPO3\VmfdsSermons\Command;

class SermonCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController
{

    /**
     * configurationManager
     * @var TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;

    /**
     * objectManager
     * @var TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * sermonRepository
     * @var TYPO3\VmfdsSermons\Domain\Repository\SermonRepository
     * @inject
     */
    protected $sermonRepository;

    /**
     * feedRepository
     * @var TYPO3\VmfdsSermons\Domain\Repository\FeedRepository
     * @inject
     */
    protected $feedRepository;

    /**
     * dataMapper
     * @var TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper
     * @inject
     */
    protected $dataMapper;

    /**
     * persistenceManager
     * @var TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    /**
     * Settings for this context
     * @var array
     */
    protected $settings = array();

    /**
     * Initialize the controller.
     * @return void
     */
    protected function initializeCommand()
    {
        $this->settings = $this->configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Vmfdssermons', 'Main'
        );

        $this->feedRepository = $this->objectManager->get(\TYPO3\VmfdsSermons\Domain\Repository\FeedRepository::class);
        $this->sermonRepository = $this->objectManager->get(\TYPO3\VmfdsSermons\Domain\Repository\SermonRepository::class);
        $this->dataMapper = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper::class);
        $this->persistenceManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
    }

    /**
     * command import
     * Updates all existing sermon feeds, importing new sermons as necessary
     *
     * This will retrieve each feed url, check which sermons are already present locally
     * and insert the others in the local database.
     *
     * @return void
     */
    public function importCommand()
    {
        // get settings
        $this->initializeCommand();
        //$this->console('Settings: ' . print_r($this->settings, 1));

        // here is the processing
        $feeds = $this->feedRepository->findAll();

        $this->console(count($feeds) . ' feeds found.');
        foreach ($feeds as $feed) {
            $this->console('Fetching feed "' . $feed->getTitle() . '" from ' . $feed->getUrl() . '... ', false);
            $rawData = file_get_contents($feed->getUrl());
            $data = json_decode($rawData, true);
            $this->console('OK');
            if (is_array($data['sermons'])) {
                $this->console(count($data['sermons']) . ' records received.');
                foreach ($data['sermons'] as $rec) {
                    // forget foreign syncuid
                    unset($rec['syncuid']);
                    // switch audiorecording to remoteAudio
                    if ($rec['sermon']['remoteAudio'] == '') {
                        $rec['sermon']['remoteAudio'] = $rec['sermon']['audiorecording'];
                        unset($rec['sermon']['audiorecording']);
                    }
                    $rec['sermon']['preached'] = $rec['preached']['date'];
                    $date = new \DateTime($rec['sermon']['preached']);
                    $this->console('------------------------------------------------------------------------------------------------------');
                    $this->console('Sermon "' . $rec['sermon']['title'] . '"');
                    $this->console('--> Preached: '.$date->format('Y-m-d'));
                    $sermon = $this->mapSermon($rec['sermon'], $feed, $rec['url'], $date);
                }
            }
        }
        $this->console('------------------------------------------------------------------------------------------------------');
        $this->console('Persisting all records.');

        $this->persistenceManager->persistAll();
    }

    /**
     * Map an array to a sermon object
     * @param array $s Associative array with the data
     * @param TYPO3\VmfdsSermons\Domain\Model\Feed $feed Feed object
     * @param \string $remoteUrl Remote url
     * @param \DateTime $date Sermon date
     * @return TYPO3\VmfdsSermons\Domain\Model\Sermon Sermon object
     */
    protected function mapSermon($s, $feed, $remoteUrl, $date)
    {
        $uid = parse_url($feed->getUrl(), PHP_URL_HOST) . ':' . $s['uid'];

        // check if we've already got that uid:
        $existing = $this->sermonRepository->checkSyncuid($uid);
        if (!$existing) {
            $sermon = $this->objectManager->get(\TYPO3\VmfdsSermons\Domain\Model\Sermon::class);
            $this->console('--> This is a new sermon.');
        } else {
            $sermon = $this->sermonRepository->findBySyncuid($uid);
            $this->console('--> Sermon already exists with uid '.$uid);
        }
        $sermon->setSyncuid($uid);
        $sermon->setChurch($feed->getChurch());
        $sermon->setChurchUrl($feed->getChurchUrl());
        $sermon->setRemoteUrl($remoteUrl);
        $changed = false;

        $sermon->setPreached($date);
        $filename = $date->format('Ymd');

        foreach ($s as $key => $val) {
            if (trim($val)) {
                $setter = 'set' . ucfirst($key);
                $getter = 'get' . ucfirst($key);
                // treat special cases first
                switch ($key) {
                    case 'uid':
                        break;
                    case 'pid':
                        if ($sermon->getPid() !== $this->settings['storagePid']) {
                            $changed = true;
                            $sermon->setPid($this->settings['storagePid']);
                        }
                        break;
                    case 'preached':
                        break;
                    case 'image':
                        if ($val)
                            if (basename($sermon->$getter()) !== basename($val)) {
                                $changed = true;
                                $sermon->$setter($this->retrieveFile($val, $key));
                            }
                        break;
                    case 'handout':
                        if ($val) {
                            if ($sermon->$getter() == '') {
                                $changed = true;
                                $sermon->$setter($this->retrieveFile($val, $key, $filename . '_Begleitzettel.pdf'));
                            }
                        }
                        break;
                    case 'audiorecording':
                        $this->console('--> Trying to set audio to "'.$val.'"');
                        if (trim($val)) {
                            if ($sermon->$getter() != $val) {
                                $changed = true;
                                $sermon->$setter($val);
                            }
                        }
                    default:
                        if (method_exists($sermon, $setter)) {
                            if (trim($val)) {
                                if ($sermon->$getter() !== $val) {
                                    $changed = true;
                                    $sermon->$setter($val);
                                }
                            }
                        }
                }
            }
        }
        if ($existing) {
            if ($changed) {
                $this->sermonRepository->update($sermon);
                $this->console('--> Sermon updated.');
            } else {
                $this->console('--> Sermon skipped.');
            }
        } else {
            $this->sermonRepository->add($sermon);
            $this->console('--> Sermon added.');
        }
        $this->persistenceManager->persistAll();
        return $sermon;
    }

    /**
     * Write a text to the console
     * @param string $text Text
     * @param bool $newline Add line feed?
     * @return void
     */
    protected function console($text, $newline = true)
    {
        echo $text . ($newline ? "\r\n" : '');
    }

    /**
     * Retrieve a file from a remote url
     * @param string $url Url
     * @param string $key The field this file is used for
     * @param string $target Optional new file name
     * @return string File name
     */
    protected function retrieveFile($url, $key, $target = '')
    {
        if ($url) {
            $baseName = $target ? $target : basename($url);
            if ($key == 'handout')
                $baseName = str_replace('.html', '.pdf', $baseName);
            $target = $this->settings['paths'][$key] . $baseName;
            if (!file_exists(PATH_site . $target)) {
                $this->console('--> Retrieving ' . $key . ' from ' . $url . ' -> ', false);
                $this->console($target . ' ... ', false);
                try {
                    $data = file_get_contents($url);
                    $fp = fopen(PATH_site . $target, 'w');
                    fwrite($fp, $data);
                    fclose($fp);
                    $this->console('OK');
                } catch (\Exception $e) {
                    $this->console('Failed');
                }
            }
            return $baseName;
        } else {
            return '';
        }
    }

}
