<?php

namespace App\Controller;

use App\Model\Constantes;
use App\Model\ObjetAventure;
use App\Service\InventaireService;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class JardinController extends AbstractController
{
    #[Route('/jardin/dedans', name: 'app_jardin')]
    public function jardin(Request $request,
                           SessionService $sessionService,
    InventaireService $inventaireService) : Response
    {
        $sessionService->setTrollJardinDead($request->getSession());

        $keyFound = new ObjetAventure(Constantes::pipette(), 'Retrouve les couleurs', 'Ou est-ce que je peux retrouver ça ?');

        $currentInventaire = $sessionService->getCurrentInventaire($request->getSession());
        $inventaireService->addOrReplace(Constantes::pipette(), $keyFound ,$currentInventaire);
        $sessionService->setCurrentInventaire($request->getSession(), $currentInventaire);

        return $this->render('jardin/jardin.html.twig', );
    }
    #[Route('/jardin', name: 'app_entree_jardin')]
    public function jardin_entree(Request $request,
                          SessionService $sessionService,
                          #[MapQueryParameter] string $sortTete = "",
                          #[MapQueryParameter] string $sortMain = "") : Response
    {
        return $this->render('jardin/entree-jardin.html.twig', [
            'sortTete' => $sortTete,
            'sortMain' => $sortMain
            ]);
    }

    #[Route('/jardin/secret', name: 'app_jardin_secret')]
    public function jardin_secret(Request $request, SessionService $sessionService) : Response{

        $sessionService->initMagie($request->getSession(), 1);
        return $this->render('jardin/entree-jardin-passage-secret.html.twig');
    }


    #[Route('/jardin/lancer_sort_troll', name: 'app_lancer_sort_troll_jardin')]
    public function jardin_lancer_troll_sort(Request $request, SessionService $sessionService,
                        #[MapQueryParameter] string $sortTete = "",
                        #[MapQueryParameter] string $sortMain = "",
                        #[MapQueryParameter] int $alert = 0) : Response{



        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass', TextType::class, ['label' => 'Mot de passe : '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['pass'];
            $expectedResult = '';
            if($sortMain === 'mainConfusion' && $sortTete ==='teteConfusion' )
            {
                $expectedResult = 'llort';
            }else if(
                ($sortMain === 'mainConfusion' && $sortTete ==='teteAttraction') ||
                ($sortMain === 'mainAttraction' && $sortTete ==='teteConfusion') )
            {
                $expectedResult = 'l';
            }
            else{
                $expectedResult = 'A';
            }
            if($pass === $expectedResult)
            {
                return $this->redirectToRoute('app_lancer_sort_troll_jardin', ['sortMain' => $sortMain, 'sortTete' => $sortTete , 'alert' => 2]);
            }
            else
            {
                return $this->redirectToRoute('app_lancer_sort_troll_jardin', ['sortMain' => $sortMain, 'sortTete' => $sortTete , 'alert' => 1]);
            }
        }

        return $this->render('jardin/lancer_sort_troll_jardin.html.twig', [
            'form' => $form,
            'sortTete' => $sortTete,
            'sortMain' => $sortMain,
            'alert' => $alert
        ]);
    }

}
