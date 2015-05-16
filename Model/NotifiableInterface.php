<?php

namespace Joubjoub\NotificationBundle\Model;

use Joubjoub\NotificationBundle\Entity\Notification;

interface NotifiableInterface
{
	public function getUserNotifications();

	public function setUserNotifications($userNotifications);

	public function getNotifications();

	public function hasNotifications();

	public function getNbNotifications();
}
