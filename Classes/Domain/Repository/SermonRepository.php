<?php
namespace TYPO3\VmfdsSermons\Domain\Repository;

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
class SermonRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	
	
	/**
	 * Find the latest sermon with a series
	 * 
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findLatestWithSeries() {
		// find latest sermon with a series
		$this->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		$q = $this->createQuery()->setLimit(1);
		$constraints = array(
							$q->greaterThan('series', 0),										
						);
		$sermon = $q->matching($q->logicalAnd($constraints))->execute()->getFirst();
		return $sermon;
	}

	/**
	 * Find all sermons belonging to a series
	 * 
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Series $series The series to which all returned sermons should belong
	 * @param int $limit Limit to this number of records
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findBySeries(\TYPO3\VmfdsSermons\Domain\Model\Series $series, $limit = 0) {
		$this->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		$q = $this->createQuery();
		if ($limit) $q->setLimit($limit);
		return $q->matching($q->contains('series', $series))
				 ->execute();				
	}

	/**
	 * Find all sermons preacher by a specific preacher
	 * 
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher The preacher
	 * @param int $limit Limit to this number of records
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findByPreacher(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher, $limit = 0) {
		$this->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		$q = $this->createQuery();
		if ($limit) $q->setLimit($limit);
		return $q->matching($q->contains('preacher', $preacher))
				 ->execute();				
	}


	/**
	 * Override default findByUid function to enable also the option to turn of
	 * the enableField setting
	 * Copied from the news extension.
	 *
	 * @param integer $uid id of record
	 * @param boolean $respectEnableFields if set to false, hidden records are shown
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findByUid($uid, $respectEnableFields = TRUE) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->getQuerySettings()->setIgnoreEnableFields(!$respectEnableFields);

		return $query->matching(
			$query->logicalAnd(
				$query->equals('uid', $uid),
				$query->equals('deleted', 0)
			))->execute()->getFirst();
	}

	/**
	 * Find the latest sermon
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findLatest() {
		// find latest sermon that's already been preached
		$this->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		$q = $this->createQuery()->setLimit(1);
		$constraints = array(
				$q->lessThanOrEqual('preached', time()),
		);
		$sermon = $q->matching($q->logicalAnd($constraints))->execute()->getFirst();
		return $sermon;
	}
	
	/**
	 * Find the next sermon for a preview
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findNextPreview() {
		
		// find next sermon for preview
		$this->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		$q = $this->createQuery()->setLimit(1);
		$q->getQuerySettings()->setIgnoreEnableFields(TRUE);
		$constraints = array(
				$q->greaterThan('preached', time()),
		);
		$sermon = $q->matching($q->logicalAnd($constraints))->execute()->getFirst();
		return $sermon;
	}
	

	/**
	 * Find all sermons without audio recording
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findAllWithoutAudio() {
		$this->setDefaultOrderings(array('preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		$q = $this->createQuery();
		$constraints = array(
				$q->isEmpty('audiorecording'),
		);
		$sermons = $q->matching($q->logicalAnd($constraints))->execute();
		return $sermons;
	}
	
	
	

}
?>