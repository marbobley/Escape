<?php

declare(strict_types=1);

namespace App\Controller\JeuTv;

use App\Service\NormalizerString;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class JeuTvController extends AbstractController
{
    public function __construct(private NormalizerString $normalizer)
    {
    }

    #[Route('/jeu-tv', name: 'app_tv_home')]
    public function index(): Response
    {
        return $this->render('tv/home.html.twig');
    }

    #[Route('/jeu-tv/question-champion', name: 'app_tv_champion')]
    public function champion(Request $request, #[MapQueryParameter] int $alert = 0): Response
    {
        $form = $this->createFormBuilder()
            ->add('reponse', TextType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $this->normalizer->normalizeStringToUpperCaseWithNoAccent($data['reponse']);
            $responseNormalized = $this->normalizer->normalizeStringToUpperCaseWithNoAccent('OURSINIERES');
            $responseNormalized2 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent('LES OURSINIERES');
            $responseNormalized3 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent('le port des OURSINIERES');

            if ($responseNormalized === $pass
                || $responseNormalized2 == $pass
                || $responseNormalized3 == $pass) {
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

            $pass1 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent($data['reponse1']);
            $pass2 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent($data['reponse2']);
            $responseNormalized1 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent('VILLA');
            $responseNormalized2 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent('ARTAUDE');



            if ($responseNormalized1 === $pass1 && $responseNormalized2 === $pass2) {
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
            ->add('reponse', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();


            $pass = $this->normalizer->normalizeStringToUpperCaseWithNoAccent($data['reponse']);
            $responseNormalized1 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent('LE PETIT PRE');

            if ($responseNormalized1 === $pass) {
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
            ->add('reponse', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $pass = $this->normalizer->normalizeStringToUpperCaseWithNoAccent($data['reponse']);
            $responseNormalized1 = $this->normalizer->normalizeStringToUpperCaseWithNoAccent('JEUX');

            if ($responseNormalized1 === $pass) {
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
