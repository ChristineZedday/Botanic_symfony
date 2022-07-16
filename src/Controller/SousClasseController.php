<?php

namespace App\Controller;

use App\Entity\SousClasse;
use App\Form\SousClasseType;
use App\Repository\SousClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous/classe")
 */
class SousClasseController extends AbstractController
{
    /**
     * @Route("/", name="sous_classe_index", methods={"GET"})
     */
    public function index(SousClasseRepository $sousClasseRepository): Response
    {
        return $this->render('sous_classe/index.html.twig', [
            'sous_classes' => $sousClasseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sous_classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousClasse = new SousClasse();
        $form = $this->createForm(SousClasseType::class, $sousClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousClasse);
            $entityManager->flush();

            return $this->redirectToRoute('sous_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_classe/new.html.twig', [
            'sous_classe' => $sousClasse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sous_classe_show", methods={"GET"})
     */
    public function show(SousClasse $sousClasse): Response
    {
        return $this->render('sous_classe/show.html.twig', [
            'sous_classe' => $sousClasse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousClasse $sousClasse): Response
    {
        $form = $this->createForm(SousClasseType::class, $sousClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_classe/edit.html.twig', [
            'sous_classe' => $sousClasse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sous_classe_delete", methods={"POST"})
     */
    public function delete(Request $request, SousClasse $sousClasse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousClasse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousClasse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
