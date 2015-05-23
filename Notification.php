<?php

namespace Joubjoub\NotificationBundle;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Joubjoub\NotificationBundle\Exception\NotificationException;
use Joubjoub\NotificationBundle\Manager\UserNotificationManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Criteria;

class Notification
{
    /**
     * @var EntityManager
     */
    protected $em = null;

    /**
     * @var UserNotificationManager
     */
    protected $manager = null;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher = null;

    /**
     * @param EntityManager $em
     * @param UserNotificationManager $manager
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EntityManager $em, UserNotificationManager $manager, $dispatcher)
    {
        $this->em = $em;
        $this->manager = $manager;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Add a noficiation for some users
     *
     * @param Model\NotifiableInterface|array  $user
     * @param Model\NotificationInterface      $notification
     * @throws NotificationException
     */
    public function addNotification($user, Model\NotificationInterface $notification)
    {
        if (!is_array($user) && !($user instanceof Model\NotifiableInterface)) {
            throw new NotificationException('First argument must be an array or a NotifiableInterface object');
        }

        // check that every $user item implement NotifiableInterface
        if (is_array($user) && !empty($user)) {
            foreach ($user as $u) {
                if (!($u instanceof Model\NotifiableInterface)) {
                    throw new NotificationException('First argument contains invalid item');
                }
            }
        }

        $users = (array) $user;

        if (!empty($users)) {
            foreach ($users as $user) {
                $this->manager->create($user, $notification);

                $event = new Event\NotificationEvent($notification);
                $this->dispatcher->dispatch(NotificationEvents::NEW_NOTIFICATION, $event);
            }

            $this->em->persist($notification);
            $this->em->flush();
        }
    }

    /**
     * Mark the notification as displayed for the specified user
     *
     * @param  Model\NotificationInterface $notification
     * @param  Model\NotifiableInterface   $user
     * @return void
     */
    public function markNotificationAsDisplayed(Model\NotificationInterface $notification, Model\NotifiableInterface $user)
    {
        if ($user->hasUnreadNotifications()) {
            return;
        }

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("notification", $notification))
        ;

        $userNotifications = $user->getUserNotifications()->matching($criteria);

        if (!empty($userNotifications)) {
            foreach ($userNotifications as $userNotification) {
                $userNotification->setIsDisplayed(true);
                $this->em->persist($userNotification);
            }

            $this->em->flush();
        }
    }

    /**
     * Mark the notification as read for the specified user
     *
     * @param  Model\NotificationInterface $notification
     * @param  Model\NotifiableInterface   $user
     * @return void
     */
    public function markNotificationAsRead(Model\NotificationInterface $notification, Model\NotifiableInterface $user)
    {
        if ($user->hasUnreadNotifications()) {
            return;
        }

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("notification", $notification))
        ;

        $userNotifications = $user->getUserNotifications()->matching($criteria);

        if (!empty($userNotifications)) {
            foreach ($userNotifications as $userNotification) {
                $userNotification->setIsRead(true);
                $this->em->persist($userNotification);
            }

            $this->em->flush();
        }
    }

    /**
     * Mark all notifications as displayed for a specific user
     *
     * @param  Model\NotifiableInterface $user
     * @return void
     */
    public function markAllNotificationsAsDisplayed(Model\NotifiableInterface $user)
    {
        if (!$user->hasNotifications()) {
            return;
        }

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("isDisplayed", false))
        ;

        $undisplayedNotifications = $user->getUserNotifications()->matching($criteria);

        if (!empty($undisplayedNotifications)) {
            foreach ($undisplayedNotifications as $userNotification) {
                $userNotification->setIsDisplayed(true);
                $this->em->persist($userNotification);
            }

            $this->em->flush();
        }
    }
}
