<?php
namespace  App\Service;

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

}
