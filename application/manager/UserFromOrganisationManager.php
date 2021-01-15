<?php 

include 'Manager.php';
include '../entity/Organisation.php';
include '../entity/User.php';
include '../service/OrganisationService.php';

class UserFromOrganisationManager extends Manager {

    private OrganisationService $organisationService;

    public function __construct(bd $bd, OrganisationService $organisationService) {
        parent::__construct($bd);
        $this->organisationService = $organisationService;
    }

    /**
     * Permet de récupéré les organisations d'un utilisateur
     * 
     * @param int $userId l'id de l'utilisateur dont on veux récupéré les organisations
     * 
     * @return array La liste des organisations de l'utlisateur au format Organisation
     */
    public function getOrganisationsFromUser(int $userId): array {
        /** @var string $newQuery */
        $newQuery = "SELECT `id_Organisation` FROM `Appartient` WHERE id_Utilisateur = $userId;";
        $this->setQuery($newQuery);
        $result = $this->query();
        
        return $result;
    }

    /**
     * Permet de récupéré les utilisateurs d'une organisation
     */
    public function getUserFromOrganisation(Organisation $org){

    }

    /**
     * Permet de récupéré les administrateurs d'une organisation
     */
    public function getAdminFromOrganisation(Organisation $org){

    }

    /**
     * Permet d'ajouter un utilisateur à une organisation
     */
    public function addUserFromOrganisation(User $user, Organisation $organisation){

    }

    /**
     * Permet de supprimer un utilisateur d'une organisation de la database
     */
    public function removeUserFromOrganisation(User $user, Organisation $organisation){

    }
}
