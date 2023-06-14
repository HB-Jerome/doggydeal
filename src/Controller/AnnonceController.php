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

    #[Route('/annonce/{id}', name: 'annonce_show')]
    public function show(int $id, AnnonceRepository $annonceRepository): Response
    {
        $annonce = $annonceRepository->find($id);

        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    // Version alternative (param converter) : https://formation-hb.drakolab.fr/symfony/24-doctrine.html#le-paramconverter-de-doctrine
    // public function show(Annonce $annonce): Response
    // {
    //     return $this->render('annonce/show.html.twig', [
    //         'annonce' => $annonce,
    //     ]);
    // }

}
