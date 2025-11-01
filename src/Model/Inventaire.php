<?php

namespace App\Model;

class Inventaire
{
    public array $contenu = [];

    public function getContenu(): array
    {
        return $this->contenu;
    }

    public function setContenu(array $contenu): void
    {
        $this->contenu = $contenu;
    }
}
