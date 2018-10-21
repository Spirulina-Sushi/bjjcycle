<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        // Get the User entity.
        $user = $event->getAuthenticationToken()->getUser();

        $today = new \dateTime();
        $joinDate = $user->getJoinDate();
        $weeksSinceJoin = $joinDate->diff($today)->format("%d");
        $weeksOnSite = $user->getWeeksOnSite();

        if($weeksSinceJoin != $weeksOnSite){
            $user->setWeeksOnSite($weeksSinceJoin);

            $this->em->persist($user);
            $this->em->flush();
        }

        // Persist the data to database.
        $this->em->persist($user);
        $this->em->flush();
    }
}