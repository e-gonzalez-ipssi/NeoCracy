<?php

namespace App\Service;

use App\Entity\User;
use App\Manager\UserManager;
use App\Service\UserService;
use Exception;

class  ConnexionService {

    private UserService $userService;
    private UserManager $userManager;
    private ?User $me = null;

    public function __construct(UserService $userService, UserManager $userManager) {
        $this->userService = $userService;
        $this->userManager = $userManager;

        $this->setCurrentUser();
        
    }

    /**
    * Petite fonction pour  échapper les caractères dangereux potentiellement envoyées et effectuer un premier nettoyage des données du formulaire
    */
    private function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

    /**
     * Permet d'inscrire un utilisateur sur le site
     */
    public function inscription(
        string $nom,
        string $prenom,
        string $password,
        string $confirmpassword,
        string $mail
    ) {
        $nom = $this->valid_donnees($nom);
        $prenom = $this->valid_donnees($prenom);
        
        // Vérification saisie des champs si vide erreur + filtre sur mail
        if(empty($nom) && empty($prenom) && empty($password) && empty($confirmpassword) && empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)){
            throw new Exception("valid-all-details");
        }             

        // on vérifie si les mots de passe rentré match pour voir si l'utilisateur a bien confirmer sont mot de passe
        if ($password != $confirmpassword) {
            throw new Exception("password-dont-match");
        } 

        // on verifie si l'email utiliser n'éxiste pas déjà
        if (in_array($mail, $this->userManager->getAllUserMail())){
            throw new Exception("mail-already-used");
        }

        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->userService->addUser($nom, $prenom, $password, $mail);
    }

    /**
     * Permet de modifier ses informations personnel
     */
    public function updateMe(
        User $user,
        string $nom,
        string $prenom,
        string $mail
    ) {
        $nom = $this->valid_donnees($nom);
        $prenom = $this->valid_donnees($prenom);

        // on verifie si l'email utiliser n'éxiste pas déjà
        if (in_array($mail, $this->userManager->getAllUserMail())){
            throw new Exception("mail-already-used");
        }

        $this->userManager->updateUser($user->getId(), $nom, $prenom, $mail);
    }

    /**
     * Permet de connecté un utilisateur
     * 
     * @param null|string $mail Le mail de l'utilisateur qui se connecte
     * @param null|string $password Le mot de passe de l'utilisateur qui se connect
     * 
     * Note : ces 2 paramêtre peuvent être nul si l'utililsateur utilise sont token pour se connecté
     */
    public function connexion(?string $mail = null, ?string $password = null): string {
        if($this->me){
            throw new Exception("user-already-connected");
        }

        if(is_null($mail) || is_null($password)) {
            throw new Exception("bad-input-data");
        }

        /** @var User $user */
        $user = $this->userService->getUserByMail($mail);

        $password = password_hash($password, PASSWORD_BCRYPT);

        $databasePassword = $this->userManager->getPasswordById($user->getId());

        // si les password ne correspondent pas, renvoyer une erreur a l'utilisateur
        if (password_verify($password, $databasePassword)) {
            throw new Exception("bad-password");
        }

        $cookie = $this->generateUserToken();

        $this->setToken($user, $cookie, time() + (86400 * 30));

        return $cookie;
    }

    /**
     * Permet de déconnecté l'utilisateur courant
     * 
     * throw Exception renvoie une exeption si il n'y a pas d'utilisateur connecté, ou si la déconnection échou
     */
    public function deconnexion(?string $userToken = null) {
        if(isset($userToken)){
            if(!$this->me) {
                throw new Exception("user-already-disconnected-2");
            }
            
            $this->setToken($this->me, "", time() - 3600);
            try {
                $user = $this->getCurrentUserWithToken($userToken);
            }
            catch (Exception $e){
                if (!$e->getMessage() == "error-not-connected-2") {
                    throw new Exception("disconnection-failed");
                }
            }
        }
        else {
            if(!$this->me) {
                throw new Exception("user-already-disconnected");
            }
            
            $user = $this->getCurrentUser();
            $this->setToken($user, $this->generateUserToken(), time() - 3600);
            try {
                $user = $this->getCurrentUser();
            }
            catch (Exception $e){
                if (!$e->getMessage() == "error-not-connected") {
                    throw new Exception("disconnection-failed");
                }
            }
        }

    }

    /**
     * Permet d'obtenir un token randomiser
     */
    private function rand_string($length):string{ 
        $str = "";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";  
        $size = strlen( $chars );  
        for( $i = 0; $i < $length; $i++ ) {  
            $str.= $chars[ rand( 0, $size - 1 ) ];  
        }  
        return $str;
    }   

    private function generateUserToken(){
        $rand =  $this->rand_string(64);  
        return $rand;
    }
    

    /**
     * Permet de set un utilisateur courant pour la fonction getCurrentUser()
     * Utilise le cookie Utilisateur, si il n'y a pas d'utilisateur courant, le set a NULL
     */
    private function setCurrentUser() {
        if(isset($_COOKIE[COOKIE_USER_TOKEN])){
            try {
                $this->me = $this->userManager->getUserByToken($_COOKIE[COOKIE_USER_TOKEN]);
            } catch (Exception $e) {
                if ($e->getMessage() == "error-user-not-found") {
                    $this->me = null;
                }
            }
        }
    }

    /**
     * Permet de set un utilisateur courant pour la fonction getCurrentUser()
     * Utilise le cookie Utilisateur, si il n'y a pas d'utilisateur courant, le set a NULL
     */
    private function setCurrentUserWithToken(string $userToken) {
        if(isset($userToken)){
            try {
                $this->me = $this->userManager->getUserByToken($userToken);
            } catch (Exception $e) {
                if ($e->getMessage() == "error-user-not-found") {
                    $this->me = null;
                }
            }
        }
    }


    /**
     * Cette fonction permet de set le token utilisateur dans la database ainsi que dans les cookie de l'utilisateur
     * 
     * @param User $user L'utilisateur a qui on souhaite changer le token
     * @param string $value La valeur a laquel on souhaite set le token
     * @param int $time temps apres laquel le token expirera (+86400 = +1 jour) 
     */
    private function setToken(User $user, string $value, ?int $time = null){
        $this->userManager->setUserToken($value, $user->getId());
        setcookie(COOKIE_USER_TOKEN, $value, $time);
    }

    /**
     * Permet de récupéré l'utilisateur courant
     * 
     * @return User L'utilisateur courant au format User
     */
    public function getCurrentUser(): User {
        if (is_null($this->me)) {
            throw new Exception("error-not-connected");
        }

        return $this->me;
    }

    /**
     * Permet de récupéré l'utilisateur courant
     * 
     * @return User L'utilisateur courant au format User
     */
    public function getCurrentUserWithToken(string $userToken): User {
        $this->setCurrentUserWithToken($userToken);
        if (is_null($this->me)) {
            throw new Exception("error-not-connected-2");
        }

        return $this->me;
    }

}
