<?php

namespace App\Controller;

use App\Repository\PositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cycle;
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
    public function maintenance(CycleRepository $cycleRepository, TechniqueRepository $techniqueReopsitory): Response
    {
        return $this->render('home/maintenance.html.twig', [
            'controller_name' => 'HomeController',
            'cycles' => $cycleRepository->findAll(),
            'techniques' => $techniqueReopsitory->findAll()
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
