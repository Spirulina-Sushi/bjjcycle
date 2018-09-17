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
//        $userId = $security->getUser();

        return $this->render('home/maintenance.html.twig', [
            'controller_name' => 'HomeController',
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findByPosition('Butterfly Guard Over/Under'),
//            'user' => $userRepository->find($userId)
        ]);
    }

    /**
     * @Route("/focus", name="focus")
     */
    public function focus(CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory): Response
    {
        return $this->render('home/focus.html.twig', [
            'controller_name' => 'HomeController',
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll()
        ]);
    }

    /**
     * @Route("/flow", name="flow") 
     */
    public function flow(CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory, PositionRepository $positionRepository): Response
    {
        return $this->render('home/flow.html.twig', [
            'controller_name' => 'HomeController',
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll(),
            'positions' => $positionRepository->findAll()
        ]);
    }

}
