<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationAnnonceController extends AbstractController
{
    #[Route('/creation', name: 'app_creation_annonce')]
    public function index(): Response
    {
        return $this->render('creation_annonce/index.html.twig', [
            'controller_name' => 'CreationAnnonceController',
        ]);
    }
}
