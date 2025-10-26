<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SSGController extends AbstractController
{
    #[Route('/ssg', name: 'app_ssg_index')]
    public function index(): Response
    {
        return $this->render('ssg/index.html.twig', [
            'controller_name' => 'SSGController',
        ]);
    }
}
