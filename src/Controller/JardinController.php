<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JardinController extends AbstractController
{
    #[Route('/jardin', name: 'app_entree_jardin')]
    public function index(Request $request, SessionService $sessionService) : Response
    {
        return $this->render('jardin/entree-jardin.html.twig', [
        ]);
    }

}
