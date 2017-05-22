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

namespace TYPO3\VmfdsSermons\Tests;

/**
 * Test case for class \TYPO3\VmfdsSermons\Domain\Model\Series.
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
class SeriesTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase
{

    /**
     * @var \TYPO3\VmfdsSermons\Domain\Model\Series
     */
    protected $fixture;

    public function setUp()
    {
        $this->fixture = new \TYPO3\VmfdsSermons\Domain\Model\Series();
    }

    public function tearDown()
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {

    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->fixture->setTitle('Conceived at T3CON10');

        $this->assertSame(
                'Conceived at T3CON10', $this->fixture->getTitle()
        );
    }

    /**
     * @test
     */
    public function getSubtitleReturnsInitialValueForString()
    {

    }

    /**
     * @test
     */
    public function setSubtitleForStringSetsSubtitle()
    {
        $this->fixture->setSubtitle('Conceived at T3CON10');

        $this->assertSame(
                'Conceived at T3CON10', $this->fixture->getSubtitle()
        );
    }

    /**
     * @test
     */
    public function getStartdateReturnsInitialValueForDateTime()
    {

    }

    /**
     * @test
     */
    public function setStartdateForDateTimeSetsStartdate()
    {

    }

    /**
     * @test
     */
    public function getEnddateReturnsInitialValueForDateTime()
    {

    }

    /**
     * @test
     */
    public function setEnddateForDateTimeSetsEnddate()
    {

    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {

    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->fixture->setDescription('Conceived at T3CON10');

        $this->assertSame(
                'Conceived at T3CON10', $this->fixture->getDescription()
        );
    }

    /**
     * @test
     */
    public function getImageReturnsInitialValueForString()
    {

    }

    /**
     * @test
     */
    public function setImageForStringSetsImage()
    {
        $this->fixture->setImage('Conceived at T3CON10');

        $this->assertSame(
                'Conceived at T3CON10', $this->fixture->getImage()
        );
    }

}

?>