<?php

namespace Joubjoub\NotificationBundle\Entity;

use Joubjoub\NotificationBundle\Model\NotifiableInterface;
use Doctrine\Common\Collections\ArrayCollection;

abstract class User implements NotifiableInterface
{
	/**
	 * Unique id for the User entity
	 * 
	 * @var integer
	 */
	protected $id;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	protected $userNotifications;

	public function __construct()
	{
		$this->notifications = new ArrayCollection();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getUserNotifications()
	{
		return $this->userNotifications;
	}

	public function setUserNotifications(ArrayCollection $userNotifications)
	{
		$this->userNotifications = $userNotifications;
	}

	public function getNotifications()
	{
		$notifications = array();

		foreach ($this->userNotifications as $userNotification) {
			$notifications[] = $userNotification->getNotification();
		}

		return $notifications;
	}

	public function hasNotifications()
	{
		return $this->userNotifications->count() > 0;
	}

	public function getNbNotifications()
	{
		return $this->userNotifications->count();
	}

	public function hasUnreadNotifications()
	{
		if (!$this->hasNotifications()) {
			return false;
		}

		foreach ($this->userNotifications as $userNotification) {
			if (!$userNotification->isDisplayed()) {
				return true;
			}
		}
	}
}