<?php

namespace App\Controller\JeuNoel;

use App\Form\WordPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/noel')]
final class JeuNoelController extends AbstractController
{
    #[Route('', name: 'app_noel_index', methods: ['GET', 'POST'])]
    public function index(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createForm(WordPasswordType::class, ['label']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['pass'];

            if ('031225' === $pass) {
                return $this->redirectToRoute('app_noel_index', ['alert' => 58789639]);
            } else {
                return $this->redirectToRoute('app_noel_index', ['alert' => 1]);
            }
        }

        return $this->render('JeuNoel/index.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/premier_jeu', name: 'app_noel_jeu_un', methods: ['GET', 'POST'])]
    public function premierJeu(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        return $this->render('JeuNoel/premier-jeu.html.twig');
    }

    #[Route('/premier_jeu/elf-trouve', name: 'app_noel_jeu_deux', methods: ['GET', 'POST'])]
    public function deuxiemeJeu(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        return $this->render('JeuNoel/deuxieme-jeu.html.twig');
    }
}
