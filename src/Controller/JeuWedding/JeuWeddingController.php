<?php

declare(strict_types=1);

namespace App\Controller\JeuWedding;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JeuWeddingController extends AbstractController
{
    #[Route('/jeu-wedding')]
    public function index(): Response
    {
        return $this->render('wedding/home/home.html.twig');
    }
}
