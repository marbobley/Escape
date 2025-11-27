<?php
declare(strict_types = 1);

namespace App\Service;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EscalierService
{
    const ESCALIER_KEY = 'escalier';
    const ETAGE_MIN = 1;
    const ETAGE_MAX = 12;
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    private function getSession(): SessionInterface{
        return $this->requestStack->getSession();
    }


    public function resetEscalier()
    {
        $this->getSession()->set(self::ESCALIER_KEY, self::ETAGE_MIN);
    }
    public function getEscalier(){
        $escalier = $this->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            return self::ETAGE_MIN;
        }

        return $escalier;
    }

    public function initEscalier()
    {
        $escalier = $this->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            $this->getSession()->set(self::ESCALIER_KEY, self::ETAGE_MIN);
        }

        return $escalier;
    }

    public function decreaseEscalier() : int{
        $escalier = $this->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            $escalier = 0;
        }
        // stores an attribute for reuse during a later user request
        $escalier--;
        if($escalier < self::ETAGE_MIN){
            $escalier = self::ETAGE_MIN;
        }
        $this->getSession()->set(self::ESCALIER_KEY, $escalier);

        return $escalier;
    }

    public function increaseEscalier() : int{
        $escalier = $this->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            $escalier = self::ETAGE_MIN;
        }
        $escalier++;
        if($escalier > self::ETAGE_MAX){
            $escalier = self::ETAGE_MAX;
        }

        $this->getSession()->set(self::ESCALIER_KEY, $escalier);

        return $escalier;
    }
}
