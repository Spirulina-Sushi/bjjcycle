<?php

namespace App\Controller;

use App\Entity\Cycle;
use App\Form\CycleType;
use App\Repository\CycleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cycle")
 */
class CycleController extends Controller
{
    /**
     * @Route("/", name="cycle_index", methods="GET")
     */
    public function index(CycleRepository $cycleRepository): Response
    {
        return $this->render('cycle/index.html.twig', ['cycles' => $cycleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="cycle_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $cycle = new Cycle();
        $form = $this->createForm(CycleType::class, $cycle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cycle);
            $em->flush();

            return $this->redirectToRoute('cycle_index');
        }

        return $this->render('cycle/new.html.twig', [
            'cycle' => $cycle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cycle_show", methods="GET")
     */
    public function show(Cycle $cycle): Response
    {
        return $this->render('cycle/show.html.twig', ['cycle' => $cycle]);
    }

    /**
     * @Route("/{id}/edit", name="cycle_edit", methods="GET|POST")
     */
    public function edit(Request $request, Cycle $cycle): Response
    {
        $form = $this->createForm(CycleType::class, $cycle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cycle_edit', ['id' => $cycle->getId()]);
        }

        return $this->render('cycle/edit.html.twig', [
            'cycle' => $cycle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cycle_delete", methods="DELETE")
     */
    public function delete(Request $request, Cycle $cycle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cycle->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cycle);
            $em->flush();
        }

        return $this->redirectToRoute('cycle_index');
    }
}
