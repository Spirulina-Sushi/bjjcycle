<?php

namespace App\Controller;

use App\Repository\SubsystemRepository;
use App\Repository\TechniqueRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/profile")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="profile", methods="GET")
     */
    public function index(Security $security, UserRepository $userRepository, TechniqueRepository $techniqueReopsitory, SubsystemRepository $subsystemReopsitory): Response
    {
        $em = $this->getDoctrine()->getManager();

        $id = $security->getUser();
        $user = $em->getRepository('App\Entity\User')->find($id);

        $joinDate = $em->getRepository('App\Entity\User')->find($id)->getJoinDate();
        $today = new \dateTime();
        $weeksSinceJoin = floor($joinDate->diff($today)->format("%d") / 7);


        $subsystems = $em->getRepository('app\entity\Subsystem')->findAll();
        $focusWeek = $weeksSinceJoin % count($subsystems);

        $positions = $em->getRepository('app\entity\position')->findBy([], ['name' => 'ASC']);
        $dummyOffsetStanding = 0;
        echo($positions[$dummyOffsetStanding]->getSubsystem()->getSystem()->getGame()->getName());

        $dummyOffsetGround = 6;
        $dummyPositionGround = $em->getRepository('app\entity\position')->find($dummyOffsetGround)->getName();

        return $this->render('user/profile.html.twig', [
            'dummyPositionGround' => $dummyPositionGround,
            'focusWeek' => $focusWeek,
            'user' => $user,
            'techniques' => $techniqueReopsitory->findAll(),
            'subsystems' => $subsystems,
            'weeksSinceJoin' => $weeksSinceJoin
        ]);
    }
}
