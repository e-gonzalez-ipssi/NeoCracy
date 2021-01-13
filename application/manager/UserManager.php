<?php 

include 'Manager.php';
include '../entity/User.php';

class UserManager extends Manager {

    /**
     * Cette fonction permet de setup la query pour créer un utilisateur
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function createUser(string $nom, string $prenom, string $mdp, string $mail, ?string $telephone = null, ?string $photo = null): array {
        /** @var string $newQuery */
        $newQuery = "INSERT INTO `Utilisateur` (`nom`, `prenom`, `mdp`, `mail`, `tel`, `photo`) VALUES ($nom, $prenom, $mdp, $mail, $telephone, $photo);";
        $this->setQuery($newQuery);

        $this->find();

        return $this->ack("L'utilisateur a bien été ajouté a la base de donnée");
    }

    /**
     * Cette fonction permet de récupéré un utilisateur
     * 
     * @param int $id L'id de l'utilisateur que l'on recherche
     * 
     * @return User Cette fonction retourne l'utilisateur rechercher
     * 
     * @throw Exception Relève une expetion si l'utilisateur n'a pas été trouvé
     */
    public function getUserById(int $id): User {
        $newQuery = "SELECT `id`, `nom`, `prenom`, `mail`, `tel`, `photo`, `isAdmin` FROM `Utilisateur` WHERE id = $id";
        $this->setQuery($newQuery);

        $result = $this->find();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        return $this->fromQueryToUser($result);
    }

    /**
     * Cette fonction permet de récupéré une liste d'utilisateur avec le nom rechercher
     * 
     * @param string $nom Le nom de l'utilisateur que l'on recherche
     * 
     * @return array Cette fonction retourne la liste d'utilisateur possédant le nom rechercher
     * 
     * @throw Exception Relève une expetion si l'utilisateur n'a pas été trouvé
     */
    public function getUserByName(string $nom): array {
        $newQuery = "SELECT `id`, `nom`, `prenom`, `mail`, `tel`, `photo`, `isAdmin` FROM `Utilisateur` WHERE nom = $nom";
        $this->setQuery($newQuery);

        $result = $this->find();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        return $this->fromQueryToUsers($result);
    }

    /**
     * Cette fonction permet de récupéré le mot de passe utilisateur avec son adresse mail
     * 
     * @param int $id L'idée de l'utilisateur rechercher
     * 
     * @return string Le mot de passe stoker dans la bd
     * 
     * @throw Exception Relève une expetion si l'utilisateur n'a pas été trouvé
     */
    public function getPasswordById(int $id): string {
        $newQuery = "SELECT `Password` FROM `Utilisateur` WHERE id = $id";
        $this->setQuery($newQuery);

        $result = $this->find();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        return $result["password"];
    }

    /**
     * Cette fonction permet de récupéré le mot de passe utilisateur avec son adresse mail
     * 
     * @param string $mail Le mail de l'utilisateur que l'on recherche
     * 
     * @return User Cette fonction retourne l'utilisateur rechercher
     * 
     * @throw Exception Relève une expetion si l'utilisateur n'a pas été trouvé
     */
    public function getUserByMail(string $mail): User {
        $newQuery = "SELECT `id`, `nom`, `prenom`, `mail`, `tel`, `photo`, `isAdmin` FROM `Utilisateur` WHERE mail = $mail";
        $this->setQuery($newQuery);

        $result = $this->find();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        return $this->fromQueryToUser($result);
    }

    
    /**
     * Cette fonction permet de récupéré l'utilisateur avec son token rechercher
     * 
     * @param string $token Le nom token de l'utilisateur que l'on cherche
     * 
     * @return User Cette fonction retourne la liste d'utilisateur possédant le nom rechercher
     * 
     * @throw Exception Relève une expetion si l'utilisateur n'a pas été trouvé
     */
    public function getUserByToken(string $token): User {
        $newQuery = "SELECT `id`, `nom`, `prenom`, `mail`, `tel`, `photo`, `isAdmin` FROM `Utilisateur` WHERE token = $token";
        $this->setQuery($newQuery);

        $result = $this->find();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        return $this->fromQueryToUser($result);
    }

    /**
     * Cette fonction permet de set un token de connexion
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     */
    public function setUserToken(string $token, int $id): array {
        $newQuery = "UPDATE `Utilisateur` SET token = $token WHERE id = $id";
        $this->setQuery($newQuery);

        $result = $this->find();

        return $this->ack("Le Token a bien été ajouter a l'utilisateur");
    }

    /**
     * Cette fonction permet de supprimé un utilisateur de la database
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function deleteUserById(int $id): array {
        /** @var string $newQuery */
        $newQuery = "DELETE FROM `Utilisateur` WHERE id = $id";
        $this->setQuery($newQuery);

        $this->find();

        return $this->ack("L'utilisateur a bien été supprimé a la base de donnée");
    }

    private function fromQueryToUser(array $result): User {
        return new User(
            $result["id"],
            $result["nom"],
            $result["prenom"],
            $result["mail"],
            $result["tel"],
            $result["photo"],
            $result["isAdmin"],
        );
    }
    private function fromQueryToUsers(array $result): array {
        $users = [];
        foreach($result as $user) {
            $newUser = new User(
                $user["id"],
                $user["nom"],
                $user["prenom"],
                $user["mail"],
                $user["tel"],
                $user["photo"],
                $user["isAdmin"],
            );
            array_push($users, $newUser);
        }
        return $users;
    }
}
