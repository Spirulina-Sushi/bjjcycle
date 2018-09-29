<?php

namespace App\Controller;

use App\Entity\Subsystem;
use App\Form\SubsystemType;
use App\Repository\SubsystemRepository;
use App\Repository\SystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subsystem")
 */
class SubsystemController extends AbstractController
{
    /**
     * @Route("/", name="subsystem_index", methods="GET")
     */
    public function index(SubsystemRepository $subsystemRepository, SystemRepository $systemRepository): Response
    {
        return $this->render('subsystem/index.html.twig', [
            'subsystems' => $subsystemRepository->findAll(),
            'systems' => $systemRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subsystem_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $subsystem = new Subsystem();
        $form = $this->createForm(SubsystemType::class, $subsystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subsystem);
            $em->flush();

            return $this->redirectToRoute('subsystem_index');
        }

        return $this->render('subsystem/new.html.twig', [
            'subsystem' => $subsystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subsystem_show", methods="GET")
     */
    public function show(Subsystem $subsystem): Response
    {
        return $this->render('subsystem/show.html.twig', ['subsystem' => $subsystem]);
    }

    /**
     * @Route("/{id}/edit", name="subsystem_edit", methods="GET|POST")
     */
    public function edit(Request $request, Subsystem $subsystem): Response
    {
        $form = $this->createForm(SubsystemType::class, $subsystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subsystem_edit', ['id' => $subsystem->getId()]);
        }

        return $this->render('subsystem/edit.html.twig', [
            'subsystem' => $subsystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subsystem_delete", methods="DELETE")
     */
    public function delete(Request $request, Subsystem $subsystem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subsystem->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subsystem);
            $em->flush();
        }

        return $this->redirectToRoute('subsystem_index');
    }
}
