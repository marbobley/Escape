<?php

namespace App\Service;

use App\Model\Inventaire;
use App\Model\ObjetAventure;

class InventaireService
{

    public function addOrReplace(string $key, ObjetAventure $obj , Inventaire $currentInventaire)
    {
       $content = $currentInventaire->getContenu();

       $content[$key] = $obj;

       $currentInventaire->setContenu($content);
    }
}
