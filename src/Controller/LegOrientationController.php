<?php

namespace App\Controller;

use App\Entity\LegOrientation;
use App\Form\LegOrientationType;
use App\Repository\LegOrientationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/legorientation")
 */
class LegOrientationController extends Controller
{
    /**
     * @Route("/", name="leg_orientation_index", methods="GET")
     */
    public function index(LegOrientationRepository $legOrientationRepository): Response
    {
        return $this->render('leg_orientation/index.html.twig', ['leg_orientations' => $legOrientationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="leg_orientation_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $legOrientation = new LegOrientation();
        $form = $this->createForm(LegOrientationType::class, $legOrientation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($legOrientation);
            $em->flush();

            return $this->redirectToRoute('leg_orientation_index');
        }

        return $this->render('leg_orientation/new.html.twig', [
            'leg_orientation' => $legOrientation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leg_orientation_show", methods="GET")
     */
    public function show(LegOrientation $legOrientation): Response
    {
        return $this->render('leg_orientation/show.html.twig', ['leg_orientation' => $legOrientation]);
    }

    /**
     * @Route("/{id}/edit", name="leg_orientation_edit", methods="GET|POST")
     */
    public function edit(Request $request, LegOrientation $legOrientation): Response
    {
        $form = $this->createForm(LegOrientationType::class, $legOrientation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leg_orientation_edit', ['id' => $legOrientation->getId()]);
        }

        return $this->render('leg_orientation/edit.html.twig', [
            'leg_orientation' => $legOrientation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leg_orientation_delete", methods="DELETE")
     */
    public function delete(Request $request, LegOrientation $legOrientation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$legOrientation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($legOrientation);
            $em->flush();
        }

        return $this->redirectToRoute('leg_orientation_index');
    }
}
