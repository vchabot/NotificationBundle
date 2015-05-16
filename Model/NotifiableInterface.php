<?php

namespace Joubjoub\NotificationBundle\Model;

interface NotifiableInterface
{
	public function getUserNotifications();

	public function setUserNotifications($userNotifications);

	public function getNotifications();

	public function hasNotifications();

	public function hasUnreadNotifications();

	public function getNbNotifications();
}
