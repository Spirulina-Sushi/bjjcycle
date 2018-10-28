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
        $OffsetGround = $em->getRepository('App\Entity\User')->find($id)->getMOffset();
        $OffsetStanding = $em->getRepository('App\Entity\User')->find($id)->getFOffset();
        $weeksSinceJoin = $em->getRepository('App\Entity\User')->find($id)->getWeeksOnSite();

        $positionsGround = $em->getRepository('app\entity\position')->findByGame('ground');
        $positionsStanding = $em->getRepository('app\entity\position')->findByGame('standing');
        $focusWeekGround = count($positionsGround) - $weeksSinceJoin % count($positionsGround);
        $focusWeekStanding = count($positionsStanding) - $weeksSinceJoin % count($positionsStanding);

        $focusPositionGround = $positionsGround[$focusWeekGround - 1 + $OffsetGround];
        $focusPositionStanding = $positionsStanding[$focusWeekStanding - 1 + $OffsetStanding];

        $currentPositionGroundId = $em->getRepository('App\Entity\User')->find($id)->getCurrentPositionGround();
        $currentPositionGround = $currentPositionGroundId->getName();
        $currentPositionStandingId = $em->getRepository('App\Entity\User')->find($id)->getCurrentPositionStanding();
        $currentPositionStanding = $currentPositionStandingId->getName();
        $techniquesGround = $em->getRepository('App\Entity\Technique')->findByPosition($currentPositionGround);
        $techniquesStanding = $em->getRepository('App\Entity\Technique')->findByPosition($currentPositionStanding);

        //        dump($techniqueReopsitory->findAll());

        return $this->render('user/profile.html.twig', [
            'focusPositionGround' => $focusPositionGround,
            'focusPositionStanding' => $focusPositionStanding,
            'positionsGround' => $positionsGround,
            'positionsStanding' => $positionsStanding,
            'focusWeekGround' => $focusWeekGround,
            'focusWeekStanding' => $focusWeekStanding,
            'user' => $user,
            'techniquesGround' => $techniquesGround,
            'techniquesStanding' => $techniquesStanding,
            'weeksSinceJoin' => $weeksSinceJoin
        ]);
    }
}
