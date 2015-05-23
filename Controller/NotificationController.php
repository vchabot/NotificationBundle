<?php

namespace Joubjoub\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotificationController extends Controller
{

    public function listAction()
    {
        $notifications = array();

        return $this->render('JoubjoubNotificationBundle:Notification:list.html.twig', array('notifications' => $notifications));
    }
}
