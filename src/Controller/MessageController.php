<?php

namespace App\Controller;

use App\Entity\Adoptant;
use App\Repository\AdoptionOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MessageController extends AbstractController
{
    #[Route('/message', name: 'app_message')]
    #[IsGranted('ROLE_ADOPTANT')]
    public function index(AdoptionOfferRepository $adoptionOfferRepository): Response
    {
        /** @var Adoptant */
        $user = $this->getUser();

        $offers = $adoptionOfferRepository->findBy([
            'adoptant' => $user
        ]);

        return $this->render('message/index.html.twig', [
            'offers' => $offers,
        ]);
    }
}