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
     * @param int $id L'id de l'utilisateur que l'on recherche
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

    private function fromQueryToUser($result): User {
        return new User(
            $result["id"],
            $result["nom"],
            $result["prenom"],
            $result["mail"],
            $result["tel"],
            $result["photo"],
        );
    }
    private function fromQueryToUsers($result): array {
        $users = [];
        foreach($result as $user) {
            $newUser = new User(
                $user["id"],
                $user["nom"],
                $user["prenom"],
                $user["mail"],
                $user["tel"],
                $user["photo"],
            );
            array_push($users, $newUser);
        }
        return $users;
    }
}
