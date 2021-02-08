<?php 

use Neocracy\Entity\Organisation;

include 'Manager.php';
include '../entity/Organisation.php';

class OrganisationManager extends Manager {

    /**
     * Cette fonction permet de setup la query pour créer un Organisation
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function createOrganisation(string $nom, string $description, string $lienSite , string $userName): array {
        /** @var string $newQuery */
        $newQuery = "INSERT INTO `Organisation` (`nom`, `description`, `lienSite`) VALUES ($nom, $description, $lienSite);";
        $this->setQuery($newQuery);
        $this->query();

        /** @var string $request */
        $request = "SELECT * FROM `Organisation`  WHERE nom = $nom;";
        $this->setQuery($request);
        $result = $this->query();

        if(count($result) >= 1){
            throw new Exception("error-creation-organisation-failed");
        }
        /** @var string $request2 */    
        $request2 = "INSERT INTO `estAdmin` (`id_Utilisateur`, `id_Organisation`) VALUES (
            (SELECT id FROM Utilisateur WHERE nom = $userName), 
            (SELECT id FROM Organisation WHERE nom = $nom));";
        $this->setQuery($request2);
        $this->query();

        return $this->ack("L'Organisation a bien été ajouté a la base de donnée");
    }

    /**
     * Cette fonction permet d'ajouter un membre dans une Organisation
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function addUserToOrganisation(string $organisationId , string $userId): array {
        /** @var string $request2 */    
        $request2 = "INSERT INTO `Appartient` (`id_Organisation`, `id_Utilisateur`) VALUES ($organisationId, $userId);";
        $this->setQuery($request2);
        $this->query();

        return $this->ack("L'user a bien été ajouté a l'organisation");
    }

    /**
     * Cette fonction permet de supprimer un membre d'une Organisation
     * 
     * @return array Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function deleteUserToOrganisation(string $organisationId , string $userId): array {
        /** @var string $request2 */    
        $request2 = "DELETE FROM `Appartient`  WHERE id_Organisation = $organisationId  AND id_Utilisateur = $userId ;";
        $this->setQuery($request2);
        $this->query();

        return $this->ack("L'user a bien été supprimé de l'organisation");
    }

    /**
     * Cette fonction permet de récupéré un Organisation
     * 
     * @param int $id L'id de l'Organisation que l'on recherche
     * 
     * @return Organisation Cette fonction retourne l'Organisation rechercher
     * 
     * @throw Exception Relève une expetion si l'Organisation n'a pas été trouvé
     */
    public function getOrganisationById(int $id): Organisation {
        if (!empty($this->inventory[$id])) {
            return $this->inventory[$id];
        }

        $newQuery = "SELECT `id`, `nom`, `description`, `lienSite` FROM `Organisation` WHERE id = $id";
        $this->setQuery($newQuery);

        $result = $this->query();

        if(count($result) < 1) {
            throw new Exception("error-organisation-not-found");
        }

        $org = $this->fromQueryToOrganisation($result);
        $this->inventory[$org->getId()] = $org;
        return $org;
    }

    /**
     * Cette fonction permet de récupéré un Organisation
     * 
     * @param string $nom Le nom des Organisations que l'on recherche
     * 
     * @return array Cette fonction retourne la liste d'Organisation possédant le nom rechercher
     * 
     * @throw Exception Relève une expetion si l'Organisation n'a pas été trouvé
     */
    public function getOrganisationByName(string $nom): array {
        $newQuery = "SELECT `id`, `nom`, `description`, `lienSite` FROM `Organisation` WHERE nom = $nom";
        $this->setQuery($newQuery);

        $result = $this->query();

        if(count($result) < 1) {
            throw new Exception("error-organisation-not-found");
        }

        return $this->fromQueryToOrganisations($result);
    }

    /**
     * Cette fonction permet de supprimer une Organisation
     * 
     * @return string Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function deleteOrganisation(string $nom, string $userName): array {
        /** @var string $newQuery */
        $newQuery = "DELETE FROM `estAdmin`  WHERE id_Organisation = (SELECT id FROM Organisation WHERE nom = $nom) AND 
        id_Utilisateur = (SELECT Id FROM Utilisateur WHERE nom = $userName) ;";
        $this->setQuery($newQuery);
        $this->query();
        /** @var string $request */
        $request = "DELETE FROM `Organisation`  WHERE nom = $nom ;";
        $this->setQuery($request);
        $this->query();

        return $this->ack("L'Organisation a bien été supprimé a la base de donnée");
    }

    /**
     * Permet de récupéré les organisations d'un utilisateur
     * 
     * @param int $userId l'id de l'utilisateur dont on veux récupéré les organisations
     * 
     * @return array La liste des organisations de l'utlisateur au format Id
     */
    public function getOrganisationsFromUser(int $userId): array {
        /** @var string $newQuery */
        $newQuery = "SELECT `id_Organisation` FROM `Appartient` WHERE id_Utilisateur = $userId;";
        $this->setQuery($newQuery);
        $result = $this->query();
        
        return $result;
    }

    /**
     * Permet de récupéré les organisations d'un utilisateur
     * 
     * @param int $orgId l'id de l'organisation dont on veux récupéré les membres abonnées
     * 
     * @return array La liste des organisations de l'utlisateur au format Id
     */
    public function getUsersFromOrganisation(int $orgId): array {
        /** @var string $newQuery */
        $newQuery = "SELECT `id_Utilisateur` FROM `Appartient` WHERE id_Organisation = $orgId;";
        $this->setQuery($newQuery);
        $result = $this->query();
        
        return $result;
    }

        /**
     * Permet de récupéré les organisations d'un utilisateur
     * 
     * @param int $orgId l'id de l'organisation dont on veux récupéré les membres admins
     * 
     * @return array La liste des organisations de l'utlisateur au format id
     */
    public function getAdminsFromOrganisation(int $orgId): array {
        /** @var string $newQuery */
        $newQuery = "SELECT `id_Utilisateur` FROM `estAdmin` WHERE id_Organisation = $orgId;";
        $this->setQuery($newQuery);
        $result = $this->query();
        
        return $result;
    }
}
