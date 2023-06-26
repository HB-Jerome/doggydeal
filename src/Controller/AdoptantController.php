<?php

namespace App\Controller;

use App\Entity\Adoptant;
use App\Form\AdoptantType;
use App\Form\PasswordModifyType;
use App\Repository\AdoptionOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdoptantController extends AbstractController
{
    #[Route('/adoptant', name: 'app_adoptant')]
    #[IsGranted('ROLE_ADOPTANT')]

    public function modif(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher, AdoptionOfferRepository $adoptionOfferRepository): Response
    {
        /** @var Adoptant */
        $adoptant = $this->getUser();
        $form = $this->createForm(AdoptantType::class, $adoptant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l’entité manager qui va nous permettre de sa
            $em->persist($adoptant);
            $em->flush();

            $this->addFlash('success', 'Data inserted');
            return $this->redirectToRoute('app_adoptant');
        }
        
        $formPassword = $this->createForm(PasswordModifyType::class, $adoptant);
        $formPassword->handleRequest($request);
        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            $adoptantPassword = $adoptant->getPlainPassword();

            $adoptant->setPassword(

                $hasher->hashPassword(
                    $adoptant,
                    $adoptantPassword
                )
            );

            $em->persist($adoptant);
            $em->flush();

            $this->addFlash('success', 'Password Changed');
            return $this->redirectToRoute('app_adoptant');
            
        }
            return $this->render('adoptant/index.html.twig', [
                "form" => $form->createView(),
                "formPassword" => $formPassword->createView(),
            ]);
        
    }
}
