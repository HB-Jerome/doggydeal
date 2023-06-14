<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function Index(AnnonceRepository $annonceRepository): Response
    {
        $annonces = $annonceRepository->annonceList();

        return $this->render('default/index.html.twig', [
            'annonces' => $annonces, 
        ]);
    }
}