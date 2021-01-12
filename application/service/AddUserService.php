<?php

include '../manager/AddUserManager.php';

class  AddUserService {

    private AddUserManager $addUserManager;

    public function __construct (AddUserManager $addUserManager) {
        $this->$addUserManager = $addUserManager;
    }

    public function execute (string $nom, string $prenom,  string $mdp, string $mail, ?string $telephone = null, ?string $photo = null) {
        $mdp = password_hash($mpd, "NeoCracy");

        return $this->$addUserManager->createUser($nom, $prenom, $mdp, $mail, $telephone, $photo);
    }

}
