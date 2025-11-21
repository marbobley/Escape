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

final class MiniBossController extends AbstractController
{
    #[Route('/miniboss/casse-tete', name: 'app_miniboss_cassetete')]
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
                $sessionService->initCombatFinal($request->getSession());
                return $this->redirectToRoute('app_miniboss_cassetete', [ 'alert' => 784599871 ]);
            }
            else
            {
                return $this->redirectToRoute('app_miniboss_cassetete', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/miniboss/cassetete.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/miniboss/mathematique', name: 'app_miniboss_mathematique')]
    public function mathematique(Request $request, SessionService $sessionService, #[MapQueryParameter]  int $alert = 0) : Response
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
                $sessionService->initCombatFinal($request->getSession());
                return $this->redirectToRoute('app_miniboss_mathematique', [ 'alert' => 784599871 ]);
            }
            else
            {
                return $this->redirectToRoute('app_miniboss_mathematique', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/miniboss/mathematique.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }


}
