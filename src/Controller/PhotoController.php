<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;


/**
 * @Route("/photo")
 */
class PhotoController extends AbstractController
{
    /**
     * @Route("/", name="photo_index", methods={"GET"})
     */
    public function index(PhotoRepository $photoRepository): Response
    {
        return $this->render('photo/index.html.twig', [
            'photos' => $photoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="photo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $photo = new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $file = $form->get('image')->getData()->getClientOriginalName();
            $info = getimagesize($image);
          
          
            list($largeur,$hauteur) = $info;
           
            $image->move($this->getParameter('app.photos_directory'),$file);

            $path = $this->getParameter('app.photos_directory').'/'.$file;

            $exif = exif_read_data($path, 'EXIF');//donnees enregistrées par l'appareil photo
            if ($exif)
          { $date = $exif['DateTime'];
        

            $date = DateTime::createFromFormat('Y:m:d H:i:s', $date);
          }
           
                $maxwidth = 1000;
                $maxheight = 750;
                if ($hauteur > $largeur)
                {
                    $finalH = $maxheight;
                    $finalL = $largeur * ($finalH/$hauteur);
                }
                else{
                    $finalL = $maxwidth;
                    $finalH = $hauteur * ($finalL/$largeur);
                }
               
                $dst_im = @ImageCreatetruecolor($finalL, $finalH);     
                $src_im = @ImageCreateFromJpeg($path);
                imagecopyresampled($dst_im,$src_im,0,0,0,0,$finalL, $finalH,$largeur,$hauteur);
               
                // Sauve la nouvelle image
                @ImageJpeg($dst_im,$path,100);          
              
             
  
 
            
            $entityManager = $this->getDoctrine()->getManager();
            $photo->setfichier($file);
            if (empty($photo->getDate))
             {
                $photo->setDate($date);
            }
            $entityManager->persist($photo);
            $entityManager->flush();

            return $this->redirectToRoute('photo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('photo/new.html.twig', [
            'photo' => $photo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="photo_show", methods={"GET"})
     */
    public function show(Photo $photo): Response
    {
        return $this->render('photo/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="photo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Photo $photo): Response
    {
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('photo/edit.html.twig', [
            'photo' => $photo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="photo_delete", methods={"POST"})
     */
    public function delete(Request $request, Photo $photo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($photo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('photo_index', [], Response::HTTP_SEE_OTHER);
    }
}
