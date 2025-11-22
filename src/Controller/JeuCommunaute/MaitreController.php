<?php

namespace App\Controller\JeuCommunaute;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class MaitreController extends AbstractController
{
    #[Route('/metre/combat', name: 'app_boss_combat')]
    public function index() : Response
    {
        return $this->render('JeuCommunaute/boss/combat.html.twig');
    }

    #[Route('/metre/combat/enerver', name: 'app_boss_combat_enerve')]
    public function combat() : Response
    {
        return $this->render('JeuCommunaute/boss/combat-transform.html.twig');
    }

    #[Route('/metre/combat/transforme', name: 'app_boss_combat_transformer')]
    public function transformer() : Response
    {
        return $this->render('JeuCommunaute/boss/combat-transformer.html.twig');
    }

    #[Route('/metre/combat/transforme/fuite', name: 'app_boss_combat_transformer_fuite')]
    public function fuite() : Response
    {
        return $this->render('JeuCommunaute/boss/combat-transformer-fuite.html.twig');
    }
    #[Route('/metre/combat/transforme/fuite/suivre', name: 'app_boss_combat_transformer_fuite_suivre')]
    public function suivre() : Response
    {
        return $this->render('JeuCommunaute/boss/combat-transformer-fuite-suivre.html.twig');
    }

    #[Route('/il/faut/mettre/le/bon/mot/de/passe/ici', name: 'app_boss_combat_transformer_fuite_suivre_parchemin')]
    public function parchemin() : Response
    {
        return $this->render('JeuCommunaute/boss/combat-transformer-fuite-suivre-parchemin.html.twig');
    }

    #[Route('/ifmlbmdpi', name: 'app_boss_combat_transformer_fuite_suivre_parchemin_compris_1')]
    #[Route('/il/faut/mettre/le/bon/mot/de/passe/ifmlbmdpi', name: 'app_boss_combat_transformer_fuite_suivre_parchemin_compris_2')]
    public function parchemin_decoder() : Response
    {
        return $this->render('JeuCommunaute/boss/combat-transformer-fuite-suivre-parchemin.html.twig');
    }
    #[Route('/metre/combat/oeil_dun_cote', name: 'app_boss_oeil_droite')]
    public function oeil_droite(Request $request, SessionService $sessionService, #[MapQueryParameter]  int $alert = 0) : Response
    {

        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass0', TextType::class, ['label' => ' '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass0 = $data['pass0'];

            if( $pass0 === '7')
            {
                $sessionService->initOeilDroit($request->getSession());
                return $this->redirectToRoute('app_boss_oeil_droite', [ 'alert' => 45727828 ]);
            }
            else
            {
                return $this->redirectToRoute('app_boss_oeil_droite', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/boss/oeil_droite.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
    #[Route('/metre/combat/oeil_de_lautre', name: 'app_boss_oeil_gauche')]
    public function oeil_gauche(Request $request, SessionService $sessionService, #[MapQueryParameter]  int $alert = 0) : Response
    {

        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass0', TextType::class, ['label' => ' '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass0 = $data['pass0'];

            if( $pass0 === '1')
            {
                $sessionService->initOeilGauche($request->getSession());
                return $this->redirectToRoute('app_boss_oeil_gauche', [ 'alert' => 124879796 ]);
            }
            else
            {
                return $this->redirectToRoute('app_boss_oeil_gauche', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/boss/oeil_gauche.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
