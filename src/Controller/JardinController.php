<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class JardinController extends AbstractController
{
    #[Route('/jardin', name: 'app_entree_jardin')]
    public function index(Request $request,
                          SessionService $sessionService
    #[MapQueryParameter] int $alert = 0) : Response
    {
        return $this->render('jardin/entree-jardin.html.twig');
    }

    #[Route('/jardin/secret', name: 'app_jardin_secret')]
    public function jardin_secret(Request $request, SessionService $sessionService) : Response{

        $sessionService->initMagie($request->getSession(), 1);
        return $this->render('jardin/entree-jardin-passage-secret.html.twig');
    }

}
