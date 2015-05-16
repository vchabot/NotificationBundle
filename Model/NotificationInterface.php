<?php

namespace Joubjoub\NotificationBundle\Model;

interface NotificationInterface
{
	public function getUserNotifications();

	public function setUserNotifications($userNotifications);

	public function getUsers();

	public function hasUsers();

	public function getNbUsers();
}
