<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cycle;
use App\Repository\CycleRepository;
use Symfony\Component\HttpFoundation\Response;

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
    public function maintenance()
    {
        return $this->render('home/maintenance.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    /**
     * @Route("/focus", name="focus")
     */
    public function focus(CycleRepository $cycleRepository): Response
    {
        return $this->render('home/focus.html.twig', [
            'controller_name' => 'HomeController',
            'cycles' => $cycleRepository->findAll()
        ]);
    }
    
}
