<?php

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


    public function resetEscalier()
    {
        $this->requestStack->getSession()->set(self::ESCALIER_KEY, self::ETAGE_MIN);
    }
    public function getEscalier(){
        $escalier = $this->requestStack->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            return self::ETAGE_MIN;
        }

        return $escalier;
    }

    public function initEscalier()
    {
        $escalier = $this->requestStack->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            $this->requestStack->getSession()->set(self::ESCALIER_KEY, self::ETAGE_MIN);
        }

        return $escalier;
    }

    public function decreaseEscalier() : int{
        $escalier = $this->requestStack->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            $escalier = 0;
        }
        // stores an attribute for reuse during a later user request
        $escalier--;
        if($escalier < self::ETAGE_MIN)
            $escalier = self::ETAGE_MIN;
        $this->requestStack->getSession()->set(self::ESCALIER_KEY, $escalier);

        return $escalier;
    }

    public function increaseEscalier() : int{
        $escalier = $this->requestStack->getSession()->get(self::ESCALIER_KEY);
        if(!isset($escalier))
        {
            $escalier = self::ETAGE_MIN;
        }
        $escalier++;
        if($escalier > self::ETAGE_MAX)
            $escalier = self::ETAGE_MAX;

        $this->requestStack->getSession()->set(self::ESCALIER_KEY, $escalier);

        return $escalier;
    }
}
