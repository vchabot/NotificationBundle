<?php

namespace Joubjoub\NotificationBundle;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Joubjoub\NotificationBundle\Exception\NotificationException;
use Joubjoub\NotificationBundle\Manager\UserNotificationManager;
use Joubjoub\NotificationBundle\Manager\NotificationManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Criteria;

class Notification
{
    /**
     * @var NotificationManager
     */
    protected $notificationManager = null;

    /**
     * @var UserNotificationManager
     */
    protected $userNotificationManager = null;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher = null;

    /**
     * @param NotificationManager $notificationManager
     * @param UserNotificationManager $userNotificationManager
     * @param EventDispatcher $dispatcher
     */
    public function __construct(NotificationManager $notificationManager, UserNotificationManager $userNotificationManager, $dispatcher)
    {
        $this->notificationManager = $notificationManager;
        $this->userNotificationManager = $userNotificationManager;
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
            $users = $user;
        }

        if ($user instanceof Model\NotifiableInterface) {
            $users = array($user);
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                $this->userNotificationManager->create($user, $notification);

                $event = new Event\NotificationEvent($notification);
                $this->dispatcher->dispatch(NotificationEvents::NEW_NOTIFICATION, $event);
            }

            $this->notificationManager->save($notification);
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
        if (!$user->hasUndisplayedNotifications()) {
            return;
        }

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("notification", $notification))
        ;

        $userNotifications = $user->getUserNotifications()->matching($criteria);

        if (!empty($userNotifications)) {
            foreach ($userNotifications as $userNotification) {
                $userNotification->setIsDisplayed(true);
                $this->userNotificationManager->save($userNotification);
            }
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
        if (!$user->hasUnreadNotifications()) {
            return;
        }

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("notification", $notification))
        ;

        $userNotifications = $user->getUserNotifications()->matching($criteria);

        if (!empty($userNotifications)) {
            foreach ($userNotifications as $userNotification) {
                $userNotification->setIsRead(true);
                $this->userNotificationManager->save($userNotification);
            }
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
                $this->userNotificationManager->save($userNotification);
            }
        }
    }

    /**
     * Mark all notifications as read for a specific user
     *
     * @param  Model\NotifiableInterface $user
     * @return void
     */
    public function markAllNotificationsAsRead(Model\NotifiableInterface $user)
    {
        if (!$user->hasNotifications()) {
            return;
        }

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("isRead", false))
        ;

        $undisplayedNotifications = $user->getUserNotifications()->matching($criteria);

        if (!empty($undisplayedNotifications)) {
            foreach ($undisplayedNotifications as $userNotification) {
                $userNotification->setIsRead(true);
                $this->userNotificationManager->save($userNotification);
            }
        }
    }
}
