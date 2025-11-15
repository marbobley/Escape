<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CatacombeController extends AbstractController
{
    #[Route('/chemin/victoire', name: 'app_catacombe_index')]
    public function index(Request $request, SessionService $sessionService) : Response
    {
        $sessionService->setCatacombeOpen($request->getSession());
        return $this->render('catacombe/index.html.twig');
    }

    #[Route('/catacombe/droite', name: 'app_catacombe_droite')]
    public function droite(Request $request, SessionService $sessionService) : Response
    {
        return $this->render('catacombe/droite.html.twig');
    }
    #[Route('/catacombe/gauche', name: 'app_catacombe_gauche')]
    public function gauche(Request $request, SessionService $sessionService) : Response
    {
        return $this->render('catacombe/gauche.html.twig');
    }

    #[Route('/catacombe/gauche/gauche', name: 'app_catacombe_gauche_2')]
    public function gauche2(Request $request, SessionService $sessionService) : Response
    {
        return $this->render('catacombe/gauche_2.html.twig');
    }

    #[Route('/catacombe/gauche/gauche/gauche', name: 'app_catacombe_gauche_3')]
    public function gauche3(Request $request, SessionService $sessionService) : Response
    {
        return $this->render('catacombe/gauche_3.html.twig');
    }

}
