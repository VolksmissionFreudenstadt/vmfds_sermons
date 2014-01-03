<?php

namespace TYPO3\VmfdsSermons\Tests;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Christoph Fischer <christoph.fischer@volksmission.de>, Volksmission Freudenstadt
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \TYPO3\VmfdsSermons\Domain\Model\Sermon.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Sermons
 *
 * @author Christoph Fischer <christoph.fischer@volksmission.de>
 */
class SermonTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \TYPO3\VmfdsSermons\Domain\Model\Sermon
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \TYPO3\VmfdsSermons\Domain\Model\Sermon();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getSubtitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSubtitleForStringSetsSubtitle() { 
		$this->fixture->setSubtitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSubtitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getPreachedReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setPreachedForDateTimeSetsPreached() { }
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getReferenceReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setReferenceForStringSetsReference() { 
		$this->fixture->setReference('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getReference()
		);
	}
	
	/**
	 * @test
	 */
	public function getKeywordsReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setKeywordsForStringSetsKeywords() { 
		$this->fixture->setKeywords('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getKeywords()
		);
	}
	
	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setImageForStringSetsImage() { 
		$this->fixture->setImage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getImage()
		);
	}
	
	/**
	 * @test
	 */
	public function getHandoutReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setHandoutForStringSetsHandout() { 
		$this->fixture->setHandout('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getHandout()
		);
	}
	
	/**
	 * @test
	 */
	public function getAudiorecordingReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAudiorecordingForStringSetsAudiorecording() { 
		$this->fixture->setAudiorecording('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAudiorecording()
		);
	}
	
	/**
	 * @test
	 */
	public function getVideorecordingReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setVideorecordingForStringSetsVideorecording() { 
		$this->fixture->setVideorecording('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getVideorecording()
		);
	}
	
	/**
	 * @test
	 */
	public function getPreacherReturnsInitialValueForPreacher() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getPreacher()
		);
	}

	/**
	 * @test
	 */
	public function setPreacherForObjectStorageContainingPreacherSetsPreacher() { 
		$preacher = new \TYPO3\VmfdsSermons\Domain\Model\Preacher();
		$objectStorageHoldingExactlyOnePreacher = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOnePreacher->attach($preacher);
		$this->fixture->setPreacher($objectStorageHoldingExactlyOnePreacher);

		$this->assertSame(
			$objectStorageHoldingExactlyOnePreacher,
			$this->fixture->getPreacher()
		);
	}
	
	/**
	 * @test
	 */
	public function addPreacherToObjectStorageHoldingPreacher() {
		$preacher = new \TYPO3\VmfdsSermons\Domain\Model\Preacher();
		$objectStorageHoldingExactlyOnePreacher = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOnePreacher->attach($preacher);
		$this->fixture->addPreacher($preacher);

		$this->assertEquals(
			$objectStorageHoldingExactlyOnePreacher,
			$this->fixture->getPreacher()
		);
	}

	/**
	 * @test
	 */
	public function removePreacherFromObjectStorageHoldingPreacher() {
		$preacher = new \TYPO3\VmfdsSermons\Domain\Model\Preacher();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($preacher);
		$localObjectStorage->detach($preacher);
		$this->fixture->addPreacher($preacher);
		$this->fixture->removePreacher($preacher);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getPreacher()
		);
	}
	
	/**
	 * @test
	 */
	public function getSeriesReturnsInitialValueForSeries() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getSeries()
		);
	}

	/**
	 * @test
	 */
	public function setSeriesForObjectStorageContainingSeriesSetsSeries() { 
		$series = new \TYPO3\VmfdsSermons\Domain\Model\Series();
		$objectStorageHoldingExactlyOneSeries = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSeries->attach($series);
		$this->fixture->setSeries($objectStorageHoldingExactlyOneSeries);

		$this->assertSame(
			$objectStorageHoldingExactlyOneSeries,
			$this->fixture->getSeries()
		);
	}
	
	/**
	 * @test
	 */
	public function addSeriesToObjectStorageHoldingSeries() {
		$series = new \TYPO3\VmfdsSermons\Domain\Model\Series();
		$objectStorageHoldingExactlyOneSeries = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSeries->attach($series);
		$this->fixture->addSeries($series);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneSeries,
			$this->fixture->getSeries()
		);
	}

	/**
	 * @test
	 */
	public function removeSeriesFromObjectStorageHoldingSeries() {
		$series = new \TYPO3\VmfdsSermons\Domain\Model\Series();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($series);
		$localObjectStorage->detach($series);
		$this->fixture->addSeries($series);
		$this->fixture->removeSeries($series);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getSeries()
		);
	}
	
}
?>