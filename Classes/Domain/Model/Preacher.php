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
class Preacher extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Name
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $name;

    /**
     * firstName
     *
     * @var \string
     */
    protected $firstName;

    /**
     * lastName
     *
     * @var \string
     */
    protected $lastName;

    /**
     * Email address
     *
     * @var \string
     */
    protected $email;

    /**
     * Organization
     *
     * @var \string
     */
    protected $organization;

    /**
     * URL
     *
     * @var \string
     */
    protected $url;

    /**
     * Blog
     *
     * @var \string
     */
    protected $blog;

    /**
     * facebookID
     *
     * @var \string
     */
    protected $facebookId;

    /**
     * about
     *
     * @var \string
     */
    protected $about;

    /**
     * Image
     *
     * @var \string
     */
    protected $image;

    /**
     * Returns the name
     *
     * @return \string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param \string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the first name
     *
     * @return \string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the first name
     *
     * @param \string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the last name
     *
     * @return \string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the last name
     *
     * @param \string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the email
     *
     * @return \string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param \string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the organization
     *
     * @return \string $organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Sets the organization
     *
     * @param \string $organization
     * @return void
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
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
     * Returns the blog
     *
     * @return \string $blog
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Sets the blog
     *
     * @param \string $blog
     * @return void
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;
    }

    /**
     * Returns the facebook id
     *
     * @return \string $facebookId
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Sets the facebook id
     *
     * @param \string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * Returns the about
     *
     * @return \string $about
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Sets the about
     *
     * @param \string $about
     * @return void
     */
    public function setAbout($about)
    {
        $this->about = $about;
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

}

?>