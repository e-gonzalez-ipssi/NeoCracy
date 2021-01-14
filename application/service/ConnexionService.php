<?php

include '../entity/Constant.php';
include '../entity/User.php';
include '../service/UserService.php';
include '../manager/UserManager.php';


class  ConnexionService {

    private UserService $userService;
    private UserManager $userManager;
    private ?User $me = null;

    public function __construct(UserService $userService, UserService $userManager) {
        $this->userService = $userService;
        $this->userManager = $userManager;
    }

    /**
     * Permet d'inscrire un utilisateur sur le site
     *
     */
    public function inscription() {
        
    }

    /**
     * Permet de connecté un utilisateur
     * 
     * @param null|string $mail Le mail de l'utilisateur qui se connecte
     * @param null|string $password Le mot de passe de l'utilisateur qui se connect
     * 
     * Note : ces 2 paramêtre peuvent être nul si l'utililsateur utilise sont token pour se connecté
     */
    public function connexion(?string $mail = null, ?string $password = null): void {
        if($this->isConnected()){
            throw new Exception("user-already-connected");
        }

        if(is_null($mail) || is_null($password)) {
            throw new Exception("bad-input-data");
        }

        $user = $this->userService->getUserByMail($mail);

        $password = password_hash($password, HASH_CODE);

        $databasePassword = $this->userManager->getPasswordById($user->getId());

        // si les password ne correspondent pas, renvoyer une erreur a l'utilisateur
        if ($password != $databasePassword) {
            throw new Exception("bad-password");
        }

        $this->settoken($user, "token test", time() + (86400 * 30));

        if (! $this->isConnected()) {
            throw new Exception("connection-failed");
        }
    }

    /**
     * Permet de déconnecté l'utilisateur courant
     * 
     * throw Exception renvoie une exeption si il n'y a pas d'utilisateur connecté, ou si la déconnection échou
     */
    public function deconnexion() {
        if($this->isConnected()) {
            throw new Exception("user-already-disconnected");
        }

        $this->settoken($this->getCurrentUser(), "token test", time() - 3600);

        if ($this->isConnected()) {
            throw new Exception("disconnection-failed");
        }
    }
    

    /** 
     * Permet de vérifier si il y a un utilisateur actuellement connecté
     * 
     * @return bool True = connecté, False = non connecté
     */
    public function isConnected(): bool {
        try {
            $this->setCurrentUser();
            if(! is_null($this->getCurrentUser())) {
                return true;
            }
        } catch (Exception $e) {
            if ($e->getMessage() == "error-not-connected") {
                return false;
            }
        }
    }


    /**
     * Permet de set un utilisateur courant pour la fonction getCurrentUser()
     * Utilise le cookie Utilisateur, si il n'y a pas d'utilisateur courant, le set a NULL
     */
    public function setCurrentUser() {
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
     * Cette fonction permet de set le token utilisateur dans la database ainsi que dans les cookie de l'utilisateur
     * 
     * @param User $user L'utilisateur a qui on souhaite changer le token
     * @param string $value La valeur a laquel on souhaite set le token
     * @param int $time temps apres laquel le token expirera (+86400 = +1 jour) 
     */
    private function setToken(User $user, string $value, ?int $time = null): void {
        $this->userManager->setUserToken($value, $user->getId());
        setcookie(COOKIE_USER_TOKEN, $value, $time);
    }

    /**
     * Permet de récupéré l'utilisateur courant
     * 
     * @return User L'utilisateur courant au format User
     */
    private function getCurrentUser(): User {
        if (is_null($this->me)) {
            throw new Exception("error-not-connected");
        }

        return $this->me;
    }

}
