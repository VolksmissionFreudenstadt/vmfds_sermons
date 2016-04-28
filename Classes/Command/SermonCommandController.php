<?php

namespace TYPO3\VmfdsSermons\Command;

class SermonCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController
{

    /**
     * @var TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;

    /**
     *
     * @var TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     *
     * @var TYPO3\VmfdsSermons\Domain\Repository\SermonRepository
     * @inject
     */
    protected $sermonRepository;

    /**
     *
     * @var TYPO3\VmfdsSermons\Domain\Repository\FeedRepository
     * @inject
     */
    protected $feedRepository;

    /**
     *
     * @var TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper
     * @inject
     */
    protected $dataMapper;

    /**
     * The settings.
     * @var array
     */
    protected $settings = array();

    /**
     * Initialize the controller.
     *
     */
    protected function initializeCommand()
    {
        $this->settings = $this->configurationManager->getConfiguration(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Vmfdssermons', 'Main'
        );

        $this->feedRepository = $this->objectManager->get(\TYPO3\VmfdsSermons\Domain\Repository\FeedRepository::class);
        $this->sermonRepository = $this->objectManager->get(\TYPO3\VmfdsSermons\Domain\Repository\SermonRepository::class);
        $this->dataMapper = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper::class);
    }

    /**
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
        $this->console('Settings: ' . print_r($this->settings, 1));

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
                    // switch audiorecording to remoteAudio
                    if ($rec['sermon']['remoteAudio'] == '') {
                        $rec['sermon']['remoteAudio'] = $rec['sermon']['audiorecording'];
                        unset($rec['sermon']['audiorecording']);
                    }
                    $rec['sermon']['preached'] = $rec['preached']['date'];
                    $date = new \DateTime($rec['sermon']['preached']);
                    $this->console('Sermon "' . $rec['sermon']['title'] . '" (' . $date->format('Y-m-d') . ') ... ', false);
                    $sermon = $this->mapSermon($rec['sermon'], $feed, $rec['url']);
                }
            }
        }
        echo "Persisting ... \r\n";
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
        $persistenceManager->persistAll();
    }

    /**
     * Map an array to a sermon object
     * @param array $s Associative array with the data
     * @param TYPO3\VmfdsSermons\Domain\Model\Feed $feed Feed object
     * @param \string $remoteUrl Remote url
     * @return TYPO3\VmfdsSermons\Domain\Model\Sermon Sermon object
     */
    protected function mapSermon($s, $feed, $remoteUrl)
    {
        //$uid = $feed->getUid().sprintf('%04d', $s['uid']);
        $uid = parse_url($feed->getUrl(), PHP_URL_HOST) . ':' . $s['uid'];

        // check if we've already got that uid:
        $sermon = $this->sermonRepository->findBySyncuid($uid);
        $existing = !is_null($sermon);
        if (!$existing)
            $sermon = $this->objectManager->get(\TYPO3\VmfdsSermons\Domain\Model\Sermon::class);
        $sermon->setSyncuid($uid);
        $sermon->setChurch($feed->getChurch());
        $sermon->setChurchUrl($feed->getChurchUrl());
        $sermon->setRemoteUrl($remoteUrl);

        foreach ($s as $key => $val) {
            if (trim($val)) {
                $setter = 'set' . ucfirst($key);
                // treat special cases first
                switch ($key) {
                    case 'uid':
                        break;
                    case 'pid':
                        $sermon->setPid($this->settings['storagePid']);
                        break;
                    case 'preached':
                        if ($val)
                            $sermon->setPreached(new \DateTime($val));
                        break;
                    case 'image':
                    case 'handout':
                        if ($val)
                            $sermon->$setter($this->retrieveFile($val, $key));
                        break;
                    default:
                        if (method_exists($sermon, $setter)) {
                            if ($val)
                                $sermon->$setter($val);
                        }
                }
            }
        }
        if ($existing) {
            $this->sermonRepository->update($sermon);
            console('Updated');
        } else {
            $this->sermonRepository->add($sermon);
            console('OK');
        }

        return $sermon;
    }

    protected function console($text, $newline = true)
    {
        echo $text . ($newline ? "\r\n" : '');
    }

    protected function retrieveFile($url, $key)
    {
        if ($url) {
            $baseName = basename($url);
            if ($key == 'handout')
                $baseName = str_replace('.html', '.pdf', $baseName);
            $target = $this->settings['paths'][$key] . $baseName;
            if (!file_exists(PATH_site . $target)) {
                $this->console('Retrieving ' . $key . ' from ' . $url . ' ... ');
                $this->console('writing to ' . $target . ' ... ', false);
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
