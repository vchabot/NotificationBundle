<?php

namespace Joubjoub\NotificationBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Joubjoub\NotificationBundle\Model\NotificationInterface;

class NotificationManager extends AbstractManager
{
    /**
     * Create a userNotification entity
     *
     * @param  NotifiableInterface   $user
     * @param  NotificationInterface $notification
     * @return void
     */
    public function save(NotificationInterface $notification)
    {
        $this->em->persist($notification);
        $this->em->flush();
    }
}
