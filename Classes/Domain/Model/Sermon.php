<?php

namespace TYPO3\VmfdsSermons\Domain\Model;

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
class Sermon extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Title
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $title;

    /**
     * Subtitle
     *
     * @var \string
     */
    protected $subtitle;

    /**
     * Preaching date
     *
     * @var \DateTime
     */
    protected $preached;

    /**
     * Description
     *
     * @var \string
     */
    protected $description;

    /**
     * Notes header
     *
     * @var \string
     */
    protected $notesHeader;

    /**
     * Key points
     *
     * @var \string
     */
    protected $keypoints;

    /**
     * Questions
     *
     * @var \string
     */
    protected $questions;

    /**
     * Further reading
     *
     * @var \string
     */
    protected $furtherReading;

    /**
     * Prep
     *
     * @var \string
     */
    protected $prep;

    /**
     * Text reference
     *
     * @var \string
     */
    protected $reference;

    /**
     * Key words
     *
     * @var \string
     */
    protected $keywords;

    /**
     * Title image
     *
     * @var \string
     */
    protected $image;

    /**
     * Image source
     *
     * @var \string
     */
    protected $imageSource;

    /**
     * No handout links
     *
     * @var \int
     */
    protected $noHandout;

    /**
     * Handout
     *
     * @var \string
     */
    protected $handout;

    /**
     * Audio recording
     *
     * @var \string
     */
    protected $audiorecording;

    /**
     * videorecording
     *
     * @var \string
     */
    protected $videorecording;

    /**
     * hashtags
     *
     * @var \string
     */
    protected $hashtags;

    /**
     * cclicense
     *
     * @var \int
     */
    protected $cclicense;

    /**
     * Preacher
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\VmfdsSermons\Domain\Model\Preacher>
     */
    protected $preacher;

    /**
     * series
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\VmfdsSermons\Domain\Model\Series>
     */
    protected $series;

    /**
     * syncuid
     *
     * @var \string
     */
    protected $syncuid;

    /**
     * __construct
     *
     * @return Sermon
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties.
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the extension builder
         * You may modify the constructor of this class instead
         */
        $this->preacher = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

        $this->series = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return \string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param \string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the subtitle
     *
     * @return \string $subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Sets the subtitle
     *
     * @param \string $subtitle
     * @return void
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Returns the description
     *
     * @return \string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param \string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the notes header
     *
     * @return \string $notesHeader
     */
    public function getNotesHeader()
    {
        return $this->notesHeader;
    }

    /**
     * Sets the notes header
     *
     * @param \string $notesHeader
     * @return void
     */
    public function setNotesHeader($notesHeader)
    {
        $this->notesHeader = $notesHeader;
    }

    /**
     * Returns the key points
     *
     * @return \string $keypoints
     */
    public function getKeypoints()
    {
        return $this->keypoints;
    }

    /**
     * Sets the keypoints
     *
     * @param \string $keypoints
     * @return void
     */
    public function setKeypoints($keypoints)
    {
        $this->keypoints = $keypoints;
    }

    /**
     * Returns the questions
     *
     * @return \string $questions
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Sets the questions
     *
     * @param \string $questions
     * @return void
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * Returns the further reading
     *
     * @return \string $furtherReading
     */
    public function getFurtherReading()
    {
        return $this->furtherReading;
    }

    /**
     * Sets the further reading
     *
     * @param \string $furtherReading
     * @return void
     */
    public function setFurtherReading($furtherReading)
    {
        $this->furtherReading = $furtherReading;
    }

    /**
     * Returns the prep questions
     *
     * @return \string $prep
     */
    public function getPrep()
    {
        return $this->prep;
    }

    /**
     * Sets the prep questions
     *
     * @param \string $prep
     * @return void
     */
    public function setPrep($prep)
    {
        $this->prep = $prep;
    }

    /**
     * Returns the reference
     *
     * @return \string $reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Sets the reference
     *
     * @param \string $reference
     * @return void
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Returns the keywords
     *
     * @return \string $keywords
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Sets the keywords
     *
     * @param \string $keywords
     * @return void
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * Returns the image
     *
     * @return \string $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \string $image
     * @return void
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Returns the image source
     *
     * @return \string $imageSource
     */
    public function getImageSource()
    {
        return $this->imageSource;
    }

    /**
     * Sets the image source
     *
     * @param \string $image source
     * @return void
     */
    public function setImageSource($imageSource)
    {
        $this->imageSource = $imageSource;
    }

    /**
     * Returns the hoHandout check
     *
     * @return \int $noHandout
     */
    public function getNoHandout()
    {
        return $this->noHandout;
    }

    /**
     * Sets the hoHandout check
     *
     * @param \int $noHandout
     * @return void
     */
    public function setNoHandout($noHandout)
    {
        $this->noHandout = $noHandout;
    }

    /**
     * Returns the handout
     *
     * @return \string $handout
     */
    public function getHandout()
    {
        return $this->handout;
    }

    /**
     * Sets the handout
     *
     * @param \string $handout
     * @return void
     */
    public function setHandout($handout)
    {
        $this->handout = $handout;
    }

    /**
     * Returns the audiorecording
     *
     * @return \string $audiorecording
     */
    public function getAudiorecording()
    {
        return $this->audiorecording;
    }

    /**
     * Sets the audiorecording
     *
     * @param \string $audiorecording
     * @return void
     */
    public function setAudiorecording($audiorecording)
    {
        $this->audiorecording = $audiorecording;
    }

    /**
     * Returns the videorecording
     *
     * @return \string $videorecording
     */
    public function getVideorecording()
    {
        return $this->videorecording;
    }

    /**
     * Sets the videorecording
     *
     * @param \string $videorecording
     * @return void
     */
    public function setVideorecording($videorecording)
    {
        $this->videorecording = $videorecording;
    }

    /**
     * Returns the hashtags
     *
     * @return \int $hashtags
     */
    public function getHashtags()
    {
        return $this->hashtags;
    }

    /**
     * Sets the hashtags
     *
     * @param \string $hashtags
     * @return void
     */
    public function setHashtags($hashtags)
    {
        $this->hashtags = $hashtags;
    }

    /**
     * Returns the cclicsense
     *
     * @return \int $cclicense
     */
    public function getCclicense()
    {
        return $this->cclicense;
    }

    /**
     * Sets the cclicense
     *
     * @param \int $cclicense
     * @return void
     */
    public function setCclicense($cclicense)
    {
        $this->cclicense = $cclicense;
    }

    /**
     * Adds a Preacher
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher
     * @return void
     */
    public function addPreacher(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacher)
    {
        $this->preacher->attach($preacher);
    }

    /**
     * Removes a Preacher
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Preacher $preacherToRemove The Preacher to be removed
     * @return void
     */
    public function removePreacher(\TYPO3\VmfdsSermons\Domain\Model\Preacher $preacherToRemove)
    {
        $this->preacher->detach($preacherToRemove);
    }

    /**
     * Returns the preacher
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\VmfdsSermons\Domain\Model\Preacher> $preacher
     */
    public function getPreacher()
    {
        return $this->preacher;
    }

    /**
     * Sets the preacher
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\VmfdsSermons\Domain\Model\Preacher> $preacher
     * @return void
     */
    public function setPreacher(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $preacher)
    {
        $this->preacher = $preacher;
    }

    /**
     * Adds a Series
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Series $series
     * @return void
     */
    public function addSeries(\TYPO3\VmfdsSermons\Domain\Model\Series $series)
    {
        $this->series->attach($series);
    }

    /**
     * Removes a Series
     *
     * @param \TYPO3\VmfdsSermons\Domain\Model\Series $seriesToRemove The Series to be removed
     * @return void
     */
    public function removeSeries(\TYPO3\VmfdsSermons\Domain\Model\Series $seriesToRemove)
    {
        $this->series->detach($seriesToRemove);
    }

    /**
     * Returns the series
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\VmfdsSermons\Domain\Model\Series> $series
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Sets the series
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\VmfdsSermons\Domain\Model\Series> $series
     * @return void
     */
    public function setSeries(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $series)
    {
        $this->series = $series;
    }

    /**
     * Returns the preached
     *
     * @return \DateTime preached
     */
    public function getPreached()
    {
        return $this->preached;
    }

    /**
     * Sets the preached
     *
     * @param \DateTime $preached
     * @return \DateTime preached
     */
    public function setPreached($preached)
    {
        $this->preached = $preached;
    }

    public function getSelectString()
    {
        return strftime('%d.%m.%Y', $this->getPreached()->getTimestamp()).' '.$this->getTitle();
    }

    public function getSyncuid()
    {
        return $this->syncuid;
    }

    public function setSyncuid($syncuid)
    {
        $this->syncuid = $syncuid;
    }
}
?>