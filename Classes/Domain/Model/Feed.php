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
class Feed extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Title
     *
     * @var \string
     */
    protected $title;

    /**
     * url
     *
     * @var \string
     */
    protected $url;

    /**
     * church
     * @var \string
     */
    protected $church;

    /**
     * churchUrl
     * @var \string
     */
    protected $churchUrl;

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
     * Returns the url
     *
     * @return \string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param \string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     *
     * @return \string
     */
    function getChurch()
    {
        return $this->church;
    }

    /**
     *
     * @return \string
     */
    function getChurchUrl()
    {
        return $this->churchUrl;
    }

    /**
     *
     * @param \string $church Church
     */
    function setChurch($church)
    {
        $this->church = $church;
    }

    /**
     *
     * @param \string $churchUrl Church url
     */
    function setChurchUrl($churchUrl)
    {
        $this->churchUrl = $churchUrl;
    }
}