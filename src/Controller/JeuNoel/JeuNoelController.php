<?php

namespace App\Controller\JeuNoel;

use App\Form\WordPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/noel')]
final class JeuNoelController extends AbstractController
{
    #[Route('', name: 'app_noel_index', methods: ['GET','POST'])]
    public function index( Request $request, #[MapQueryParameter]  int $alert = 0): Response
    {
        $form = $this->createForm(WordPasswordType::class, ['label']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['pass'];

            if( $pass === '5')
            {
                return $this->redirectToRoute('app_noel_index', [ 'alert' => 58789639 ]);
            }
            else
            {
                return $this->redirectToRoute('app_noel_index', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuNoel/index.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
