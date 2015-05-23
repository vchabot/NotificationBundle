<?php

namespace Joubjoub\NotificationBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Joubjoub\NotificationBundle\Model\NotifiableInterface;
use Joubjoub\NotificationBundle\Model\NotificationInterface;

class UserNotificationManager
{
    protected $em;

    protected $class;

    protected $repository;

    /**
     * @param EntityManagerInterface $em
     * @param string                 $class
     */
    public function __construct(EntityManagerInterface $em, $class)
    {
        $this->em = $em;
        $this->class = $em->getClassMetadata($class)->name;
        $this->repository = $em->getRepository($class);
    }

    /**
     * Create a userNotification entity
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
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
