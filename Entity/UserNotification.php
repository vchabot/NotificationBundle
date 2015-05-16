<?php

namespace Joubjoub\NotificationBundle\Entity;

use Joubjoub\NotificationBundle\Model\NotifiableInterface;
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
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $routeParams;

    /**
     * @var boolean
     */
    protected $isDisplayed;

    /**
     * @var Joubjoub\NotificationBundle\Model\NotifiableInterface
     */
    protected $user;

    /**
     * @var Joubjoub\NotificationBundle\Entity\Notification
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
     * Set type
     *
     * @param string $type
     * @return UserNotification
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return UserNotification
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return UserNotification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set routeParams
     *
     * @param string $routeParams
     * @return UserNotification
     */
    public function setRouteParams($routeParams)
    {
        $this->routeParams = $routeParams;

        return $this;
    }

    /**
     * Get routeParams
     *
     * @return string 
     */
    public function getRouteParams()
    {
        return $this->routeParams;
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
    public function getIsDisplayed()
    {
        return $this->isDisplayed;
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
     * @return Joubjoub\NotificationBundle\Entity\Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param Joubjoub\NotificationBundle\Entity\Notification
     * @return UserNotification
     */
    public function setNotification(Notification $notification)
    {
        $this->notification = $notification;

        return $this;
    }
}
