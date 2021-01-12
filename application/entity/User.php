<?php

class  User {

    int $id;
    string $nom;
    string $prenom;
    string $mail;
    string $telephone;
    string $photo;

    public function __construct (  
        int $id,
        string $nom,
        string $prenom,
        string $mail,
        string $telephone,
        string $photo,
    ) {
        $this->$id = $id;
        $this->$nom = $nom;
        $this->$prenom = $prenom;
        $this->$mail = $mail;
        $this->$telephone = $telephone;
        $this->$photo = $photo;
    }

    private function getId(): int {
        return $this->$id;
    }

    private function getNom(): string {
        return $this->$nom;
    }

    private function setNom(string $nom) {
        $this->$nom = $nom;
    }

    private function getPrenom(): string {
        return $this->$prenom;
    }

    private function setPrenom(string $nom) {
        $this->$prenom = $prenom;
    }

    private function getMail(): string {
        return $this->$mail;
    }

    private function setMail(string $mail) {
        $this->$mail = $mail;
    }

    private function getTelephone(): string {
        return $this->$telephone;
    }

    private function setTelephone(string $telephone) {
        $this->$telephone = $telephone;
    }

    private function getPhoto(): string {
        return $this->$photo;
    }

    private function setPhoto(string $photo) {
        $this->$photo = $photo;
    }
}