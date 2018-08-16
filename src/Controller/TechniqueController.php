<?php

namespace App\Controller;

use App\Entity\Technique;
use App\Form\Technique1Type;
use App\Repository\TechniqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/technique")
 */
class TechniqueController extends Controller
{
    /**
     * @Route("/", name="technique_index", methods="GET")
     */
    public function index(TechniqueRepository $techniqueRepository): Response
    {
        return $this->render('technique/index.html.twig', ['techniques' => $techniqueRepository->findAll()]);
    }

    /**
     * @Route("/new", name="technique_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $technique = new Technique();
        $form = $this->createForm(Technique1Type::class, $technique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($technique);
            $em->flush();

            return $this->redirectToRoute('technique_index');
        }

        return $this->render('technique/new.html.twig', [
            'technique' => $technique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="technique_show", methods="GET")
     */
    public function show(Technique $technique): Response
    {
        return $this->render('technique/show.html.twig', ['technique' => $technique]);
    }

    /**
     * @Route("/{id}/edit", name="technique_edit", methods="GET|POST")
     */
    public function edit(Request $request, Technique $technique): Response
    {
        $form = $this->createForm(Technique1Type::class, $technique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('technique_edit', ['id' => $technique->getId()]);
        }

        return $this->render('technique/edit.html.twig', [
            'technique' => $technique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="technique_delete", methods="DELETE")
     */
    public function delete(Request $request, Technique $technique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technique->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($technique);
            $em->flush();
        }

        return $this->redirectToRoute('technique_index');
    }
}
