<?php

include '../entity/User.php';
include '../manager/UserManager.php';

class  UserService {

    private UserManager $userManager;

    public function __construct (UserManager $userManager) {
        $this->$userManager = $userManager;
    }

    public function addUser (string $nom, string $prenom,  string $mdp, string $mail, ?string $telephone = null, ?string $photo = null) {
        $mdp = password_hash($mdp, "NeoCracy");

        return $this->userManager->createUser($nom, $prenom, $mdp, $mail, $telephone, $photo);
    }

    public function getUserById (int $id): User {
        return $this->userManager->getUserById($id);
    }

    public function getUserByName (string $nom, string $prenom): array {
        return $this->userManager->getUserByName($nom, $prenom);
    }

    public function deleteUserById (User $currentUser, int $id){
        if (
            $currentUser->getId() != $id
            || ! $currentUser->isAdmin()
        ){
            throw new Exception('error-no-permission');
        }
        return $this->userManager->deleteUserById($id);
    }

}
