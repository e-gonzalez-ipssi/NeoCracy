<?php

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

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setDescription($description){
        $this->description = $description;
    }
    public function getDescription(){
        return $description->description;
    }

    public function setLienSite($lienSite){
        $this->lienSite = $lienSite;
    }
    public function getLienSite(){
        return $lienSite->lienSite;
    }
}
