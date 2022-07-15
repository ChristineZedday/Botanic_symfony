<?php

namespace App\Controller;

use App\Entity\SousEmbranchement;
use App\Form\SousEmbranchementType;
use App\Repository\SousEmbranchementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous/embranchement")
 */
class SousEmbranchementController extends AbstractController
{
    /**
     * @Route("/", name="sous_embranchement_index", methods={"GET"})
     */
    public function index(SousEmbranchementRepository $sousEmbranchementRepository): Response
    {
        return $this->render('sous_embranchement/index.html.twig', [
            'sous_embranchements' => $sousEmbranchementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sous_embranchement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousEmbranchement = new SousEmbranchement();
        $form = $this->createForm(SousEmbranchementType::class, $sousEmbranchement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousEmbranchement);
            $entityManager->flush();

            return $this->redirectToRoute('sous_embranchement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_embranchement/new.html.twig', [
            'sous_embranchement' => $sousEmbranchement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sous_embranchement_show", methods={"GET"})
     */
    public function show(SousEmbranchement $sousEmbranchement): Response
    {
        return $this->render('sous_embranchement/show.html.twig', [
            'sous_embranchement' => $sousEmbranchement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_embranchement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousEmbranchement $sousEmbranchement): Response
    {
        $form = $this->createForm(SousEmbranchementType::class, $sousEmbranchement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_embranchement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_embranchement/edit.html.twig', [
            'sous_embranchement' => $sousEmbranchement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sous_embranchement_delete", methods={"POST"})
     */
    public function delete(Request $request, SousEmbranchement $sousEmbranchement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousEmbranchement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousEmbranchement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_embranchement_index', [], Response::HTTP_SEE_OTHER);
    }
}
