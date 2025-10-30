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
        $sessionService->initEscalier($request->getSession());
        return $this->render('catacombe/index.html.twig', [
        ]);
    }

}
