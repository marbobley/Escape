<?php

namespace App\Service;

use App\Model\Inventaire;
use App\Model\ObjetAventure;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InventaireService
{
    public function getInventaireObject(SessionInterface $session , string $key) : ObjetAventure|null {
        $inventaire = $session->get('inventaire');

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
