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
     * Twitter
     *
     * @var \string
     */
    protected $twitter;

    /**
     * User id
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $userId = NULL;

    /**
     * Mic
     *
     * @var \string
     */
    protected $mic;

    /**
     * needs pulpit
     *
     * @var \int
     */
    protected $pulpit;

    /**
     * brings ppt
     *
     * @var \int
     */
    protected $ppt;

    /**
     * brings laptop
     *
     * @var \int
     */
    protected $laptop;

    /**
     * Travel cost
     *
     * @var \string
     */
    protected $travelCost;

    /**
     * Travel cost
     *
     * @var \string
     */
    protected $accountHolder;

    /**
     * IBAN
     *
     * @var \string
     */
    protected $iban;

    /**
     * BIC
     *
     * @var \string
     */
    protected $bic;

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

    /**
     * Returns the twitter id
     *
     * @return \int $twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Sets the twitter id
     *
     * @param \string $hashtags
     * @return void
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     *
     * @return TYPO3\CMS\Extbase\Domain\Model\FrontendUser User Id
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     *
     * @param TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userId User id
     */
    public function setUserId(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $userId)
    {
        $this->userId = $userId;
    }

    public function getMic()
    {
        return $this->mic;
    }

    public function getPulpit()
    {
        return $this->pulpit;
    }

    public function getPpt()
    {
        return $this->ppt;
    }

    public function getLaptop()
    {
        return $this->laptop;
    }

    public function getTravelCost()
    {
        return $this->travelCost;
    }

    public function getAccountHolder()
    {
        return $this->accountHolder;
    }

    public function getIban()
    {
        return $this->iban;
    }

    public function getBic()
    {
        return $this->bic;
    }

    public function setMic($mic)
    {
        $this->mic = $mic;
    }

    public function setPulpit($pulpit)
    {
        $this->pulpit = $pulpit;
    }

    public function setPpt($ppt)
    {
        $this->ppt = $ppt;
    }

    public function setLaptop($laptop)
    {
        $this->laptop = $laptop;
    }

    public function setTravelCost($travelCost)
    {
        $this->travelCost = $travelCost;
    }

    public function setAccountHolder($accountHolder)
    {
        $this->accountHolder = $accountHolder;
    }

    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    public function setBic($bic)
    {
        $this->bic = $bic;
    }

}

?>