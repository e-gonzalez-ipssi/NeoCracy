<?php

namespace Neocracy\Entity;

use date;

class Proposition
{
    protected int $id;
    protected string $nom;
    protected string $description;
    protected string $tag ;
    protected string $date ;


    public function __construct(int $id, string $nom, string $description, int $tag, date $date)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->tag = $tag;
        $this->date = $date;
    }

    public function getId():int{
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getNom():string{
        return $this->nom;
    }

    public function setNom(string $nom){
        $this->nom = $nom;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }
    public function getDescription():string{
        return $this->description;
    }

    public function setTag(int $tag){
        $this->tag = $tag;
    }
    public function getTag():int{
        return $this->tag;
    }

    public function setDate(date $date){
        $this->date = $date;
    }
    public function getDate():date{
        return $this->date;
    }
}
