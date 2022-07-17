<?php

namespace App\Controller;

use App\Entity\SuperClasse;
use App\Form\SuperClasseType;
use App\Repository\SuperClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/super/classe")
 */
class SuperClasseController extends AbstractController
{
    /**
     * @Route("/", name="super_classe_index", methods={"GET"})
     */
    public function index(SuperClasseRepository $superClasseRepository): Response
    {
        return $this->render('super_classe/index.html.twig', [
            'super_classes' => $superClasseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="super_classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $superClasse = new SuperClasse();
        $form = $this->createForm(SuperClasseType::class, $superClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($superClasse);
            $entityManager->flush();

            return $this->redirectToRoute('super_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('super_classe/new.html.twig', [
            'super_classe' => $superClasse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="super_classe_show", methods={"GET"})
     */
    public function show(SuperClasse $superClasse): Response
    {

        return $this->render('super_classe/show.html.twig', [
            'super_classe' => $superClasse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="super_classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SuperClasse $superClasse): Response
    {
        $form = $this->createForm(SuperClasseType::class, $superClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('super_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('super_classe/edit.html.twig', [
            'super_classe' => $superClasse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="super_classe_delete", methods={"POST"})
     */
    public function delete(Request $request, SuperClasse $superClasse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$superClasse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($superClasse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('super_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
