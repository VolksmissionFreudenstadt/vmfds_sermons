<?php

namespace TYPO3\VmfdsSermons\Domain\Repository;

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
class SeriesRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Find latest series
     * 
     * @return \TYPO3\VmfdsSermons\Domain\Model\Series
     */
    public function findLatest()
    {
        $this->setDefaultOrderings(array('startdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
        $q = $this->createQuery();
        $r = $q->setLimit(1)
                ->matching(
                        $q->logicalAnd(array(
                            $q->lessThanOrEqual('startdate', time()),
                            $q->greaterThanOrEqual('enddate', time())
                        ))
                )
                ->execute()
                ->getFirst();
        return $r;
    }

}

?>