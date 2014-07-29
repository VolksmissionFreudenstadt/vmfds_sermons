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
    public function showAction(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher)
    {


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

        $this->preacherRepository->update($preacher);
        $this->flashMessageContainer->add('Your Preacher was updated.');
        $this->redirect('list');
    }

}

?>