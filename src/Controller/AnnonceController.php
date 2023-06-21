<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\Filtre\FiltreAnnonce;
use App\Form\FiltreAnnonceType;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'app_annonce')]
    public function liste(AnnonceRepository $annonceRepository, Request $request): Response
    {
        $filtre = new FiltreAnnonce();
        $form = $this->createForm(FiltreAnnonceType::class, $filtre);
        $form->handleRequest($request);
        $annonces = $annonceRepository->filtreAnnonce($filtre);
        // dd($annonces);
        return $this->render('annonce/index.html.twig', [
            'liste' => $annonces,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/annonce/{id}', name: 'annonce_show', requirements: ['id' => "\d+"])]
    public function show(Annonce $annonce): Response
    {
        if (is_null($annonce)) {
            throw $this->createNotFoundException();
        }

        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }
}
