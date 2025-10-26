<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/communaute')]
final class CommunauteJeuController extends AbstractController
{
    #[Route('', name: 'app_communaute_jeu_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('communaute-jeu/index.html.twig', []);
    }

    #[Route('/premier_niveau', name: 'app_communaute_jeu_premier_niveau', methods: ['GET'])]
    public function premier_niveau(Request $request): Response
    {
        return $this->render('communaute-jeu/premier_niveau.html.twig', []);
    }

    #[Route('/premier_niveau/premier_pierre_descendre', name: 'app_communaute_jeu_premier_pierre_descendre', methods: ['GET'])]
    public function premiere_pierre_descendre(Request $request) : Response
    {
        $session = $request->getSession();
        $clef4 = $session->get('clef-4');
        $clef33 = $session->get('clef-33');
        if(isset($clef4)){
            return $this->render('communaute-jeu/premier_niveau_deuxieme_pierre_descendre.html.twig', []);
        }

        $currentNombreMort = $session->get('nombre-mort');
        if(!isset($currentNombreMort))
        {
            $currentNombreMort = 0;
        }
        // stores an attribute for reuse during a later user request
        $currentNombreMort++;
        $session->set('nombre-mort', $currentNombreMort);


        return $this->render('communaute-jeu/premier_niveau_premier_pierre_descendre.html.twig', []);
    }

    #[Route('/premier_niveau/premier_pierre_enlever', name: 'app_communaute_jeu_premier_pierre_enlever', methods: ['GET'])]
    public function premiere_pierre_enlever(Request $request) : Response
    {
        $session = $request->getSession();
        $session->set('clef-33', true);
        return $this->render('communaute-jeu/premier_niveau_premier_pierre_enlever.html.twig', []);
    }

    #[Route('/premier_niveau/deuxieme_pierre_descendre', name: 'app_communaute_jeu_deuxieme_pierre_descendre', methods: ['GET'])]
    public function deuxieme_pierre_descendre(Request $request) : Response
    {
        return $this->render('communaute-jeu/premier_niveau_deuxieme_pierre_descendre.html.twig', []);
    }

    #[Route('/premier_niveau/deuxieme_pierre_enlever', name: 'app_communaute_jeu_deuxieme_pierre_enlever', methods: ['GET'])]
    public function deuxieme_pierre_enlever(Request $request) : Response
    {
        $session = $request->getSession();
        $session->set('clef-4', true);
        return $this->render('communaute-jeu/premier_niveau_deuxieme_pierre_enlever.html.twig', []);
    }

}
