<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\AnnonceurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// class AnnonceurController extends AbstractController
// {
//     #[Route('/annonceur', name: 'app_annonceur')]
//     public function index(AnnonceurRepository $annonceurRepository): Response
//     {
//         $annonces=$annonceurRepository->annonceListSPA();
//         return $this->render('annonceur/index.html.twig', [
//             'controller_name' => 'AnnonceurController',
//             'annonces' => $annonces
//         ]);
//     }
// }
class AnnonceurController extends AbstractController
{
    #[Route('/annonceur', name: 'app_annonceur')]
    #[IsGranted('ROLE_ANNONCEUR')]
    public function listedemesannonces(AnnonceurRepository $annonceurRepository, AnnonceRepository $annonceRepository): Response
    {
        $annonceur= $this->getUser();
        // $annonces = $annonceur->getAnnonces();
        $annonces = $annonceRepository->findBy(['annonceur' => $annonceur]);
        // dd($annonces);
         return $this->render('annonceur/index.html.twig', [
             'annonceur' => $annonceur,
             'annonces' => $annonces
         ]);

        }
    }