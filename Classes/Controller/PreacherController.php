<?php

namespace TYPO3\VmfdsSermons\Controller;

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

class PreacherController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	protected $databaseHandle;

	/**
	 * Upload utility class
	 * @var \TYPO3\VmfdsSermons\Utility\UploadUtility
	 * @inject
	 */
	protected $uploadUtility;

	/**
	 * preacherRepository
	 * @var \TYPO3\VmfdsSermons\Domain\Repository\PreacherRepository
	 * @inject
	 */
	protected $preacherRepository;

	/**
	 * sermonRepository
	 * @var \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository
	 * @inject
	 */
	protected $sermonRepository;

	/**
	 * frontentUserRepository
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $userRepository;

	/**
	 * Map view format to object
	 * @var array
	 */
	protected $viewFormatToObjectNameMap = [ 'json' => 'TYPO3\CMS\Extbase\Mvc\View\JsonView' ];
	/**
	 * objectManager
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

	/**
	 * inject the SermonRepository object
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository $sermonRepository
	 *
	 * @return void
	 */
	public function injectSermonRepository( \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository $sermonRepository ) {
		$this->sermonRepository = $sermonRepository;
	}

	/**
	 * initialize action
	 * @return void
	 */
	public function initializeAction() {
		if ( $this->arguments->hasArgument( 'preacher' ) ) {
			$this->arguments->getArgument( 'preacher' )->getPropertyMappingConfiguration()->setTargetTypeForSubProperty( 'image',
				'array' );
		}
	}

	/**
	 * action list
	 * List all preachers
	 * @return void
	 */
	public function listAction() {
		$preachers = $this->preacherRepository->findAll();
		$this->view->assign( 'preachers', $preachers );
	}

	/**
	 * action show
	 * Show details for a single preacher
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
	 *
	 * @return void
	 */
	public function showAction( \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher = null ) {
		if ( is_null( $preacher ) ) {
			$this->forward( 'list' );
		}

		// related sermons
		$sermons = $this->sermonRepository->findByPreacher( $preacher );

		$this->view->assign( 'preacher', $preacher );
		$this->view->assign( 'sermons', $sermons );
	}

	/**
	 * action edit
	 * Show the edit form for a single preacher
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
	 *
	 * @return void
	 */
	public function editAction( \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher ) {
		$this->view->assign( 'preacher', $preacher );
	}

	/**
	 * action update
	 * Update a preacher record
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
	 *
	 * @return void
	 */
	public function updateAction( \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher ) {
		$formData   = $this->request->getArgument( 'preacher' );
		$imageField = $formData['image'];
		if ( $imageField['name'] ) {
			$fileName = $this->uploadUtility->uploadFile( $imageField, 'tx_vmfdssermons_domain_model_preacher',
				'image' );
			$preacher->setImage( $fileName );
		} else {
			$oldImage = $this->request->getArgument( 'oldImage' );
			$preacher->setImage( $oldImage );
		}

		$this->preacherRepository->update( $preacher );
		$this->redirect( 'admin' );
	}

	/**
	 * action feed
	 * Show a synchronizable feed of all sermons for a single preacher
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
	 *
	 * @return string JSON-encoded data
	 */
	public function feedAction( \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher = null ) {

		if ( is_null( $preacher ) ) {
			$preacher = $this->preacherRepository->findByUid( $this->request->getArgument( 'preacher' ) );
		}
		$sermons = $this->sermonRepository->findByPreacher( $preacher, null, true )->toArray();

		// make this an array:
		$data = [];
		foreach ( $sermons as $sermon ) {
			$data[] = [
				'sermon'   => \TYPO3\VmfdsSermons\Utility\SyncUtility::convertObject( $sermon,
					$this->settings['prefix']['sermon'] ),
				'series'   => \TYPO3\VmfdsSermons\Utility\SyncUtility::convertObject( $sermon->getSeries(),
					$this->settings['prefix']['series'], true ),
				'preacher' => \TYPO3\VmfdsSermons\Utility\SyncUtility::convertObject( $preacher,
					$this->settings['prefix']['preacher'] ),
				'preached' => $sermon->getPreached(),
				'url'      => sprintf( $this->settings['url'], $sermon->getUid() ),
			];
		}

		return json_encode( [ 'sermons' => $data ], JSON_HEX_QUOT );
	}

	/**
	 * action admin
	 * Show the admin portal for the preacher
	 * Note: The preacher is determined by the currently logged-in user
	 * @return void
	 */
	public function adminAction() {

		$user     = $this->userRepository->findByUid( $GLOBALS['TSFE']->fe_user->user['uid'] );
		$preacher = $this->preacherRepository->findByUserId( $user );

		$sermons = $this->sermonRepository->findByPreacher( $preacher, 0, true );

		$this->view->assign( 'now', time() );
		$this->view->assign( 'user', $user );
		$this->view->assign( 'preacher', $preacher );
		$this->view->assign( 'sermons', $sermons );
	}

}
