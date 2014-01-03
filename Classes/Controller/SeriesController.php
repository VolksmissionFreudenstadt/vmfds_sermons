<?php
namespace TYPO3\VmfdsSermons\Controller;

/***************************************************************
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
 ***************************************************************/

/**
 *
 *
 * @package vmfds_sermons
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class SeriesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * seriesRepository
	 *
	 * @var \TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository
	 * @inject
	 */
	protected $seriesRepository;

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
	public function injectSermonRepository(\TYPO3\VmfdsSermons\Domain\Repository\SermonRepository $sermonRepository) {
		$this->sermonRepository = $sermonRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$this->seriesRepository->setDefaultOrderings(array('startdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));

		$seriess = $this->seriesRepository->findAll();
		$this->view->assign('seriess', $seriess);
	}

	/**
	 * action show
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Series $series
	 * @return void
	 */
	public function showAction(\TYPO3\VmfdsSermons\Domain\Model\Series $series) {
		// work around buggy DI:
		//if (!is_object($this->sermonRepository))
			//$this->sermonRepository = $this->objectManager->create('\TYPO3\VmfdsSermons\Domain\Repository\SermonRepository');
		

		// related sermons
		$sermons = $this->sermonRepository->findBySeries($series);

		$this->view->assign('series', $series);
		$this->view->assign('sermons', $sermons);
	}

	/**
	 * action latest
	 *
	 * @return void
	 */
	public function latestAction() {
		$seriess = $this->seriesRepository->findLatest(1);
		$sermons = $this->sermonRepository->findBySeries($sseries[0]);
		$this->view->assign('seriess', $seriess);
		
	}
	

}


?>