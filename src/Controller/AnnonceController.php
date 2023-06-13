<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'app_annonce')]
    public function liste(AnnonceRepository $annonceRepository): Response
    {
        $annonces = $annonceRepository->findAll();
        // dd($annonces);
        return $this->render('annonce/index.html.twig', [
            'liste' => $annonces,
        ]);
    }
}
