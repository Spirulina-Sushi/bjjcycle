<?php

namespace App\Controller;

use App\Entity\ArmOrientation;
use App\Form\ArmOrientationType;
use App\Repository\ArmOrientationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/armorientation")
 */
class ArmOrientationController extends Controller
{
    /**
     * @Route("/", name="arm_orientation_index", methods="GET")
     */
    public function index(ArmOrientationRepository $armOrientationRepository): Response
    {
        return $this->render('arm_orientation/index.html.twig', ['arm_orientations' => $armOrientationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="arm_orientation_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $armOrientation = new ArmOrientation();
        $form = $this->createForm(ArmOrientationType::class, $armOrientation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($armOrientation);
            $em->flush();

            return $this->redirectToRoute('arm_orientation_index');
        }

        return $this->render('arm_orientation/new.html.twig', [
            'arm_orientation' => $armOrientation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="arm_orientation_show", methods="GET")
     */
    public function show(ArmOrientation $armOrientation): Response
    {
        return $this->render('arm_orientation/show.html.twig', ['arm_orientation' => $armOrientation]);
    }

    /**
     * @Route("/{id}/edit", name="arm_orientation_edit", methods="GET|POST")
     */
    public function edit(Request $request, ArmOrientation $armOrientation): Response
    {
        $form = $this->createForm(ArmOrientationType::class, $armOrientation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arm_orientation_edit', ['id' => $armOrientation->getId()]);
        }

        return $this->render('arm_orientation/edit.html.twig', [
            'arm_orientation' => $armOrientation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="arm_orientation_delete", methods="DELETE")
     */
    public function delete(Request $request, ArmOrientation $armOrientation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$armOrientation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($armOrientation);
            $em->flush();
        }

        return $this->redirectToRoute('arm_orientation_index');
    }
}
