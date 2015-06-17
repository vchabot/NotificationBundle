<?php

namespace Joubjoub\NotificationBundle\Model;

interface UserNotificationInterface
{
	public function getUser();

	public function setUser(NotifiableInterface $user);

	public function getNotification();

	public function setNotification(NotificationInterface $notification);
}
