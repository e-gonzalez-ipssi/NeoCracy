<?php

namespace App\Service;

use App\Entity\User;
use App\Manager\UserManager;
use Exception;

class  UserService {

    private UserManager $userManager;

    public function __construct (UserManager $userManager) {
        $this->userManager = $userManager;
    }

    /**
     * Cette fonction permet d'ajouter un utiliateur a la database
     * 
     * @param string $nom
     * @param string $prenom
     * @param string $mdp Mot de passe en clair qui sera hash avant d'être ajouter a la db
     * @param string $mail
     * @param string $telephone
     * @param string $photo
     * 
     * @return array output a renvoyer a l'utilisateur lui indiquant l'état de sa requête
     */
    public function addUser (string $nom, string $prenom, string $mdp, string $mail):array {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);

        return $this->userManager->createUser($nom, $prenom, $mdp, $mail);
    }

    /**
     * Cette fonction permet de récupéré un objet Utilisateur a partir de son id
     * 
     * @param int $id L'id de l'utilisateur que l'on cherche
     * 
     * @return User L'utilisateur correspondant a l'id
     */
    public function getUserById (int $id): User {
        return $this->userManager->getUserById($id);
    }

    /**
     * Cette fonction permet de récupéré un objet Utilisateur a partir de son id
     * 
     * @param string $mail L'id de l'utilisateur que l'on cherche
     * 
     * @return User L'utilisateur correspondant au mail
     */
    public function getUserByMail (string $mail): User {
        return $this->userManager->getUserByMail($mail);
    }


    /**
     * Cette fonction permet de récupéré une liste d'objet Utilisateur a partir de son nom
     * 
     * @param string $nom Le nom de l'utilisateur que l'on cherche
     * 
     * @return array La liste d'utilisateur correspondant au nom rechercher
     */
    public function getUserByName (string $nom, string $prenom): array {
        return $this->userManager->getUserByName($nom, $prenom);
    }

    /**
     * Cette fonction permet de supprimé un utilisateur a partir de son id
     * 
     * @param User $currentUser l'utilisateur connecté
     * @param int $id L'id de l'utilisateur que l'on cherche
     * 
     * @return array output a renvoyer a l'utilisateur lui indiquant l'état de sa requête
     * 
     * @throw Exception renvoie une exception si l'utilisateur n'a pas les permissions
     */
    public function deleteUserById (User $currentUser, int $id): array{
        if (
            $currentUser->getId() != $id
            || ! $currentUser->isAdmin()
        ){
            // si l'utilisateur n'est ni celui qu'il souhaite supprimé, ni un admin
            // alors il ne peut pas le supprimé
            throw new Exception('error-no-permission');
        }
        return $this->userManager->deleteUserById($id);
    }
}
