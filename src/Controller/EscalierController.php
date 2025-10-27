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
        $escalier = $sessionService->increaseEscalier($request->getSession());

        return $this->render('escalier/index.html.twig', [
            'escalier' => $escalier,
        ]);
    }

    #[Route('/escalier/descendre', name: 'app_escalier_descendre')]
    public function descendre(Request $request, SessionService $sessionService) : Response
    {
        $escalier = $sessionService->decreaseEscalier($request->getSession());

        return $this->render('escalier/index.html.twig', [
            'escalier' => $escalier,
        ]);
    }
}
