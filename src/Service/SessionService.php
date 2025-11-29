<?php
namespace  App\Service;

use App\Model\Inventaire;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionService{
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    private function getSession(): SessionInterface{
        return $this->requestStack->getSession();
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

        if($magie < $pow) {
            $session->set('magie', $pow);
        }

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

    public function initOeilGauche(SessionInterface $session)
    {
        $session->set('oeilGauche', true);
    }
    public function initOeilDroit(SessionInterface $session)
    {
        $session->set('oeilDroit', true);
    }
    public function initFinalEscalier() : void{
        $this->getSession()->set('finalEscalier', true);
    }
}
