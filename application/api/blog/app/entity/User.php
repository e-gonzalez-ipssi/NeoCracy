<?php

namespace App\Entity;

class  User {

    private int $id;
    private string $nom;
    private string $prenom;
    private string $mail;
    private string $telephone;
    private string $photo;
    private bool $isAdmin;

    public function __construct (  
        int $id,
        string $nom,
        string $prenom,
        string $mail,
        string $telephone,
        string $photo,
        bool $isAdmin = false,
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->photo = $photo;
        $this->isAdmin = $isAdmin;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom) {
        $this->nom = $nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom) {
        $this->prenom = $prenom;
    }

    public function getMail(): string {
        return $this->mail;
    }

    public function setMail(string $mail) {
        $this->mail = $mail;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone) {
        $this->telephone = $telephone;
    }

    public function getPhoto(): string {
        return $this->photo;
    }

    public function setPhoto(string $photo) {
        $this->photo = $photo;
    }

    public function isAdmin(): bool {
        return $this->isAdmin;
    }
}
