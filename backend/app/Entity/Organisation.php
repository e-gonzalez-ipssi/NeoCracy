<?php

namespace App\Entity;

class Organisation
{

    protected int $id;
    protected string $nom;
    protected string $description;
    protected string $lienSite;
    protected string $image;


    public function __construct(int $id, string $nom, string $description, string $lienSite, string $image)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->lienSite = $lienSite;
        $this->image = $image;
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

    public function setImage(string $image){
        $this->image = $image;
    }
    public function getImage():string{
        return $this->lienSite;
    }

    public function arrayify(): array {
        return [
            "id" => $this->id,
            "nom" => $this->nom,
            "description" => $this->description,
            "lienSite" => $this->lienSite,
            "image" => $this->image,
        ];
    }
}
