<?php

namespace App\Controller\JeuCommunaute;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ScoreController extends AbstractController
{
    #[Route('/communaute/score', name: 'app_communaute_score')]
    public function score(SessionService $sessionService): Response
    {
        $dateStart = $sessionService->getDateStart();
        $dateStop = $sessionService->getDateStop();
        $interval = $dateStart->diff($dateStop);

        return $this->render('JeuCommunaute/endgame/score.html.twig',
            [
                'duration' => $interval->format('%H:%I:%S'),
            ]);
    }

    #[Route('/communaute/score/films', name: 'app_communaute_score_films')]
    #[Route('/communaute/score/film', name: 'app_communaute_score_film')]
    #[Route('/communaute/score/cinema', name: 'app_communaute_score_cinema')]
    #[Route('/communaute/score/cinemas', name: 'app_communaute_score_cinemas')]
    public function score_film(SessionService $sessionService): Response
    {
        $sessionService->initAnnexe('film');

        return $this->redirectToRoute('app_communaute_score');
    }

    #[Route('/communaute/score/F12', name: 'app_communaute_score_film_F12')]
    #[Route('/communaute/score/f12', name: 'app_communaute_score_film_f12')]
    public function score_F12(SessionService $sessionService): Response
    {
        $sessionService->initAnnexe('f12');
        return $this->redirectToRoute('app_communaute_score');
    }

    #[Route('/communaute/score/tarte', name: 'app_communaute_score_film_tarte')]
    #[Route('/communaute/score/Tarte', name: 'app_communaute_score_film_Tarte')]
    public function score_tarte(SessionService $sessionService): Response
    {
        $sessionService->initAnnexe('tarte');
        return $this->redirectToRoute('app_communaute_score');
    }
}
