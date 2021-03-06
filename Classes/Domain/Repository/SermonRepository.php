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

namespace TYPO3\VmfdsSermons\Domain\Repository;

class SermonRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Find the latest sermon with a series
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findLatestWithSeries() {
		// find latest sermon with a series
		$this->setDefaultOrderings( [ 'preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING ] );
		$q           = $this->createQuery()->setLimit( 1 );
		$constraints = [
			$q->greaterThan( 'series', 0 ),
		];
		$sermon      = $q->matching( $q->logicalAnd( $constraints ) )->execute()->getFirst();

		return $sermon;
	}

	/**
	 * Find all sermons belonging to a series
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Series $series The series to which all returned sermons should belong
	 * @param int $limit Limit to this number of records
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findBySeries( \TYPO3\VmfdsSermons\Domain\Model\Series $series, $limit = 0 ) {
		$this->setDefaultOrderings( [ 'preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING ] );
		$q = $this->createQuery();
		if ( $limit ) {
			$q->setLimit( $limit );
		}

		return $q->matching( $q->contains( 'series', $series ) )
		         ->execute();
	}

	/**
	 * Find all sermons preacher by a specific preacher
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher The preacher
	 * @param int $limit Limit to this number of records
	 * @param bool $includeHidden True, if hidden records should be included
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findByPreacher(
		\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher,
		$limit = 0,
		$includeHidden = false
	) {
		$this->setDefaultOrderings( [ 'preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING ] );
		$q = $this->createQuery();
		if ( $limit ) {
			$q->setLimit( $limit );
		}
		$q->getQuerySettings()->setIgnoreEnableFields( $includeHidden );

		return $q->matching( $q->contains( 'preacher', $preacher ) )
		         ->execute();
	}

	/**
	 * Override default findByUid function to enable also the option to turn of
	 * the enableField setting
	 * Copied from the news extension.
	 *
	 * @param integer $uid id of record
	 * @param boolean $respectEnableFields if set to false, hidden records are shown
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findByUid( $uid, $respectEnableFields = false ) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage( false );
		$query->getQuerySettings()->setIgnoreEnableFields( ! $respectEnableFields );

		return $query->matching(
			$query->logicalAnd(
				$query->equals( 'uid', $uid ), $query->equals( 'deleted', 0 )
			) )->execute()->getFirst();
	}

	/**
	 * Find the latest sermon
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findLatest() {
		// find latest sermon that's already been preached
		$this->setDefaultOrderings( [ 'preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING ] );
		$q           = $this->createQuery()->setLimit( 1 );
		$constraints = [
			$q->lessThanOrEqual( 'preached', time() ),
		];
		$sermon      = $q->matching( $q->logicalAnd( $constraints ) )->execute()->getFirst();

		return $sermon;
	}

	/**
	 * Find the next sermon for a preview
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findNextPreview() {

		// find next sermon for preview
		$this->setDefaultOrderings( [ 'preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING ] );
		$q = $this->createQuery()->setLimit( 1 );
		$q->getQuerySettings()->setIgnoreEnableFields( true );
		$constraints = [
			$q->greaterThan( 'preached', time() ),
		];
		$sermon      = $q->matching( $q->logicalAnd( $constraints ) )->execute()->getFirst();

		return $sermon;
	}

	/**
	 * Find all sermons without audio recording
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findAllWithoutAudio() {
		$this->setDefaultOrderings( [ 'preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING ] );
		$q           = $this->createQuery();
		$constraints = [
			$q->equals( 'audiorecording', '' ),
		];
		$sermons     = $q->matching( $q->logicalAnd( $constraints ) )->execute();

		return $sermons;
	}



	/**
	 * Find all sermons from a specific date
	 *
	 * This function overrides the auto-generated findByPreached() and sets
	 * the ignoreEnableFields flag, in order to include sermons that have a
	 * future date and have not been officially published yet.
	 *
	 * @param \DateTime|int $date Date
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	public function findByPreached( $date ) {
		if (!is_a($date, 'DateTime')) {
			$date = new \DateTime(strftime('%Y-%m-%d 0:00:00', $date));
		}

		$q = $this->createQuery();
		$q->getQuerySettings()->setIgnoreEnableFields( true );
		$constraints = [
			$q->equals( 'preached', $date ),
		];
		$sermons     = $q->matching( $q->logicalAnd( $constraints ) )->execute();
		return $sermons;
	}

	/**
	 * Check if Syncuid already exists
	 *
	 * @param string $uid
	 *
	 * @return \int Number of existing records
	 */
	public function checkSyncuid( $uid ) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage( false );
		$constraints = [ $query->equals( 'syncuid', $uid ) ];

		return $query->matching( $query->logicalAnd( $constraints ) )->execute()->count();
	}

	/**
	 * Find by Syncuid already exists
	 *
	 * @param string $uid
	 *
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon Sermon
	 */
	public function findBySyncuid( $uid ) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage( false );
		$constraints = [ $query->equals( 'syncuid', $uid ) ];

		return $query->matching( $query->logicalAnd( $constraints ) )->execute()->getFirst();
	}


	/**
	 * Find all future sermons in a series
	 *
	 * @param \TYPO3\VmfdsSermons\Domain\Model\Series $series Series
	 * @return \TYPO3\VmfdsSermons\Domain\Model\Sermon Future sermons in the series
	 */
	public function findFutureSermonsBySeries( $series ) {
		$this->setDefaultOrderings( [ 'preached' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING ] );
		$q = $this->createQuery();
		$q->getQuerySettings()->setIgnoreEnableFields( true );
		$constraints = [
			$q->contains( 'series', $series ),
			$q->greaterThan( 'preached', time() ),
		];
		return $q->matching( $q->logicalAnd( $constraints ) )->execute();
	}


}
