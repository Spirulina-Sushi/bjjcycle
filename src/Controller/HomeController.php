<?php

namespace App\Controller;

use App\Repository\PositionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\CycleRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TechniqueRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/maintenance", name="maintenance")
     */
    public function maintenance(Security $security, CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory, UserRepository $userRepository): Response
    {
        $em = $this->getDoctrine()->getManager();

        $id = $security->getUser();
        $user = $em->getRepository('App\Entity\User')->find($id);
        $currentPositionGroundId = $em->getRepository('App\Entity\User')->find($id)->getCurrentPositionGround();
        $currentPositionGround = $currentPositionGroundId->getName();
        $currentPositionStandingId = $em->getRepository('App\Entity\User')->find($id)->getCurrentPositionStanding();
        $currentPositionStanding = $currentPositionStandingId->getName();
        $techniquesGround = $em->getRepository('App\Entity\Technique')->findByPosition($currentPositionGround);
        $techniquesStanding = $em->getRepository('App\Entity\Technique')->findByPosition($currentPositionStanding);

        $videotest = $em->getRepository('App\Entity\video')->findBy([
            'position' => $currentPositionGroundId,
            'technique' => $techniquesGround
        ]);


        return $this->render('home/maintenance.html.twig', [
            'position' => $currentPositionGround,
            'cycles' => $cycleRepository->findAll(),
            'techniquesGround' => $techniquesGround,
            'techniquesStanding' => $techniquesStanding,
            'techniques' => $techniqueReopsitory->findAll(),
            'user' => $user,
            'videos' => $videotest
        ]);
    }

    /**
     * @Route("/focus", name="focus")
     */
    public function focus(CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory): Response
    {

        return $this->render('home/focus.html.twig', [
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll()
        ]);
    }

    /**
     * @Route("/flow", name="flow") 
     */
    public function flow(CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory, PositionRepository $positionRepository): Response
    {

        $em = $this->getDoctrine()->getManager();

        $game = 'Standing';
        $flowStarter = $em->getRepository('App\Entity\Technique')->findFlowStarterStanding($game);
        $flowIterationStartPosition = $flowStarter->getEndPosition()->getValues();

        $flowIteration = $em->getRepository('App\Entity\Technique')->findFlowIteration($flowIterationStartPosition[0]->getName());
        $flowArray[0] = $flowStarter;
        
        for ($x = 1; $x <= 10; $x++) {

            if (!$flowIterationStartPosition) {   break; }
            $flowIteration = $em->getRepository('App\Entity\Technique')->findFlowIteration($flowIterationStartPosition[0]->getName());

            $flowArray[$x] = $flowIteration;
            $flowIterationStartPosition = $flowIteration->getEndPosition()->getValues();
        }

//        dump($flowArray);

        return $this->render('home/flow.html.twig', [
            'flow_array' => $flowArray,
            'controller_name' => 'HomeController',
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll(),
            'positions' => $positionRepository->findAll()
        ]);
    }

}
