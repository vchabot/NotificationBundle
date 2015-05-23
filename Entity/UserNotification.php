<?php

namespace Joubjoub\NotificationBundle\Entity;

use Joubjoub\NotificationBundle\Model\NotifiableInterface;
use Joubjoub\NotificationBundle\Model\NotificationInterface;
use Doctrine\ORM\Mapping as ORM;

abstract class UserNotification
{
    /**
     * Unique id for the UserNotification entity
     *
     * @var integer
     */
    protected $id;

    /**
     * @var boolean
     */
    protected $isDisplayed;

    /**
     * @var boolean
     */
    protected $isRead;

    /**
     * @var Joubjoub\NotificationBundle\Model\NotifiableInterface
     */
    protected $user;

    /**
     * @var Joubjoub\NotificationBundle\Model\NotificationInterface
     */
    protected $notification;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isDisplayed
     *
     * @param boolean $isDisplayed
     * @return UserNotification
     */
    public function setIsDisplayed($isDisplayed)
    {
        $this->isDisplayed = $isDisplayed;

        return $this;
    }

    /**
     * Get isDisplayed
     *
     * @return boolean
     */
    public function isDisplayed()
    {
        return $this->isDisplayed;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     * @return UserNotification
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return boolean
     */
    public function isRead()
    {
        return $this->isRead;
    }

    /**
     * @return Joubjoub\NotificationBundle\Model\NotifiableInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Joubjoub\NotificationBundle\Model\NotifiableInterface
     * @return UserNotification
     */
    public function setUser(NotifiableInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Joubjoub\NotificationBundle\Model\NotificationInterface
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param Joubjoub\NotificationBundle\Model\NotificationInterface
     * @return UserNotification
     */
    public function setNotification(NotificationInterface $notification)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Get isDisplayed
     *
     * @return boolean
     */
    public function getIsDisplayed()
    {
        return $this->isDisplayed;
    }

    /**
     * Get isRead
     *
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->isRead;
    }
}
