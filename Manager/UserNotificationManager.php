<?php

namespace Joubjoub\NotificationBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Joubjoub\NotificationBundle\Model\NotifiableInterface;
use Joubjoub\NotificationBundle\Model\NotificationInterface;
use Joubjoub\NotificationBundle\Model\UserNotificationInterface;

class UserNotificationManager extends AbstractManager
{
    /**
     * Create an userNotification entity
     *
     * @param  NotifiableInterface   $user
     * @param  NotificationInterface $notification
     * @return void
     */
    public function create(NotifiableInterface $user, NotificationInterface $notification)
    {
        $nClass = $this->getClass();
        $entity = new $nClass();
        $entity->setNotification($notification);
        $entity->setUser($user);
        $this->em->persist($entity);
        $this->em->persist($notification);
        $this->em->flush();
    }

    /**
     * Save an userNotification entity
     *
     * @param  UserNotificationInterface $userNotification
     * @return void
     */
    public function save(UserNotificationInterface $userNotification)
    {
        $this->em->persist($userNotification);
        $this->em->flush();
    }
}
