<?php
namespace  App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionService{

    public function increateDeath(SessionInterface $session){
        $currentNombreMort = $session->get('nombre-mort');
        if(!isset($currentNombreMort))
        {
            $currentNombreMort = 0;
        }
        // stores an attribute for reuse during a later user request
        $currentNombreMort++;
        $session->set('nombre-mort', $currentNombreMort);
    }

}
