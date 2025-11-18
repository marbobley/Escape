<?php

namespace App\Controller\JeuCommunaute;

use App\Model\Constantes;
use App\Model\ObjetAventure;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use function PHPUnit\Framework\stringContains;

final class CatacombeNiveauDeuxController extends AbstractController
{

    #[Route('/catacombe/deux/exclamer', name: 'app_catacombe_deux_exclamer')]
    public function exclamer() : Response{

        return $this->render('JeuCommunaute/catacombe_deux/exclamer.html.twig');
    }
    #[Route('/catacombe/deux/traverser', name: 'app_catacombe_deux_traverser')]
    public function traverser(Request $request, #[MapQueryParameter]  int $alert = 0){

        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass0', TextType::class, ['label' => 'Le lieu : '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass0 = $data['pass0'];

            if( str_contains(strtoupper($pass0), 'TRABUC'))
            {
                return $this->redirectToRoute('app_catacombe_deux_traverser', [ 'alert' => 33259492 ]);
            }
            else
            {
                return $this->redirectToRoute('app_catacombe_deux_traverser', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/catacombe_deux/traverser.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/catacombe/deux/entree', name: 'app_catacombe_deux_index')]
    public function index(Request $request,#[MapQueryParameter]  int $alert = 0) : Response
    {
        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass0', TextType::class, ['label' => 'Votre chemin : '])
            ->add('pass1', TextType::class, ['label' => 'La couleur : '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass0 = $data['pass0'];
            $pass1 = $data['pass1'];

            if(strtoupper($pass0) === 'INFINI' && (strtoupper($pass1) === 'DOREE' || strtoupper($pass1) === strtoupper('Dorée')))
            {
                return $this->redirectToRoute('app_catacombe_deux_index', [ 'alert' => 22546569 ]);
            }
            else
            {
                return $this->redirectToRoute('app_catacombe_deux_index', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/catacombe_deux/index.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
