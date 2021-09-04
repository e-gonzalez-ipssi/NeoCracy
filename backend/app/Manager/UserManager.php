<?php 

namespace App\Manager;
Use App\Entity\User;
use Exception;

class UserManager extends Manager {

    /**
     * Cette fonction permet de setup la query pour créer un utilisateur
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function createUser(string $nom, string $prenom, string $mdp, string $mail): array {
        /** @var string $newQuery */
        $newQuery = "INSERT INTO `Utilisateur` (`nom`, `prenom`, `mdp`, `mail`, `isAdmin` ) VALUES ('$nom', '$prenom', '$mdp', '$mail', false)";
        $this->setQuery($newQuery);

        $this->querySet();

        return $this->ack("L'utilisateur a bien été ajouté a la base de donnée");
    }

    /**
     * Cette fonction permet de modifier les informations d'un utilisateur
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function updateUser(int $id, string $nom, string $prenom, string $mail): array {
        /** @var string $newQuery */
        $newQuery = "UPDATE `Utilisateur` SET `nom` = $nom, `prenom` = $prenom, `mail`= $mail WHERE id = $id";
        $this->setQuery($newQuery);

        $this->querySet();

        return $this->ack("L'utilisateur a bien été modifié");
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
        if (!empty($this->inventory[$id])) {
            return $this->inventory[$id];
        }

        $newQuery = "SELECT `id`, `nom`, `prenom`, `mail`, `tel`, `photo`, `isAdmin` FROM `Utilisateur` WHERE id = $id";
        $this->setQuery($newQuery);

        $result = $this->querySelect();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        $user = $this->fromQueryToUser($result);
        $this->inventory[$user->getId()] = $user;
        return $user;
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

        $result = $this->querySelect();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        return $this->fromQueryToUsers($result);
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
        $newQuery = "SELECT `id`, `nom`, `prenom`, `mail`, `tel`, `photo`, `isAdmin` FROM `Utilisateur` WHERE mail = '$mail'";
        $this->setQuery($newQuery);

        $result = $this->querySelect();

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
        $newQuery = "SELECT `id`, `nom`, `prenom`, `mail`, `tel`, `photo`, `isAdmin` FROM `Utilisateur` WHERE token = '$token'";
        $this->setQuery($newQuery);

        $result = $this->querySelect();

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
        
        $newQuery = "UPDATE `Utilisateur` SET token = '$token' WHERE id = $id";
        $this->setQuery($newQuery);
        $this->querySet();

        return $this->ack("Le Token a bien été ajouter a l'utilisateur");
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
        $newQuery = "SELECT `mdp` FROM `Utilisateur` WHERE id = $id";
        $this->setQuery($newQuery);

        $result = $this->querySelect();

        if(count($result) < 1) {
            throw new Exception("error-user-not-found");
        }

        return $result[0]["mdp"];
    }

    /**
     * Cette fonction permet de récupéré les adresses mail de tout les utilisateurs
     * 
     * @return array La liste des adresses mail de tout les utilisateurs
     */
    public function getAllUserMail(): array {
        $newQuery = "SELECT `mail` FROM `Utilisateur`";
        $this->setQuery($newQuery);
        $queryResult = $this->querySelect();
        
        $result = [];
        foreach($queryResult as $row) {
            array_push($result, $row['mail']);
        }

        return $result;
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
        $this->querySet();
        return $this->ack("L'utilisateur a bien été supprimé a la base de donnée");
    }
}
