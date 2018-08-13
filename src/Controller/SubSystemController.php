<?php

namespace App\Controller;

use App\Entity\SubSystem;
use App\Form\SubSystemType;
use App\Repository\SubSystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subsystem")
 */
class SubSystemController extends Controller
{
    /**
     * @Route("/", name="sub_system_index", methods="GET")
     */
    public function index(SubSystemRepository $subSystemRepository): Response
    {
        return $this->render('sub_system/index.html.twig', ['sub_systems' => $subSystemRepository->findAll()]);
    }

    /**
     * @Route("/new", name="sub_system_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $subSystem = new SubSystem();
        $form = $this->createForm(SubSystemType::class, $subSystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subSystem);
            $em->flush();

            return $this->redirectToRoute('sub_system_index');
        }

        return $this->render('sub_system/new.html.twig', [
            'sub_system' => $subSystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sub_system_show", methods="GET")
     */
    public function show(SubSystem $subSystem): Response
    {
        return $this->render('sub_system/show.html.twig', ['sub_system' => $subSystem]);
    }

    /**
     * @Route("/{id}/edit", name="sub_system_edit", methods="GET|POST")
     */
    public function edit(Request $request, SubSystem $subSystem): Response
    {
        $form = $this->createForm(SubSystemType::class, $subSystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sub_system_edit', ['id' => $subSystem->getId()]);
        }

        return $this->render('sub_system/edit.html.twig', [
            'sub_system' => $subSystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sub_system_delete", methods="DELETE")
     */
    public function delete(Request $request, SubSystem $subSystem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subSystem->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subSystem);
            $em->flush();
        }

        return $this->redirectToRoute('sub_system_index');
    }
}
