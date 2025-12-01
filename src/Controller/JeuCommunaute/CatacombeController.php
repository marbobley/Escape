<?php

namespace App\Controller\JeuCommunaute;

use App\Service\EscalierService;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CatacombeController extends AbstractController
{
    #[Route('/chemin/victoire', name: 'app_catacombe_index')]
    public function index(Request $request, SessionService $sessionService): Response
    {
        $sessionService->setCatacombeOpen($request->getSession());

        return $this->render('JeuCommunaute/catacombe/index.html.twig');
    }

    #[Route('/catacombe/droite', name: 'app_catacombe_droite')]
    public function droite(): Response
    {
        return $this->render('JeuCommunaute/catacombe/droite.html.twig');
    }

    #[Route('/catacombe/droite/droite', name: 'app_catacombe_droite_2')]
    public function droite2(): Response
    {
        return $this->render('JeuCommunaute/catacombe/droite_2.html.twig');
    }

    #[Route('/catacombe/droite/droite/droite', name: 'app_catacombe_droite_3')]
    public function droite3(): Response
    {
        return $this->render('JeuCommunaute/catacombe/droite_3.html.twig');
    }

    #[Route('/catacombe/gauche', name: 'app_catacombe_gauche')]
    public function gauche(): Response
    {
        return $this->render('JeuCommunaute/catacombe/gauche.html.twig');
    }

    #[Route('/catacombe/gauche/gauche', name: 'app_catacombe_gauche_2')]
    public function gauche2(): Response
    {
        return $this->render('JeuCommunaute/catacombe/gauche_2.html.twig');
    }

    #[Route('/catacombe/gauche/gauche/gauche', name: 'app_catacombe_gauche_3')]
    public function gauche3(): Response
    {
        return $this->render('JeuCommunaute/catacombe/gauche_3.html.twig');
    }

    #[Route('/catacombe/retour', name: 'app_catacombe_retour')]
    public function retour_catacombe(EscalierService $escalierService, SessionService $sessionService): Response
    {
        $sessionService->initFinalEscalier();
        $escalierService->resetEscalier();

        return $this->render('JeuCommunaute/catacombe/retour.html.twig');
    }
}
