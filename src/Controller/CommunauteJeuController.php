<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/communaute')]
final class CommunauteJeuController extends AbstractController
{
    #[Route('', name: 'app_communaute_jeu_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('communaute-jeu/index.html.twig', []);
    }

    #[Route('/premier_niveau', name: 'app_communaute_jeu_premier_niveau', methods: ['GET'])]
    public function premier_niveau(Request $request): Response
    {
        $session = $request->getSession();
        $startDay = $session->get('start');
        if(!isset($startDay))
        {
            $session->set('start', new \DateTimeImmutable('now'));
        }
        return $this->render('communaute-jeu/premier_niveau.html.twig', []);
    }

    #[Route('/premier_niveau/premier_pierre_descendre', name: 'app_communaute_jeu_premier_pierre_descendre', methods: ['GET'])]
    public function premiere_pierre_descendre(Request $request, SessionService $sessionService) : Response
    {
        $session = $request->getSession();
        $clef4 = $session->get('clef-4');
        if(isset($clef4)){
            return $this->render('communaute-jeu/premier_niveau_deuxieme_pierre_descendre.html.twig', []);
        }

        $sessionService->increaseDeath($session);

        return $this->render('communaute-jeu/premier_niveau_premier_pierre_descendre.html.twig', []);
    }

    #[Route('/premier_niveau/premier_pierre_enlever', name: 'app_communaute_jeu_premier_pierre_enlever', methods: ['GET'])]
    public function premiere_pierre_enlever(Request $request) : Response
    {
        $session = $request->getSession();
        $session->set('clef-33', true);
        return $this->render('communaute-jeu/premier_niveau_premier_pierre_enlever.html.twig', []);
    }

    #[Route('/premier_niveau/deuxieme_pierre_descendre', name: 'app_communaute_jeu_deuxieme_pierre_descendre', methods: ['GET'])]
    public function deuxieme_pierre_descendre(Request $request) : Response
    {
        return $this->render('communaute-jeu/premier_niveau_deuxieme_pierre_descendre.html.twig', []);
    }

    #[Route('/premier_niveau/deuxieme_pierre_enlever', name: 'app_communaute_jeu_deuxieme_pierre_enlever', methods: ['GET'])]
    public function deuxieme_pierre_enlever(Request $request) : Response
    {
        $session = $request->getSession();
        $session->set('clef-4', true);
        return $this->render('communaute-jeu/premier_niveau_deuxieme_pierre_enlever.html.twig', []);
    }


    #[Route('/premier_niveau/deuxieme_niveau', name: 'app_communaute_jeu_deux_ouvert', methods: ['GET','POST'])]
    public function jeu_deux(Request $request): Response{

        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass', TextType::class, ['label' => 'Mot de passe : '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['pass'];
            if($pass === '33-4')
            {
                return $this->redirectToRoute('app_communaute_jeu_deux_bon_pass');
            }
            else
            {
                return $this->redirectToRoute('app_communaute_jeu_deux_mauvais_pass');
            }
        }

        return $this->render('communaute-jeu/deuxieme_niveau_ouverture.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/premier_niveau/deuxieme_niveau_brute', name: 'app_communaute_jeu_deux_brute', methods: ['GET'])]
    public function jeu_deux_brute(Request $request, SessionService $sessionService): Response{
        $sessionService->increaseDeath($request->getSession());
        return $this->render('communaute-jeu/deuxieme_niveau_brute.html.twig', []);
    }

    #[Route('/premier_niveau/deuxieme_niveau/ouverture', name: 'app_communaute_jeu_deux_bon_pass')]
    public function jeu_deux_bon_pass(Request $request, SessionService $sessionService){
        $sessionService->initEscalier($request->getSession());
        return $this->render('communaute-jeu/deuxieme_niveau_bon_pass.html.twig', []);
    }

    #[Route('/premier_niveau/deuxieme_niveau/mauvais', name: 'app_communaute_jeu_deux_mauvais_pass')]
    public function jeu_deux_mauvais_pass(Request $request, SessionService $sessionService){
        $sessionService->increaseDeath($request->getSession());
        return $this->render('communaute-jeu/deuxieme_niveau_mauvais_pass.html.twig', []);
    }
}
