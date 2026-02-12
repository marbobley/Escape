<?php

declare(strict_types=1);

namespace App\Controller\JeuTv;

use App\Form\WordPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class JeuTvController extends AbstractController
{
    #[Route('/jeu-tv', name: 'app_tv_home')]
    public function index(): Response
    {
        return $this->render('tv/home.html.twig');
    }

    #[Route('/jeu-tv/question-champion', name: 'app_tv_champion')]
    public function champion(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createForm(WordPasswordType::class,
            ['label' => 'Je suis un animateur emblématique, je porte souvent des lunettes et j\'anime ce jeu depuis des décennies. Qui suis-je ?']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = strtolower((string) $data['pass']);

            if ('julien lepers' === $pass || 'lepers' === $pass) {
                return $this->redirectToRoute('app_tv_champion', ['alert' => 2]);
            } else {
                return $this->redirectToRoute('app_tv_champion', ['alert' => 1]);
            }
        }

        return $this->render('tv/questions_champion.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/jeu-tv/slam', name: 'app_tv_slam')]
    public function slam(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createFormBuilder()
            ->add('reponse', TextType::class, ['label' => 'Complétez ce mot : C _ _ _ _ _ R (Indice : Cyril Féraud)'])
            ->add('save', SubmitType::class, ['label' => 'Slammer !'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ('CLAVIER' === strtoupper((string) $data['reponse'])) {
                return $this->redirectToRoute('app_tv_slam', ['alert' => 2]);
            }

            return $this->redirectToRoute('app_tv_slam', ['alert' => 1]);
        }

        return $this->render('tv/slam.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/jeu-tv/millions', name: 'app_tv_millions')]
    public function millions(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createFormBuilder()
            ->add('reponse', ChoiceType::class, [
                'label' => 'C\'est votre dernier mot ? Quelle est la capitale de la France ?',
                'choices' => [
                    'Lyon' => 'lyon',
                    'Marseille' => 'marseille',
                    'Paris' => 'paris',
                    'Lille' => 'lille',
                ],
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ('paris' === $data['reponse']) {
                return $this->redirectToRoute('app_tv_millions', ['alert' => 2]);
            }

            return $this->redirectToRoute('app_tv_millions', ['alert' => 1]);
        }

        return $this->render('tv/gagner_millions.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/jeu-tv/intervilles', name: 'app_tv_intervilles')]
    public function intervilles(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createFormBuilder()
            ->add('reponse', TextType::class, ['label' => 'Quel animal est l\'emblème d\'Intervilles ?'])
            ->add('save', SubmitType::class, ['label' => 'Top à la vachette !'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ('VACHETTE' === strtoupper((string) $data['reponse'])) {
                return $this->redirectToRoute('app_tv_intervilles', ['alert' => 2]);
            }

            return $this->redirectToRoute('app_tv_intervilles', ['alert' => 1]);
        }

        return $this->render('tv/intervilles.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/jeu-tv/fin', name: 'app_tv_fin')]
    public function fin(): Response
    {
        return $this->render('tv/fin.html.twig');
    }
}
