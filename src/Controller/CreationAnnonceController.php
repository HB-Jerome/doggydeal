<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreationAnnonceType;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CreationAnnonceController extends AbstractController
{
    #[IsGranted('ROLE_ANNONCEUR')]
    #[Route('/modifcation/{id}', name: 'app_modification_annonce')]
    #[Route('/creation', name: 'app_creation_annonce')]
    public function index(Request $request, AnnonceRepository $annonceRepository, ?Annonce $annonce): Response
    {
        if($annonce==null){
            $annonce = new Annonce();
            $annonceur =$this->getUser();
            $annonce->setAnnonceur($annonceur);
        }
        if($annonce->getAnnonceur() != $this->getUser()){

            $this->addFlash('danger',"Vous n'avez pas les permissions pour modifier cette annonce");
            return $this->redirectToRoute('app_login');
            
        }

        $form = $this->createForm(CreationAnnonceType::class, $annonce);
    
        // On dit explicitement au formulaire de traiter ce que contient la requête (objet Request)
        $form->handleRequest($request);
    
        // On regarde si le formulaire a été soumis ET est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On enregistre
            $annonceRepository->save($annonce, true);
            
            // On peut également afficher un message à l'utilisateur
            // Les flashs sont affichés une fois, au chargement de la page suivante
            // Et permettent donc d'afficher un message, malgré une redirection
            $this->addFlash('success', 'Donnée insérée');
    
            // Une fois que le formulaire est validé,
            // on redirige pour éviter que l'utilisateur ne recharge la page
            // et soumette la même information une seconde fois
            return $this->redirectToRoute('app_annonceur');
        }
    
        return $this->render('creation_annonce/index.html.twig', [
            'form' => $form->createView(), // On crée un objet FormView, qui sert à l'affichage de notre formulaire
        ]);
    }
    }
