<?php

declare(strict_types=1);

namespace App\Controller\JeuTv;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $form = $this->createFormBuilder()
            ->add('reponse', TextType::class,)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = strtolower((string) $data['reponse']);

            if ('oursinières' === $pass || 'Oursinières' === $pass || 'Oursinieres' === $pass|| 'oursinieres' === $pass) {
                return $this->redirectToRoute('app_tv_champion', ['alert' => 2]);
            }

            return $this->redirectToRoute('app_tv_champion', ['alert' => 1]);
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
            ->add('reponse1', TextType::class, ['label' => 'Complétez ce mot : La V _ _ _ A  (Indice : Mandrot)'])
            ->add('reponse2', TextType::class, ['label' => ' de l A _ _ _ _ _ E '])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ('VILLA' === strtoupper((string) $data['reponse1']) && 'ARTAUDE' === strtoupper((string) $data['reponse2'])) {
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
                'choices' => [
                    '273' => '273',
                    '283' => '283',
                    '293' => '293',
                    '303' => '303',
                ],
                'expanded' => true,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ('293' === $data['reponse']) {
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
            ->add('reponse', TextType::class,)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ('PETIT PRE' === strtoupper((string) $data['reponse'])) {
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
    public function fin(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createFormBuilder()
            ->add('reponse', TextType::class,)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ('JEUX' === strtoupper((string) $data['reponse'])) {
                return $this->redirectToRoute('app_tv_fin', ['alert' => 2]);
            }

            return $this->redirectToRoute('app_tv_fin', ['alert' => 1]);
        }

        return $this->render('tv/fin.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
