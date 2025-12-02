<?php

declare(strict_types=1);

namespace App\Controller\JeuWedding;

use App\Form\WordPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class JeuWeddingController extends AbstractController
{
    #[Route('/jeu-wedding', name: 'app_wedding_home')]
    public function index(): Response
    {
        return $this->render('wedding/home/home.html.twig');
    }

    #[Route('/jeu-wedding/serments', name: 'app_wedding_serments')]
    public function serments(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createForm(WordPasswordType::class, ['label']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['pass'];

            if ('love' === $pass) {
                return $this->redirectToRoute('app_wedding_serments', ['alert' => 2]);
            } else {
                return $this->redirectToRoute('app_wedding_serments', ['alert' => 1]);
            }
        }

        return $this->render('wedding/home/serment.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/jeu-wedding/quizz', name: 'app_wedding_quizz')]
    public function quizz(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('question1', TextType::class, ['label' => 'Mon deuxieme prénom : '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['question1'];

            if ('love' === $pass) {
                return $this->redirectToRoute('app_wedding_quizz', ['alert' => 2]);
            } else {
                return $this->redirectToRoute('app_wedding_quizz', ['alert' => 1]);
            }
        }

        return $this->render('wedding/home/quizz.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
