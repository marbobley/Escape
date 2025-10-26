<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CommunauteJeuController extends AbstractController
{
    #[Route('/communaute', name: 'app_communaute_jeu_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('communaute-jeu/index.html.twig', [
            'controller_name' => 'SSGController',
        ]);
    }

    #[Route('/communaute/premier_niveau', name: 'app_communaute_jeu_premier_niveau', methods: ['GET'])]
    public function premier_niveau(): Response
    {
        return $this->render('communaute-jeu/premier_niveau.html.twig', [
            'controller_name' => 'SSGController',
        ]);
    }
}
