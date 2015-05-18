<?php

namespace Joubjoub\RelationshipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotificationController extends Controller {

    public function listAction() {
        $relationshipProvider = $this->container->get('joubjoub_relationship.provider');
        return $this->render('JoubjoubNotificationBundle:Notification:list.html.twig', array());
    }
}
