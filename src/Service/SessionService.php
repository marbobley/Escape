<?php
namespace  App\Service;

use App\Model\Inventaire;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionService{


    public function decreaseEscalier(SessionInterface $session) : int{
        $escalier = $session->get('escalier');
        if(!isset($escalier))
        {
            $escalier = 0;
        }
        // stores an attribute for reuse during a later user request
        $escalier--;
        if($escalier < 1)
            $escalier = 1;
        $session->set('escalier', $escalier);

        return $escalier;
    }

    public function increaseEscalier(SessionInterface $session) : int{
        $escalier = $session->get('escalier');
        if(!isset($escalier))
        {
            $escalier = 0;
        }
        // stores an attribute for reuse during a later user request
        $escalier++;
        if($escalier > 12)
            $escalier = 12;

        $session->set('escalier', $escalier);

        return $escalier;
    }
    public function increaseDeath(SessionInterface $session){
        $currentNombreMort = $session->get('nombre-mort');
        if(!isset($currentNombreMort))
        {
            $currentNombreMort = 0;
        }
        // stores an attribute for reuse during a later user request
        $currentNombreMort++;
        $session->set('nombre-mort', $currentNombreMort);
    }

    public function initMaitreExclamer(SessionInterface $session)
    {
        $maitreExclamer = $session->get('maitre-exclamer');
        if(!isset($maitreExclamer))
        {
            $session->set('maitre-exclamer', 1);
        }
    }
    public function initMonstreCompa(SessionInterface $session)
    {
        $monstre = $session->get('monstre-compa');
        if(!isset($monstre))
        {
            $session->set('monstre-compa', 1);
        }
    }

    public function initEscalier(SessionInterface $session)
    {
        $escalier = $session->get('escalier');
        if(!isset($escalier))
        {
            $session->set('escalier', 1);
        }

        return $escalier;
    }
    public function getEscalier(SessionInterface $session){
        $escalier = $session->get('escalier');
        if(!isset($escalier))
        {
            return 1;
        }

        return $escalier;
    }

    public function getCurrentInventaire(SessionInterface $session) : Inventaire
    {
        $inventaire = $session->get('inventaire');
        if(!isset($inventaire))
        {
            return new Inventaire();
        }

        return $inventaire;
    }

    public function setCurrentInventaire(SessionInterface $session, Inventaire $currentInventaire)
    {

        $session->set('inventaire', $currentInventaire);
    }

    public function initMagie(SessionInterface $session, int $pow) : int
    {
        $magie = $session->get('magie');

        if($magie < $pow)
            $session->set('magie', $pow);

        return $pow;
    }

    public function setTrollJardinDead(SessionInterface $session) : void {
        $session->set('trollJardinDead', true);
    }

    public function setCatacombeOpen(SessionInterface $session)
    {
        $session->set('catacombeOpen', true);
    }

    public function initCombatFinal(SessionInterface $session)
    {
        $session->set('combatFinal', true);
    }
}
