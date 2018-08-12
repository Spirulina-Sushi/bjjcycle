<?php

namespace App\Controller;

use App\Entity\Catagory;
use App\Form\CatagoryType;
use App\Repository\CatagoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/catagory")
 */
class CatagoryController extends Controller
{
    /**
     * @Route("/", name="catagory_index", methods="GET")
     */
    public function index(CatagoryRepository $catagoryRepository): Response
    {
        return $this->render('catagory/index.html.twig', ['catagories' => $catagoryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="catagory_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $catagory = new Catagory();
        $form = $this->createForm(CatagoryType::class, $catagory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catagory);
            $em->flush();

            return $this->redirectToRoute('catagory_index');
        }

        return $this->render('catagory/new.html.twig', [
            'catagory' => $catagory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="catagory_show", methods="GET")
     */
    public function show(Catagory $catagory): Response
    {
        return $this->render('catagory/show.html.twig', ['catagory' => $catagory]);
    }

    /**
     * @Route("/{id}/edit", name="catagory_edit", methods="GET|POST")
     */
    public function edit(Request $request, Catagory $catagory): Response
    {
        $form = $this->createForm(CatagoryType::class, $catagory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('catagory_edit', ['id' => $catagory->getId()]);
        }

        return $this->render('catagory/edit.html.twig', [
            'catagory' => $catagory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="catagory_delete", methods="DELETE")
     */
    public function delete(Request $request, Catagory $catagory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catagory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catagory);
            $em->flush();
        }

        return $this->redirectToRoute('catagory_index');
    }
}
