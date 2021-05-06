<?php

namespace App\Entity;

class Organisation
{

    protected int $id;
    protected string $nom;
    protected string $description;
    protected string $lienSite ;


    public function __construct(int $id, string $nom, string $description, string $lienSite)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->lienSite = $lienSite;
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

    public function setLienSite(string $lienSite){
        $this->lienSite = $lienSite;
    }
    public function getLienSite():string{
        return $this->lienSite;
    }

    public function arrayify(): array {
        return [
            "id" => $this->id,
            "nom" => $this->nom,
            "description" => $this->description,
            "lienSite" => $this->lienSite,
        ];
    }
}
