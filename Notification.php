<?php

namespace Joubjoub\NotificationBundle;

use Joubjoub\NotificationBundle\Exception\NotificationException;
use Doctrine\ORM\EntityManager;

class Notification
{
	/**
	 * @var EntityManager
	 */
	protected $em = null;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

    public function addNotification($user, Entity\Notification $notification)
    {
        if (!is_array($user) && !($user instanceof NotifiableInterface)) {
            throw new NotificationException('First argument must be an array or a NotifiableInterface object')
        }

        $users = (array) $user;

        if (!empty($users)) {
            foreach ($users as $user) {
            	$userNotification = new UserNotification();
            	$userNotification->setUser($user);
            	$userNotification->setNotification($notification);
                $this->em->persist($userNotification);

                $event = new NotificationEvent($notification);
                $this->dispatcher->dispatch(NotificationEvents::NEW_NOTIFICATION, $event);
            }

            $this->em->persist($notification);
            $this->em->flush();
        }
    }
}
