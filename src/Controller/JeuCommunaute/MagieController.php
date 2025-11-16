<?php

namespace App\Controller\JeuCommunaute;

use App\Model\Constantes;
use App\Model\ObjetAventure;
use App\Service\InventaireService;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class MagieController extends AbstractController
{
    // Le premier sort est appris en rentrant dans la pièce secrete
    #[Route('/deuxieme_sort', name: 'app_magie_deuxieme_sort')]
    public function deuxieme_sort(Request $request, SessionService $sessionService, #[MapQueryParameter] int $alert = 0): Response
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
                return $this->redirectToRoute('app_magie_deuxieme_sort', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/magie/deuxieme_sort.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    // Le premier sort est appris en rentrant dans la pièce secrete
    #[Route('/troisieme_sort', name: 'app_magie_troisieme_sort')]
    public function troisieme_sort(Request $request, SessionService $sessionService, #[MapQueryParameter] int $alert = 0): Response
    {
        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('color0', ColorType::class, ['label' => ' '])
            ->add('color1', ColorType::class, ['label' => ' '])
            ->add('color2', ColorType::class, ['label' => ' '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $vert = $data['color0'];
            $bleu = $data['color1'];
            $rouge = $data['color2'];

            if(($vert === '#00ff00' || $vert === '#00fe00') &&
                ($bleu === '#0000ff' || $bleu === '#0000fe') &&
                ($rouge === '#ff0000' || $rouge === '#fe0000') )
            {
                $sessionService->initMagie($request->getSession(), 3);
                return $this->redirectToRoute('app_jardin');
            }
            else
            {
                return $this->redirectToRoute('app_magie_troisieme_sort', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/magie/troisieme_sort.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }

    #[Route('/catacombe/magie/stele', name: 'app_magie_catacombe_stele') ]
    public function magie_stele(Request $request, SessionService $sessionService, InventaireService $inventaireService, #[MapQueryParameter] int $alert = 0) : Response
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

            if($pass0 === '212324'  )
            {
                $crane = new ObjetAventure(Constantes::crane(), "C'est dorée, ça brille oooh", "Hooo! T'es une pie ?");
                $inventaire = $sessionService->getCurrentInventaire($request->getSession());
                $inventaireService->addOrReplace(Constantes::crane(), $crane, $inventaire);
                $sessionService->setCurrentInventaire($request->getSession(), $inventaire);
                return $this->redirectToRoute('app_magie_catacombe_stele', [ 'alert' => 2 ]);
            }
            else
            {
                return $this->redirectToRoute('app_magie_catacombe_stele', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/magie/catacombe_stele_magie.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
    #[Route('/catacombe/magie/pilier', name: 'app_magie_catacombe_pilier') ]
    public function magie_pilier(Request $request, SessionService $sessionService, InventaireService $inventaireService, #[MapQueryParameter] int $alert = 0) : Response
    {
        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('color0', ColorType::class, ['label' => ' '])
            ->add('color1', ColorType::class, ['label' => ' '])
            ->add('color2', ColorType::class, ['label' => ' '])
            ->add('save', SubmitType::class, ['label' => 'Repondre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $jaune = $data['color1'];
            $bleu = $data['color2'];
            $violet = $data['color0'];

            $endYellow = hexdec('#FCE61D') ;
            $startYellow = hexdec('#DEFC1D');
            $currentYellow = hexdec($jaune);

            $endBlue = hexdec('#6700F6') ;
            $startBlue = hexdec('#0092F6');
            $currentBlue = hexdec($bleu);

            $endViolet = hexdec('#FE00ED') ;
            $startViolet = hexdec('#8E00FE');
            $currentViolet = hexdec($violet);



            if(($currentYellow >= $startYellow && $currentYellow <= $endYellow) &&
                ($currentBlue >= $startBlue && $currentBlue <= $endBlue) &&
                ($currentViolet >= $startViolet && $currentViolet <= $endViolet))
            {
                $coffre = new ObjetAventure(Constantes::coffre(), "Un jolie coffre", "Il n'y a pas de serrure dans ce coffre !");
                $inventaire = $sessionService->getCurrentInventaire($request->getSession());
                $inventaireService->addOrReplace(Constantes::coffre(), $coffre, $inventaire);
                $sessionService->setCurrentInventaire($request->getSession(), $inventaire);
                return $this->redirectToRoute('app_magie_catacombe_pilier', [ 'alert' => 2 ]);
            }
            else
            {
                return $this->redirectToRoute('app_magie_catacombe_pilier', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/magie/catacombe_pilier_magie.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
}
