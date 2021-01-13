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

    public function inscription() {
        
    }

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

    public function deconnexion() {
        if($this->isConnected()) {
            throw new Exception("user-already-disconnected");
        }

        $this->settoken($this->getCurrentUser(), "token test", time() - 3600);

        if ($this->isConnected()) {
            throw new Exception("disconnection-failed");
        }
    }
    
    public function isConnected(): bool {
        try {
            if(! is_null($this->setCurrentUser())) {
                return true;
            }
        } catch (Exception $e) {
            if ($e->getMessage() == "error-not-connected") {
                return false;
            }
        }
    }

    public function setCurrentUser(): User {
        if(isset($_COOKIE[COOKIE_USER_TOKEN])){
            try {
                $this->me = $this->userManager->getUserByToken($_COOKIE[COOKIE_USER_TOKEN]);
            } catch (Exception $e) {
                if ($e->getMessage() == "error-user-not-found") {
                    $this->me = null;
                }
            }
        }
        return $this->getCurrentUser();
    }

    private function setToken(User $user, string $value, int $time): void {
        $this->userManager->setUserToken($value, $user->getId());
        setcookie(COOKIE_USER_TOKEN, $value, $time);
    }

    private function getCurrentUser(): User {
        if (is_null($this->me)) {
            throw new Exception("error-not-connected");
        }

        return $this->me;
    }

}
