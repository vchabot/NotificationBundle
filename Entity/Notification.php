<?php

namespace Joubjoub\NotificationBundle\Entity;

use Joubjoub\NotificationBundle\Model\NotifiableInterface;
use Joubjoub\NotificationBundle\Model\NotificationInterface;
use Doctrine\ORM\Mapping as ORM;

abstract class Notification implements NotificationInterface
{
    /**
     * Unique id for the notification interface
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $userNotifications;


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
     * @return Notification
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
     * @return Notification
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
     * @return Notification
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
     * @return Notification
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
     * @return Joubjoub\NotificationBundle\Entity\UserNotification
     */
    public function getUserNotifications()
    {
        return $this->userNotifications;
    }

    /**
     * @param Joubjoub\NotificationBundle\Entity\UserNotification
     * @return Notification
     */
    public function setUserNotifications(UserNotification $userNotification)
    {
        $this->userNotifications = $userNotifications;

        return $this;
    }

    /**
     * Get users associated to the notification
     *
     * @var array
     */
    public function getUsers()
    {
        $users = array();

        foreach ($this->userNotifications as $userNotification) {
            $users[] = $userNotification->getUser();
        }

        return $users;
    }

    public function hasUsers()
    {
        return $this->userNotifications->count() > 0;
    }

    public function getNbUsers()
    {
        return $this->userNotifications->count();
    }
}
