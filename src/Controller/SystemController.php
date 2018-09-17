<?php

namespace App\Controller;

use App\Entity\System;
use App\Form\SystemType;
use App\Repository\SystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/system")
 */
class SystemController extends AbstractController
{
    /**
     * @Route("/", name="system_index", methods="GET")
     */
    public function index(SystemRepository $systemRepository): Response
    {
        return $this->render('system/index.html.twig', ['systems' => $systemRepository->findAll()]);
    }

    /**
     * @Route("/new", name="system_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $system = new System();
        $form = $this->createForm(SystemType::class, $system);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($system);
            $em->flush();

            return $this->redirectToRoute('system_index');
        }

        return $this->render('system/new.html.twig', [
            'system' => $system,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="system_show", methods="GET")
     */
    public function show(System $system): Response
    {
        return $this->render('system/show.html.twig', ['system' => $system]);
    }

    /**
     * @Route("/{id}/edit", name="system_edit", methods="GET|POST")
     */
    public function edit(Request $request, System $system): Response
    {
        $form = $this->createForm(SystemType::class, $system);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('system_edit', ['id' => $system->getId()]);
        }

        return $this->render('system/edit.html.twig', [
            'system' => $system,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="system_delete", methods="DELETE")
     */
    public function delete(Request $request, System $system): Response
    {
        if ($this->isCsrfTokenValid('delete'.$system->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($system);
            $em->flush();
        }

        return $this->redirectToRoute('system_index');
    }
}
