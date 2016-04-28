<?php

namespace TYPO3\VmfdsSermons\Controller;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Christoph Fischer <christoph.fischer@volksmission.de>, Volksmission Freudenstadt
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 *
 *
 * @package vmfds_sermons
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class PreacherController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    protected $databaseHandle;

    /**
     * Upload utility class
     * @var \TYPO3\VmfdsSermons\Utility\UploadUtility
     * @inject
     */
    protected $uploadUtility;

    /**
     * preacherRepository
     *
     * @var \TYPO3\VmfdsSermons\Domain\Repository\PreacherRepository
     * @inject
     */
    protected $preacherRepository;

    /**
     * sermonRepository
     *
     * @var \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository
     * @inject
     */
    protected $sermonRepository;

    /**
     * User Repository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $userRepository;

    /**
     * @var array
     */
    protected $viewFormatToObjectNameMap = array('json' => 'TYPO3\CMS\Extbase\Mvc\View\JsonView');

    /**
     * inject the SermonRepository object
     *
     * @param \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository $sermonRepository
     * @return void
     */
    public function injectSermonRepository(\TYPO3\VmfdsSermons\Domain\Repository\SermonRepository $sermonRepository)
    {
        $this->sermonRepository = $sermonRepository;
    }

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     * @inject
     */
    protected $objectManager;

    /**
     * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
     */
    //public function injectObjectManager(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager) {
    //    $this->objectManager = $objectManager;
    //}



    public function initializeObject()
    {

    }

    /**
     * initialize action
     */
    public function initializeAction()
    {
        if ($this->arguments->hasArgument('preacher')) {
            $this->arguments->getArgument('preacher')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('image', 'array');
        }
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $preachers = $this->preacherRepository->findAll();
        $this->view->assign('preachers', $preachers);
    }

    /**
     * action show
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
     * @return void
     */
    public function showAction(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher = NULL)
    {
        if (is_null($preacher))
            $this->forward('list');

        // work around buggy DI:
        //if (!is_object($this->sermonRepository))
        //$this->sermonRepository = $this->objectManager->create('\TYPO3\VmfdsSermons\Domain\Repository\SermonRepository');
        // related sermons
        $sermons = $this->sermonRepository->findByPreacher($preacher);

        $this->view->assign('preacher', $preacher);
        $this->view->assign('sermons', $sermons);
    }

    /**
     * action edit
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
     * @return void
     */
    public function editAction(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher)
    {
        $this->view->assign('preacher', $preacher);
    }

    /**
     * action update
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
     * @return void
     */
    public function updateAction(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher)
    {
        $formData = $this->request->getArgument('preacher');
        $imageField = $formData['image'];
        if ($imageField['name']) {
            $fileName = $this->uploadUtility->uploadFile($imageField, 'tx_vmfdssermons_domain_model_preacher', 'image');
            $preacher->setImage($fileName);
        } else {
            $oldImage = $this->request->getArgument('oldImage');
            $preacher->setImage($oldImage);
        }

        $this->preacherRepository->update($preacher);
        $this->redirect('admin');
    }

    public function feedAction(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher = NULL)
    {

        if (is_null($preacher)) {
            $preacher = $this->preacherRepository->findByUid($this->request->getArgument('preacher'));
        }
        $sermons = $this->sermonRepository->findByPreacher($preacher, null, true)->toArray();

        // make this an array:
        $s = array();
        foreach ($sermons as $sermon) {
            $data[] = [
                'sermon' => \TYPO3\VmfdsSermons\Utility\SyncUtility::convertObject($sermon, $this->settings['prefix']['sermon']),
                'series' => \TYPO3\VmfdsSermons\Utility\SyncUtility::convertObject($sermon->getSeries(), $this->settings['prefix']['series'], true),
                'preacher' => \TYPO3\VmfdsSermons\Utility\SyncUtility::convertObject($preacher, $this->settings['prefix']['preacher']),
                'preached' => $sermon->getPreached(),
                'url' => sprintf($this->settings['url'], $sermon->getUid())
            ];
        }
        return json_encode(['sermons' => $data]);
    }

    /**
     * action admin
     *
     * Show the admin portal for the preacher
     *
     * @return void
     */
    public function adminAction()
    {

        $user = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
        $preacher = $this->preacherRepository->findByUserId($user);

        $sermons = $this->sermonRepository->findByPreacher($preacher, 0, true);

        $this->view->assign('now', time());
        $this->view->assign('user', $user);
        $this->view->assign('preacher', $preacher);
        $this->view->assign('sermons', $sermons);
    }

}

?>