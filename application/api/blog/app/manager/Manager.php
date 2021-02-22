<?php

namespace App\Manager;

use App\Entity\bd ;
use App\Entity\Organisation ;
use App\Entity\Proposition;
use App\Entity\User;
use Exception;

abstract class  Manager
{
    private bd $bd;
    private string $query;
    protected array $inventory = [];
    
    public function __construct (bd $bd)  {
        $this->bd = $bd;
    }

    /**
     * Cette fonction permet de préparer la requete qui sera effectuer en la stokant dans l'objet Manager
     * 
     * @param string $requete la requete que l'on souhaite mettre en recherche
     * 
     * @return void
     */
    protected function setQuery (string $requete): void {
        $this->query = $requete;
    }

    /**
     * Cette fonction permet de renvoyer le resultat de la requête faite a la bd sous la forme d'une array exploitable
     * 
     * @return array
     */
    protected function querySelect(): array {
        try {
            $result = $this->bd->query($this->query);
        } catch (Exception $e) {
            return $this->error($e->getCode(), $e->getMessage());
        }

        return $result->fetchAll();
    }
    
    /**
     * Cette fonction permet de renvoyer le resultat de la requête faite a la bd sous la forme d'une array exploitable
     * 
     * @return array
     */
    protected function querySet(): void {
        try {
            $result = $this->bd->query($this->query);
        } catch (Exception $e) {
        }
    }

    /**
     * Permet de créer un retour indiquant que la fonction c'est bien dérouler comme prévu
     * 
     * @param string $message Message a renvoyer a l'utilisateur
     * 
     * @return array
     */
    protected function ack(string $message): array {
        return [
            "code" => 200,
            "message" => $message,
        ];
    }

    /**
     * Permet de créer un retour indiquant que la fonction c'est bien dérouler comme prévu
     * 
     * @param int $code le code d'erreur a renvoyer a l'utilisateur
     * @param string $message Message a renvoyer a l'utilisateur
     * 
     * @return array
     */
    protected function error(int $code, string $message): array {
        return [
            "code" => $code,
            "message" => $message,
        ];
    }

    protected function fromQueryToOrganisation($result): Organisation {
        return new Organisation(
            $result[0]["id"],
            $result[0]["nom"],
            $result[0]["description"],
            $result[0]["lienSite"],
        );
    }

    protected function fromQueryToOrganisations($result): array {
        $organisations = [];
        foreach($result as $organisation) {
            $newOrganisation = new Organisation(
                $organisation["id"],
                $organisation["nom"],
                $organisation["description"],
                $organisation["lienSite"],
            );
            array_push($organisations, $newOrganisation);
        }
        return $organisations;
    }

    protected function fromQueryToUser(array $result): User {
        return new User(
            $result[0]["id"],
            $result[0]["nom"],
            $result[0]["prenom"],
            $result[0]["mail"],
            $result[0]["tel"],
            $result[0]["photo"],
            $result[0]["isAdmin"]
        );
    }
    
    protected function fromQueryToUsers(array $result): array {
        $users = [];
        foreach($result as $user) {
            $newUser = new User(
                $user["id"],
                $user["nom"],
                $user["prenom"],
                $user["mail"],
                $user["tel"],
                $user["photo"],
                $user["isAdmin"]
            );
            array_push($users, $newUser);
        }
        return $users;
    }

    protected function fromQueryToPropositions(array $result, User $author, array $tags, int $like, int $dislike): array {
        $users = [];
        foreach($result as $proposition) {
            $newUser = new Proposition(
                $proposition["id"],
                $author,
                $proposition["nom"],
                $proposition["description"],
                $tags,
                $proposition["date"],
                $like,
                $dislike,
            );
            array_push($users, $newUser);
        }
        return $users;
    }
}
