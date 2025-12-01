<?php

namespace App\Service;

use App\Model\Inventaire;
use App\Model\ObjetAventure;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InventaireService
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getInventaireObjects() : Inventaire|null{
        $inventaire = $this->requestStack->getSession()->get('inventaire');

        if($inventaire instanceof Inventaire ){
            return $inventaire;
        }

        return null;
    }

    public function getInventaireObject( string $key ) : ObjetAventure|null {
        $inventaire = $this->requestStack->getSession()->get('inventaire');

        if($inventaire instanceof Inventaire && array_key_exists($key, $inventaire->getContenu())){
            return $inventaire->getContenu()[$key];
        }

        return null;
    }
    public function addOrReplace(string $key, ObjetAventure $obj , Inventaire $currentInventaire)
    {
       $content = $currentInventaire->getContenu();
       $content[$key] = $obj;
       $currentInventaire->setContenu($content);
    }
}
