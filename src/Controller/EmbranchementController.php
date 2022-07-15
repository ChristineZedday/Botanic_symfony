<?php

namespace App\Controller;

use App\Entity\Embranchement;
use App\Form\EmbranchementType;
use App\Repository\EmbranchementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/embranchement")
 */
class EmbranchementController extends AbstractController
{
    /**
     * @Route("/", name="embranchement_index", methods={"GET"})
     */
    public function index(EmbranchementRepository $embranchementRepository): Response
    {
        return $this->render('embranchement/index.html.twig', [
            'embranchements' => $embranchementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="embranchement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $embranchement = new Embranchement();
        $form = $this->createForm(EmbranchementType::class, $embranchement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($embranchement);
            $entityManager->flush();

            return $this->redirectToRoute('embranchement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('embranchement/new.html.twig', [
            'embranchement' => $embranchement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="embranchement_show", methods={"GET"})
     */
    public function show(Embranchement $embranchement): Response
    {
        return $this->render('embranchement/show.html.twig', [
            'embranchement' => $embranchement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="embranchement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Embranchement $embranchement): Response
    {
        $form = $this->createForm(EmbranchementType::class, $embranchement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('embranchement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('embranchement/edit.html.twig', [
            'embranchement' => $embranchement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="embranchement_delete", methods={"POST"})
     */
    public function delete(Request $request, Embranchement $embranchement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$embranchement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($embranchement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('embranchement_index', [], Response::HTTP_SEE_OTHER);
    }
}
