<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\AnnonceurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    // J'appelle deux repo : l'annonce et l'annonceur
    public function Index(AnnonceRepository $annonceRepository, AnnonceurRepository $annonceurRepository): Response
    {
        $annonces = $annonceRepository->annonceList();
        $annonceurs = $annonceurRepository->annonceListSPA();

        return $this->render('default/index.html.twig', [
            'annonces' => $annonces,
            'annonceurs' => $annonceurs,
        ]);
    }
}
