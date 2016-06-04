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

namespace TYPO3\VmfdsSermons\Domain\Model;

class Slide extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Title
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $title;

    /**
     * Slide title for presentation
     * @var \string
     */
    protected $presentationTitle;

    /**
     * Font size for presentation
     * @var \int
     */
    protected $presentationFontSize;

    /**
     * Image
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image;

    /**
     * Image source
     *
     * @var \string
     */
    protected $imageSource;

    /**
     * Full text story
     * @var \string
     */
    protected $story;

    /**
     * Bible text
     *
     * @var \string
     */
    protected $bibleText;

    /**
     * Preacher notes
     *
     * @var \string
     */
    protected $preacherNotes;

    /**
     * Technician's notes
     *
     * @var \string
     */
    protected $techNotes;

    /**
     * __construct
     *
     * @return Slide
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
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
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
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
     * Gets the bible text
     * @return \string
     */
    public function getBibleText()
    {
        return $this->bibleText;
    }

    /**
     * Sets the preacher's notes
     * @return \string
     */
    public function getPreacherNotes()
    {
        return $this->preacherNotes;
    }

    /**
     * Gets the technician's notes
     * @return \string
     */
    public function getTechNotes()
    {
        return $this->techNotes;
    }

    /**
     * Sets the bible text
     * @param \string $bibleText
     */
    public function setBibleText($bibleText)
    {
        $this->bibleText = $bibleText;
    }

    /**
     * Sets the preacher's notes
     * @param \string $preacherNotes
     */
    public function setPreacherNotes($preacherNotes)
    {
        $this->preacherNotes = $preacherNotes;
    }

    /**
     * Sets the technician's notes
     * @param \string $techNotes
     */
    public function setTechNotes($techNotes)
    {
        $this->techNotes = $techNotes;
    }

    public function getPresentationTitle()
    {
        return $this->presentationTitle;
    }

    public function getPresentationFontSize()
    {
        return $this->presentationFontSize;
    }

    public function getStory()
    {
        return $this->story;
    }

    public function setPresentationTitle(\string $presentationTitle)
    {
        $this->presentationTitle = $presentationTitle;
    }

    public function setPresentationFontSize(\int $presentationFontSize)
    {
        $this->presentationFontSize = $presentationFontSize;
    }

    public function setStory(\string $story)
    {
        $this->story = $story;
    }

}
