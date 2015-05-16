<?php

namespace Joubjoub\NotificationBundle\Event;

use Joubjoub\NotificationBundle\Entity\Notification;
use Symfony\Component\EventDispatcher\Event;

class NotificationEvent extends Event
{
	/**
	 * @var Notification
	 */
	protected $notification = null;

	public function setNotification(Notification $notification)
	{
		$this->notification = $notification;

		return $this;
	}

	public function getNotification()
	{
		return $this->notification;
	}
}
