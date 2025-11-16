<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CatacombeNiveauDeuxController extends AbstractController
{
    #[Route('/catacombe/deux/entree', name: 'app_catacombe_deux_index')]
    public function index(Request $request, SessionService $sessionService) : Response
    {
        $sessionService->setCatacombeOpen($request->getSession());
        return $this->render('catacombe/index.html.twig');
    }
}
