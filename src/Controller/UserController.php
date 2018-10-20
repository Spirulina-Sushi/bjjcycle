<?php

namespace App\Controller;

use App\Repository\TechniqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/profile")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="profile", methods="GET")
     */
    public function index(Security $security, TechniqueRepository $techniqueReopsitory): Response
    {
        $em = $this->getDoctrine()->getManager();

        $id = $security->getUser();
        $user = $em->getRepository('App\Entity\User')->find($id);
        $joinDate = $em->getRepository('App\Entity\User')->find($id)->getJoinDate();
        $OffsetGround = $em->getRepository('App\Entity\User')->find($id)->getMOffset();
        $OffsetStanding = $em->getRepository('App\Entity\User')->find($id)->getFOffset();

        $today = new \dateTime();
        $weeksSinceJoin = floor($joinDate->diff($today)->format("%d") / 7);

        $positionsGround = $em->getRepository('app\entity\position')->findByGame('ground');
        $positionsStanding = $em->getRepository('app\entity\position')->findByGame('standing');
        $focusWeekGround = count($positionsGround) - $weeksSinceJoin % count($positionsGround);
        $focusWeekStanding = count($positionsStanding) - $weeksSinceJoin % count($positionsStanding);

        $focusPositionGround = $positionsGround[$focusWeekGround - 1 + $OffsetGround];
        $focusPositionStanding = $positionsStanding[$focusWeekStanding - 1 + $OffsetStanding];

        return $this->render('user/profile.html.twig', [
            'focusPositionGround' => $focusPositionGround,
            'focusPositionStanding' => $focusPositionStanding,
            'positionsGround' => $positionsGround,
            'positionsStanding' => $positionsStanding,
            'focusWeekGround' => $focusWeekGround,
            'focusWeekStanding' => $focusWeekStanding,
            'user' => $user,
            'techniques' => $techniqueReopsitory->findAll(),
            'weeksSinceJoin' => $weeksSinceJoin
        ]);
    }
}
