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
    public function cassetete(Request $request, SessionService $sessionService, #[MapQueryParameter]  int $alert = 0) : Response
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

            if( $pass0 === '5')
            {
                return $this->redirectToRoute('app_boss_combat', [ 'alert' => 8568918469 ]);
            }
            else
            {
                return $this->redirectToRoute('app_boss_combat', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/boss/combat.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
