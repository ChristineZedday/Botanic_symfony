<?php

namespace App\Controller;

use App\Entity\Ordre;
use App\Form\OrdreType;
use App\Repository\OrdreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ordre")
 */
class OrdreController extends AbstractController
{
    /**
     * @Route("/", name="ordre_index", methods={"GET"})
     */
    public function index(OrdreRepository $ordreRepository): Response
    {
        return $this->render('ordre/index.html.twig', [
            'ordres' => $ordreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ordre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ordre = new Ordre();
        $form = $this->createForm(OrdreType::class, $ordre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ordre);
            $entityManager->flush();

            return $this->redirectToRoute('ordre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ordre/new.html.twig', [
            'ordre' => $ordre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_show", methods={"GET"})
     */
    public function show(Ordre $ordre): Response
    {
        return $this->render('ordre/show.html.twig', [
            'ordre' => $ordre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ordre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ordre $ordre): Response
    {
        $form = $this->createForm(OrdreType::class, $ordre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ordre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ordre/edit.html.twig', [
            'ordre' => $ordre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_delete", methods={"POST"})
     */
    public function delete(Request $request, Ordre $ordre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ordre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ordre_index', [], Response::HTTP_SEE_OTHER);
    }
}
