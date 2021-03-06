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

namespace TYPO3\VmfdsSermons\Controller;

class SermonController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Supported media types
     * @var array
     */
    protected $supportedMediaTypes = array('text/html', 'application/json');

    /**
     * Upload utility class
     * @var \TYPO3\VmfdsSermons\Utility\UploadUtility
     * @inject
     */
    protected $uploadUtility;

    /**
     * Map view format to object name
     * @var array
     */
    protected $viewFormatToObjectNameMap = array('json' => 'TYPO3\CMS\Extbase\Mvc\View\JsonView');

    /**
     * sermonRepository
     * @var \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository
     * @inject
     */
    protected $sermonRepository;

    /**
     * seriesRepository
     * @var \TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository
     * @inject
     */
    protected $seriesRepository;

    /**
     * preacherRepository
     * @var \TYPO3\VmfdsSermons\Domain\Repository\PreacherRepository
     * @inject
     */
    protected $preacherRepository;

    /**
     * inject the SeriesRepository object
     * @param \TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository $seriesRepository
     * @return void
     */
    public function injectSeriesRepository(\TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
    }

    /**
     * initialize action
     */
    public function initializeAction()
    {
        if ($this->arguments->hasArgument('sermon')) {
            $this->arguments->getArgument('sermon')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('image', 'array');
        }
    }

    /**
     * action list
     * Display a list of sermons
     * @return void
     */
    public function listAction()
    {
        if (intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('sermon')) > 0)
            $this->forward('show');
        if (intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('sermon_preview')) > 0)
            $this->forward('show');

        $this->sermonRepository->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
        $sermons = $this->sermonRepository->findAll();
        $this->view->assign('sermons', $sermons);
    }

    /**
     * action show
     * Show details for a single sermon
     * @param \TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon
     * @return void
     */
    public function showAction(\TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon = NULL)
    {
        // permit preview of hidden records?
        $sneakForward = FALSE;
        if (is_null($sermon)) {
            if ((int) $this->settings['singleSermon'] > 0)
                $previewSermonId = $this->settings['singleSermon'];
            elseif ($this->request->hasArgument('sermon'))
                $previewSermonId = $this->request->getArgument('sermon');
            elseif ($this->request->hasArgument('sermon_preview'))
                $previewSermonId = $this->request->getArgument('sermon_preview');
            else
                $this->forward('list');

            $sermon = $this->sermonRepository->findByUid($previewSermonId, FALSE);

            if (is_null($sermon))
                $this->forward('list');

            $isPreview = TRUE;

            // check if this is still a sneak preview?
            if ($sermon->getPreached()->format('U') <= time()) {
                $sneakForward = TRUE;
            }
        } else {
            $isPreview = FALSE;
        }


        if ($this->settings['setPageTitle']) {
            // meta data
            $GLOBALS['TSFE']->page['title'] = $sermon->getTitle() . ($isPreview ? ' (Vorschau)' : '');
            $GLOBALS['TSFE']->page['description'] = $sermon->getDescription();
            $GLOBALS['TSFE']->indexedDocTitle = $sermon->getTitle() . ($isPreview ? ' (Vorschau)' : '');
        }

        // get related by series
        $mySeries = $sermon->getSeries();
        if ($mySeries->count()) {
            $mySeries->rewind();
            $relatedBySeries = $this->sermonRepository->findBySeries($mySeries->current(), 16);
        }

        // get related by preacher
        $myPreacher = $sermon->getPreacher();
        if ($myPreacher->count()) {
            $myPreacher->rewind();
            $relatedByPreacher = $this->sermonRepository->findByPreacher($myPreacher->current(), 16);
        }

        // calculate week start and end (for bulletin, etc);
        $weekStartReal = $sermon->getPreached()->format('U');
        if (strftime('%w', $weekStartReal) != 0)
            $weekStartReal = strtotime('last Sunday', $weekStartReal);
        // set to 10:59:
        $weekStart = mktime(10, 59, 0, strftime('%m', $weekStartReal), strftime('%d', $weekStartReal), strftime('%Y', $weekStartReal));
        $weekEnd = strtotime('23:59:00', strtotime('+7 days', $weekStart));
        $weekEndSat = strtotime('23:59:00', strtotime('+6 days', $weekStart));

        // pass it all to the view
        $this->view->assign('relatedBySeries', $relatedBySeries);
        $this->view->assign('relatedByPreacher', $relatedByPreacher);
        $this->view->assign('sermon', $sermon);
        $this->view->assign('weekStart', $weekStart);
        $this->view->assign('weekStartReal', $weekStartReal);
        $this->view->assign('weekEnd', $weekEnd);
        $this->view->assign('weekEndSat', $weekEndSat);
        $this->view->assign('sneakForward', $sneakForward);

        // JSON:
        if ($this->request->getFormat() == 'json') {
            $this->view->setVariablesToRender(array('sermon'));
            $this->view->setConfiguration = (array('sermon', array()));
        }
    }

    /**
     * action byLatestSeries
     * List sermons from latest series
     * @return void
     */
    public function byLatestSeriesAction()
    {
        // get latest series
        $series = $this->seriesRepository->findLatest(1);

        if (!is_null($series)) {
            // find sermons belonging to this series
            $sermons = $this->sermonRepository->findBySeries($series);
            $this->view->assign('series', $series);
            $this->view->assign('sermons', $sermons);
        }
    }

    /**
     * action previewNext
     * Display the next sermon on preview
     * @return void
     */
    public function previewNextAction()
    {

        $sermon = $this->sermonRepository->findNextPreview();
        if ($sermon)
            $this->showAction($sermon);
        else
            return '';
    }

    /**
     * action showLatest
     * Display a single sermon: the latest one
     * @return void
     */
    public function showLatestAction()
    {

        $sermon = $this->sermonRepository->findLatest();
        $this->showAction($sermon);
    }

    /**
     * action audioUploadWelcome
     * Display a form for sermon audio upload
     * @return void
     */
    public function audioUploadWelcomeAction()
    {
        $this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="'
                . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath($this->request->getControllerExtensionKey())
                . 'Resources/Public/Styles/uploadfile.min.css" />');

        $sermons = $this->sermonRepository->findAllWithoutAudio();
        $this->view->assign('sermons', $sermons);
    }

    /**
     * action audioUploadDone
     * Handle uploaded audio
     * @return void
     */
    public function audioUploadDoneAction()
    {

        $fp = fopen('debug-upload.txt', 'w');
        fwrite($fp, print_r($_FILES, 1));
        fwrite($fp, print_r($this->settings, 1));

        if ($this->request->hasArgument('sermon')) {
            $sermon = $this->sermonRepository->findByUid($this->request->getArgument('sermon'));
        }

        fwrite($fp, print_r($sermon, 1));

        $file = $this->request->getArgument('audiorecording');
        fwrite($fp, print_r($file, 1));
        if (!$file['error']) {
            $uploadFolder = PATH_site . $this->settings['uploadFolder'] . '/';
            $destFile = $uploadFolder . $file['name'];
	        fwrite($fp, 'Source: '.$file['tmp_name'].PHP_EOL);
            fwrite($fp, 'Destination: '.$destFile.PHP_EOL);
            move_uploaded_file($file['tmp_name'], $destFile);
	        fwrite($fp, 'Moved'.PHP_EOL);

            // get preachers
            $p = array();
            foreach ($sermon->getPreacher() as $preacher) {
                $p[] = $preacher->getFirstName() . ' ' . $preacher->getLastName();
            }
            $preacher = join(', ', $p);
	        fwrite($fp, 'Preacher: '.$preacher.PHP_EOL);

            // get series
            $s = array();
            foreach ($sermon->getSeries() as $series) {
                $s[] = $series->getTitle();
            }
            $series = join(', ', $s);
	        fwrite($fp, 'Series: '.$series.PHP_EOL);

            // id3 tagging
            id3_set_tag($destFile, array(
                'title' => $sermon->getTitle(),
                'artist' => $preacher,
                'album' => $series,
                'year' => strftime('%Y', $sermon->getPreached()->getTimestamp()),
                'comment' => 'Predigt vom ' . strftime('%d.%m.%Y', $sermon->getPreached()->getTimestamp()),
                'track' => 1,
            ));
	        fwrite($fp, 'Set ID3 tag'.PHP_EOL);

            // add file to sermon record
            $sermon->setAudiorecording('predigten/Aufnahmen/' . $file['name']);
	        fwrite($fp, 'Set audiorecording.'.PHP_EOL);

            // persist the changes
            $this->sermonRepository->update($sermon);
	        fwrite($fp, 'Persisted.'.PHP_EOL);
        }
	    fclose($fp);
    }

    /**
     * action ajax
     * Return sermon details for AJAX
     * @param \TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon
     * @return void
     */
    public function ajaxAction(\TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon = NULL)
    {
        $this->assign('sermon', $sermon);
    }

    /**
     * action byDate
     * Display a single sermon by date
     * @return void
     */
    public function byDateAction()
    {
        $date = NULL;
        $sermons = [];
        $isFuture = FALSE;

        if ($this->request->hasArgument('date')) {
            $date = new \DateTime($this->request->getArgument('date'));
        }

        if (!is_null($date)) {
            $isFuture = ($date->getTimestamp() > time());
            $this->view->assign('isFuture', $isFuture);
            $sermons = $this->sermonRepository->findByPreached($date);
        }

        $this->view->assign('sermons', $sermons);

        // JSON:
        if ($this->request->getFormat() == 'json') {
            $this->view->setVariablesToRender(array('sermons'));
            $this->view->setConfiguration = (array('sermons', array()));
        }
    }

    /**
     * action presentation
     * Create a powerpoint presentation for a single sermon
     *
     * Note that this action outputs to a PHP-based view
     * @see Classes/View/Sermon/Presentation.php
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon
     */
    function presentationAction(\TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon)
    {
        $this->view->assign('sermon', $sermon);
    }

    /**
     * action edit
     * Show the edit form for a sermon
     * @param \TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon
     * @return void
     */
    public function editAction(\TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon = NULL)
    {
        $this->view->assign('sermon', $sermon);
        if (is_null($sermon)) {
            if ($this->request->hasArgument('sermon')) {
                $previewSermonId = $this->request->getArgument('sermon');
                $sermon = $this->sermonRepository->findByUid($previewSermonId, FALSE);
            }
        }
        $this->view->assign('sermon', $sermon);

        if ($this->request->hasArgument('preacher')) {
            $preacher = $this->preacherRepository->findByUid($this->request->getArgument('preacher'));
            $this->view->assign('preacher', $preacher);
        }
    }

    /**
     * action update
     * Update a sermon record
     * @param \TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon
     * @return void
     */
    public function updateAction(\TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon)
    {
        $formData = $this->request->getArgument('sermon');
        $imageField = $formData['image'];
        if ($imageField['name']) {
            $fileName = $this->uploadUtility->uploadFile($imageField, 'tx_vmfdssermons_domain_model_sermon', 'image');
            $sermon->setImage($fileName);
        } else {
        	if ($this->request->hasArgument('oldimage')) {
		        $oldImage = $this->request->getArgument('oldImage');
		        $sermon->setImage($oldImage);
	        }
        }

        $this->sermonRepository->update($sermon);

        if ($this->request->hasArgument('preacher')) {
            $preacher = $this->preacherRepository->findByUid($this->request->getArgument('preacher'));
            $service = [];
            if ($this->request->hasArgument('service')) {
                $service = $this->request->getArgument('service');
                $preacher->setMic($service['mic']);
                $preacher->setPulpit($service['pulpit']);
                $preacher->setPpt($service['ppt']);
                $preacher->setLaptop($service['laptop']);
            }
            $fee = [];
            if ($this->request->hasArgument('fee')) {
                $fee = $this->request->getArgument('fee');
                $preacher->setTravelCost($fee['amount']);
                $preacher->setAccountHolder($fee['accountHolder']);
                $preacher->setIban($fee['iban']);
                $preacher->setBic($fee['bic']);
            }
            $this->preacherRepository->update($preacher);

            $recipients = $this->settings['preacher']['editNotifyMail']['recipients'];
            if ($preacherEMail = $preacher->getEmail()) {
                $recipients[$preacherEMail] = $preacher->getName();
            }

            $attachments = [];
            if ($img = $preacher->getImage()) {
                $attachments[] = PATH_site . 'uploads/tx_vmfdssermons/' . $img;
            }
            if ($img = $sermon->getImage()) {
                $attachments[] = PATH_site . 'predigten/Titelbilder/' . $img;
            }

            $subject = $sermon->getTitle() . ' (' . $sermon->getPreached()->format('d.m.Y') . ', ' . $preacher->getName() . ')';

            $vars = [
                'sermon' => $sermon,
                'preacher' => $preacher,
                'service' => $service,
                'fee' => $fee
            ];

            // send notification email
            $this->sendTemplateEmail($recipients, [
                $this->settings['preacher']['editNotifyMail']['sender']['email'] => $this->settings['preacher']['editNotifyMail']['sender']['name']
                    ], $subject, 'GuestPreacherSubmittedSermon', $vars, $attachments
            );
        }
        if ($this->request->hasArgument('forward')) {
        	$this->forward($this->request->getArgument('forward'));
        }
    }

    /**
     * Send an E-mail created by rendering a stand-alone Fluid view
     * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
     * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
     * @param string $subject subject of the email
     * @param string $templateName template name (UpperCamelCase)
     * @param array $variables variables to be passed to the Fluid view
     * @return boolean TRUE on success, otherwise false
     */
    protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array(), array $attachments = [])
    {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
        $emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
        $templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        $emailBody = $emailView->render();

        /** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
        $message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $message->setTo($recipient)
                ->setFrom($sender)
                ->setSubject($subject);

        foreach ($attachments as $attachment) {
            $message->attach(\Swift_Attachment::fromPath($attachment));
        }

        // HTML Email
        $message->setBody($emailBody, 'text/html');

        $message->send();
        return $message->isSent();
    }

    /**
     * action gitHubExport
     * Export a single sermon to GitHub
     *
     * If a repository doesn't already exist, it will be created.
     * Right now, an existing repository will be overwritten.
     * @todo Allow updating existing repository
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon
     *
     * Note: The view for this action is rendered internally and never displayed.
     * The action will forward the user to GitHub at the end and will return an
     * empty string to the TYPO3 rendering engine.
     * Note: Forwarding might take place before the commits are completely pushed.
     * If you see an empty repository, wait a few seconds and refresh.
     * @return string
     */
    function gitHubExportAction(\TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon)
    {
        $gitHubConfig = $this->settings['github'];

        // get sermon page
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        $uriBuilder = $objectManager->get('TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder');
        $uriBuilder->initializeObject();
        $uri = $uriBuilder->reset()->setTargetPageUid($this->settings['pid']['sermon']['single'])->setCreateAbsoluteUri(true)->uriFor('show', ['sermon' => $sermon], 'Sermon', 'VmfdsSermons', 'Sermons');

        // get container title and path:
        $containerTitle = ($gitHubConfig['containerPrefix'] ? $gitHubConfig['containerPrefix'] : '')
                . \TYPO3\VmfdsSermons\Utility\SyncUtility::convertToSafeString($sermon->getTitle());
        $containerPath = 'typo3temp/vmfds_sermons/github/'
                . $containerTitle;
        $this->view->assign('containerPath', $containerPath);

        // init GitHub framework
        require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('vmfds_sermons') . 'vendor/autoload.php');
        $client = new \Github\Client();
        $client->authenticate($gitHubConfig['token'], '', \Github\Client::AUTH_HTTP_TOKEN);

        // check if repository exists already
        $repo = $gitHubConfig['org'] . '/' . $containerTitle;
        $repositories = $client->api('organizations')->repositories($gitHubConfig['org']);
        $found = false;
        foreach ($repositories as $repository) {
            if ($repository['name'] == $containerTitle) {
                $found = true;
                continue;
            }
        }

        if (!$found) {
            // must create new repo
            $client->api('repo')->create($containerTitle, ($gitHubConfig['descriptionPrefix'] ? $gitHubConfig['descriptionPrefix'] . ' ' : '') . $sermon->getTitle(), $uri, true, $gitHubConfig['org'], true, true, true);
        }

        // create local temp repository
        $this->view->assign('sermon', $sermon);

        // build temp folder by rendering output view
        $this->view->render();

        // git
        $githubLog = PATH_site . 'typo3temp/vmfds_sermons/github/github.log';
        $githubCmd = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('vmfds_sermons') . 'Resources/Private/Shell/GitHubExport.sh '
                . PATH_site . $containerPath . ' ' . $gitHubConfig['org'] . ' ' . $containerTitle . ' potofcoffee ' . $gitHubConfig['token'] . ' >> ' . $githubLog . ' &>> ' . PATH_site . 'typo3temp/vmfds_sermons/github/github.error.log';
        $fp = fopen($githubLog, 'a');
        fwrite($fp, '===> ' . $githubCmd);
        fclose($fp);
        exec($githubCmd, $o, $r);

        Header('Location: https://github.com/' . $repo);
        return '';
    }

}
