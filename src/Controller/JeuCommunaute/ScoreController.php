<?php

namespace App\Controller\JeuCommunaute;

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

final class ScoreController extends AbstractController
{
    #[Route('/communaute/score', name: 'app_communaute_score')]
    public function score(SessionService $sessionService) : Response
    {
        $dateStart = $sessionService->getDateStart();
        $dateStop = $sessionService->getDateStop();
        $interval = $dateStart->diff($dateStop);

        return $this->render('JeuCommunaute/endgame/score.html.twig',
        [
            'duration' => $interval->format('%H:%I:%S')
        ]);
    }

    #[Route('/communaute/score/films', name: 'app_communaute_score_film')]
    public function score_film(SessionService $sessionService) : Response
    {
        return $this->render('JeuCommunaute/endgame/score.html.twig');
    }

}
