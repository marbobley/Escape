<?php

namespace App\Controller\JeuCommunaute;

use App\Form\WordPasswordType;
use App\Model\Constantes;
use App\Model\ObjetAventure;
use App\Service\EscalierService;
use App\Service\InventaireService;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class EscalierController extends AbstractController
{
    const JEU_COMMUNAUTE_ESCALIER_INDEX_HTML_TWIG = 'JeuCommunaute/escalier/index.html.twig';

    #[Route('/escalier', name: 'app_escalier')]
    public function index( EscalierService $escalierService) : Response
    {
        $escalierService->initEscalier();
        return $this->render(self::JEU_COMMUNAUTE_ESCALIER_INDEX_HTML_TWIG);
    }

    #[Route('/escalier/retour', name: 'app_escalier_retour')]
    public function escalier_retour() : Response
    {
        return $this->render(self::JEU_COMMUNAUTE_ESCALIER_INDEX_HTML_TWIG, [
        ]);
    }

    #[Route('/escalier/metre/sortie', name: 'app_escalier_sortie')]
    public function escalier_sortie() : Response
    {
        return $this->render('JeuCommunaute/escalier/sortie.html.twig');
    }

    #[Route('/escalier/metre', name: 'app_escalier_metre')]
    public function escalier_metre(Request $request, #[MapQueryParameter]  int $alert = 0) : Response
    {


        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass0', TextType::class, ['label' => 'Etage'])
            ->add('save', SubmitType::class, ['label' => 'Suivre'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass0 = $data['pass0'];

            if( $pass0 === '12')
            {
                return $this->redirectToRoute('app_escalier_metre', [ 'alert' => 85214589 ]);
            }
            else
            {
                return $this->redirectToRoute('app_escalier_metre', [ 'alert' => 1 ]);
            }
        }

        return $this->render('JeuCommunaute/escalier/affrontement.html.twig', [
            'form' => $form,
            'alert' => $alert,
        ]);
    }
    #[Route('/escalier/monter', name: 'app_escalier_monter')]
    public function monter( EscalierService $escalierService) : Response
    {
        $escalierService->increaseEscalier();

        return $this->render(self::JEU_COMMUNAUTE_ESCALIER_INDEX_HTML_TWIG);
    }

    #[Route('/escalier/descendre', name: 'app_escalier_descendre')]
    public function descendre( EscalierService $escalierService) : Response
    {
        $escalierService->decreaseEscalier();
        return $this->render(self::JEU_COMMUNAUTE_ESCALIER_INDEX_HTML_TWIG);
    }

    #[Route('/escalier/regarder', name: 'app_escalier_regarder')]
    public function regarder(EscalierService $escalierService) : Response
    {
        $escalier = $escalierService->getEscalier();

        $filename = 'images/jeu_escalier_' .  $escalier . '.wepb';

        return $this->render('JeuCommunaute/escalier/regarder.html.twig', [
            'filename' => $filename
        ]);
    }
    #[Route('/escalier/cailloux', name: 'app_escalier_cailloux')]
    public function cailloux(Request $request, SessionService $sessionService) : Response
    {
        return $this->render('JeuCommunaute/escalier/cailloux.html.twig');
    }

    #[Route('escalier/coffre_romain', name: 'app_escalier_coffre')]
    public function coffre(Request $request,
                           SessionService $sessionService,
                           InventaireService $inventaireService,
                           #[MapQueryParameter] int $tentativeCoffreOpen = 0,
                           #[MapQueryParameter] bool $coffreOpen = false) : Response
    {
        $defaultData = null;
        $form = $this->createFormBuilder($defaultData)
            ->add('pass', NumberType::class, ['label' => 'egal = '])
            ->add('save', SubmitType::class, ['label' => 'Calculer'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pass = $data['pass'];
            if($pass === 20.0)
            {
                $lunette = new ObjetAventure(Constantes::lunette(), "Permet de voir plus", "Quel charisme avec!");
                $inventaire = $sessionService->getCurrentInventaire($request->getSession());
                $inventaireService->addOrReplace(Constantes::lunette(), $lunette, $inventaire);
                $sessionService->setCurrentInventaire($request->getSession(), $inventaire);
                return $this->redirectToRoute('app_escalier_coffre', ['coffreOpen' => true]);
            }
            else
            {
                $tentativeCoffreOpen++;
                return $this->redirectToRoute('app_escalier_coffre',['tentativeCoffreOpen' => $tentativeCoffreOpen] );
            }
        }

        return $this->render('JeuCommunaute/escalier/coffre.html.twig', [
            'form' => $form,
            'tentativeCoffreOpen' => $tentativeCoffreOpen,
            'coffreOpen' => $coffreOpen
        ]);
    }
}
