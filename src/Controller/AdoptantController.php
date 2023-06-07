<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdoptantController extends AbstractController
{
    #[Route('/adoptant', name: 'app_adoptant')]
    public function index(): Response
    {
        return $this->render('adoptant/index.html.twig', [
            'controller_name' => 'AdoptantController',
        ]);
    }
}
