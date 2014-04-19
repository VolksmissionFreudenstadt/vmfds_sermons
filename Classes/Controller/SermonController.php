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
class SermonController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * sermonRepository
	 *
	 * @var \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository
	 * @inject
	 */
	protected $sermonRepository;
	
	/**
	 * seriesRepository
	 *
	 * @var \TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository
	 * @inject
	 */
	protected $seriesRepository;
	
	/**
	 * inject the SeriesRepository object 
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository $seriesRepository
	 * @return void
	 */
	public function injectSeriesRepository(\TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository $seriesRepository) {
		$this->seriesRepository = $seriesRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$this->sermonRepository->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		$sermons = $this->sermonRepository->findAll();
		$this->view->assign('sermons', $sermons);
	}

	/**
	 * action show
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon
	 * @return void
	 */
	public function showAction(\TYPO3\VmfdsSermons\Domain\Model\Sermon $sermon = NULL) {


		// permit preview of hidden records?
		$sneakForward = FALSE;
		if (is_null($sermon)) {
			$previewSermonId = ((int)$this->settings['singleSermon'] > 0) ? $this->settings['singleSermon'] : $this->request->getArgument('sermon_preview');
			//die ('Requested sermon '.$previewSermonId);
			if ($this->settings['previewHiddenRecords']) {
				$sermon = $this->sermonRepository->findByUid($previewSermonId, FALSE);
			} else {
				$sermon = $this->sermonRepository->findByUid($previewSermonId);
			}

			// check if this is still a sneak preview?
			if ($sermon->getPreached()->format('U')<=time()) {
				$sneakForward = TRUE;
			}
		}
		
;

		
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
		if (strftime('%w', $weekStartReal) != 0) $weekStartReal = strtotime('last Sunday', $weekStartReal);
		// set to 10:59:
		$weekStart = mktime(10,59,0,strftime('%m', $weekStartReal),strftime('%d', $weekStartReal),strftime('%Y', $weekStartReal));
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
	}
	
	/**
	 * action byLatestSeries
	 *
	 * @return void
	 */
	public function byLatestSeriesAction() {
		
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
	 * 
	 * Display a single sermon: the next one which is on preview
	 *
	 * @return void
	 */
	public function previewNextAction() {
	
		$sermon = $this->sermonRepository->findNextPreview();
		$this->showAction($sermon);			
	
	
	}
	
	/**
	 * action showLatest
	 *
	 * Display a single sermon: the latest one
	 *
	 * @return void
	 */
	public function showLatestAction() {
	
		$sermon = $this->sermonRepository->findLatest();
		$this->showAction($sermon);
	
	
	}
	
	/**
	 * action audioUploadWelcome
	 *
	 * Display a form for sermon audio upload
	 *
	 * @return void
	 */
	public function audioUploadWelcomeAction() {
		$sermons = $this->sermonRepository->findAllWithoutAudio();
		$this->view->assign('sermons', $sermons);
	}
	
	
	/**
	 * action audioUploadDone
	 *
	 * Handle audio upload
	 *
	 * @return void
	 */
	public function audioUploadDoneAction() {

		global $_FILES;
		
		if ($this->request->hasArgument('sermon')) {
			$sermon = $this->sermonRepository->findByUid($this->request->getArgument('sermon'));
		}
		$file = $this->request->getArgument('audiorecording');
		if (!$file['error']) {
			$uploadFolder = PATH_site.$this->settings['uploadFolder'].'/';
			$destFile = $uploadFolder.$file['name'];
			move_uploaded_file($file['tmp_name'], $destFile);
			
			// get preachers
			$p = array();
			foreach ($sermon->getPreacher() as $preacher) {
				$p[] = $preacher->getFirstName().' '.$preacher->getLastName();
			}
			$preacher = join(', ', $p);
			
			// get series
			$s = array();
			foreach ($sermon->getSeries() as $series) {
				$s[] = $series->getTitle();
			}
			$series = join(', ', $s);
			
			// id3 tagging
			id3_set_tag($destFile, array(
				'title' => $sermon->getTitle(),
				'artist' => $preacher,
				'album' => $series,
				'year' => strftime('%Y', $sermon->getPreached()->getTimestamp()),
				'comment' => 'Predigt vom '.strftime('%d.%m.%Y', $sermon->getPreached()->getTimestamp()),
				'track' => 1,
			));
		}
		
		$this->view->assign('sermon', $sermon);
		$this->view->assign('files', $file);
	}
	

}
?>