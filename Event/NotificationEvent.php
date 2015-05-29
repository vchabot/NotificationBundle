<?php

namespace Joubjoub\NotificationBundle\Event;

use Joubjoub\NotificationBundle\Model\NotificationInterface;
use Symfony\Component\EventDispatcher\Event;

class NotificationEvent extends Event
{
	/**
	 * @var NotificationInterface
	 */
	protected $notification = null;
	
	public function __construct(NotificationInterface $notification)
	{
		$this->notification = $notification;
	}

	public function setNotification(NotificationInterface $notification)
	{
		$this->notification = $notification;

		return $this;
	}

	public function getNotification()
	{
		return $this->notification;
	}
}
