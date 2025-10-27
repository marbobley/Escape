<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EscalierController extends AbstractController
{
    #[Route('/escalier', name: 'app_escalier')]
    public function index(Request $request, SessionService $sessionService) : Response
    {
        $sessionService->initEscalier($request->getSession());
        return $this->render('escalier/index.html.twig', [
        ]);
    }
    #[Route('/escalier/monter', name: 'app_escalier_monter')]
    public function monter(Request $request, SessionService $sessionService) : Response
    {
        $escalier = $sessionService->increaseEscalier($request->getSession());

        return $this->render('escalier/monter.html.twig', [
        ]);
    }

    #[Route('/escalier/descendre', name: 'app_escalier_descendre')]
    public function descendre(Request $request, SessionService $sessionService) : Response
    {
        $escalier = $sessionService->decreaseEscalier($request->getSession());

        return $this->render('escalier/descendre.html.twig', [
        ]);
    }

    #[Route('/escalier/regarder', name: 'app_escalier_regarder')]
    public function regarder(Request $request, SessionService $sessionService) : Response
    {
        $escalier = $sessionService->getEscalier($request->getSession());

        $filename = 'images/jeu_escalier_' .  $escalier . '.wepb';

        return $this->render('escalier/regarder.html.twig', [
            'filename' => $filename
        ]);
    }
    #[Route('/escalier/cailloux', name: 'app_escalier_cailloux')]
    public function cailloux(Request $request, SessionService $sessionService) : Response
    {

        return $this->render('escalier/cailloux.html.twig', [
        ]);
    }
}
