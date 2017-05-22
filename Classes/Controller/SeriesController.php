<?php

/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @file SeriesController.php
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

class SeriesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * seriesRepository
     * @var \TYPO3\VmfdsSermons\Domain\Repository\SeriesRepository
     * @inject
     */
    protected $seriesRepository;

    /**
     * sermonRepository
     * @var \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository
     * @inject
     */
    protected $sermonRepository;

    /**
     * inject the SermonRepository object
     * @param \TYPO3\VmfdsSermons\Domain\Repository\SermonRepository $sermonRepository
     * @return void
     */
    public function injectSermonRepository(\TYPO3\VmfdsSermons\Domain\Repository\SermonRepository $sermonRepository)
    {
        $this->sermonRepository = $sermonRepository;
    }

    /**
     * action list
     * List all available sermon series
     * @return void
     */
    public function listAction()
    {
        $this->seriesRepository->setDefaultOrderings(array('startdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));

        $seriess = $this->seriesRepository->findAll();
        $this->view->assign('seriess', $seriess);
    }

    /**
     * action show
     * Display details for a single sermon series
     * @param \TYPO3\VmfdsSermons\Domain\Model\Series $series
     * @return void
     */
    public function showAction(\TYPO3\VmfdsSermons\Domain\Model\Series $series = NULL)
    {
        if (is_null($series))
            $this->forward('list');

        // related sermons
        $sermons = $this->sermonRepository->findBySeries($series);
        $futureSermons = $this->sermonRepository->findFutureSermonsBySeries($series);

        $this->view->assign('series', $series);
	    $this->view->assign('futureSermons', $futureSermons);
        $this->view->assign('sermons', $sermons);
    }

    /**
     * action latest
     * Display the latest sermon series
     * @return void
     */
    public function latestAction()
    {
        $seriess = $this->seriesRepository->findLatest(1);
        $sermons = $this->sermonRepository->findBySeries($sseries[0]);
        $this->view->assign('seriess', $seriess);
        $this->view->assign('sermons', $sermons);
    }

}
