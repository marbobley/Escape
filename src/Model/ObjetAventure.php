<?php

namespace App\Model;

class ObjetAventure
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }
    private string $description;

    public function getMoreInformation(): string
    {
        return $this->moreInformation;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    private string $moreInformation;


    public function __construct(string $name , string $description, string $moreInformation)
    {
        $this->name = $name;
        $this->description = $description;
        $this->moreInformation = $moreInformation;
    }
}
