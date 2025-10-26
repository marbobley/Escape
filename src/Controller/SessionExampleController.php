<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionExampleController extends AbstractController
{
    #[Route('/session/example', name: 'app_session_example')]
    public function index(Request $request): Response
    {
        return $this->render('session_example/index.html.twig', [
            'controller_name' => 'SessionExampleController',
        ]);
    }
}
