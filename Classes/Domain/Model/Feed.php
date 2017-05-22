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

class Feed extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Title
     * @var \string
     */
    protected $title;

    /**
     * url
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
