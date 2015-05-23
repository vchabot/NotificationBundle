<?php

namespace Joubjoub\NotificationBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Joubjoub\NotificationBundle\Model\NotifiableInterface;
use Joubjoub\NotificationBundle\Model\NotificationInterface;

class NotificationManager
{

    protected $em;

    protected $class;

    protected $repository;

    public function getClass() {
        return $this->class;
    }

    public function __construct(EntityManagerInterface $em, $class){
        $this->em = $em;
        $this->class = $em->getClassMetadata($class)->name;
        $this->repository = $em->getRepository($class);
    }

    public function create(NotifiableInterface $user, NotificationInterface $notification)
    {
        $nClass = $this->getClass();
        $entity = new $nClass();
        $entity->setNotification($notification);
        $entity->setUser($user);
        $this->em->persist($relationship);
        $this->em->flush();
    }
}
