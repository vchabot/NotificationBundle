<?php

namespace Joubjoub\NotificationBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Joubjoub\NotificationBundle\Model\NotifiableInterface;
use Joubjoub\NotificationBundle\Model\NotificationInterface;

abstract class AbstractManager
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
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
