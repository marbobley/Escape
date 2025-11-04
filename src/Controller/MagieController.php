<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class MagieController extends AbstractController
{
    #[Route('/premier_sort', name: 'app_magie_premier_sort')]
    public function index(Request $request, SessionService $sessionService, #[MapQueryParameter] int $alert = 0): Response
    {
        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass0', RangeType::class, ['label' => '1 : ', 'attr' => [
                'min' => 0,
                'max' => 4
            ]])
            ->add('pass1', RangeType::class, ['label' => '2 : ', 'attr' => [
                'min' => 0,
                'max' => 4
            ]])
            ->add('pass2', RangeType::class, ['label' => '3 : ', 'attr' => [
                'min' => 0,
                'max' => 4
            ]])
            ->add('pass3', RangeType::class, ['label' => '4 : ', 'attr' => [
                'min' => 0,
                'max' => 4
            ]])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass0 = $data['pass0'];
            $pass1 = $data['pass1'];
            $pass2 = $data['pass2'];
            $pass3 = $data['pass3'];

            if($pass0 === '0' && $pass1 === '4' && $pass2 === '2' && $pass3 === '1' )
            {
                $sessionService->initMagie($request->getSession(), 2);
                return $this->redirectToRoute('app_jardin_secret');
            }
            else
            {
                return $this->redirectToRoute('app_magie_premier_sort', [ 'alert' => 1 ]);
            }
        }

        return $this->render('magie/premier_sort.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
