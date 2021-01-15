<?php 

include '../entity/Organisation.php';
include '../entity/User.php';
include '../service/ConnexionService.php';
include '../manager/UserFromOrganisationManager.php';

class UserFromOrganisationService  {

    private ConnexionService $connexionService;
    private UserFromOrganisationManager $userFromOrganisationManager;

    public function __construct(ConnexionService $connexionService, UserFromOrganisationManager $userFromOrganisationManager){
        $this->connexionService = $connexionService;
        $this->userFromOrganisationManager = $userFromOrganisationManager;
    }

    /**
     * Permet de vérifier si un utilisateur est dans une organisation
     */
    public function userIsInOrganisation(User $user, Organisation $org){
        if (in_array($org->getId(), $this->userFromOrganisationManager->getOrganisationsFromUser($user->getId()))) {
            return true;
        }
        return false;
    }

    /**
     * Permet de récupéré les utilisateurs d'une organisation
     */
    public function getUserFromOrganisation(Organisation $org){
        if (! $this->userIsInOrganisation($this->connexionService->getCurrentUser(), $org)) {
            throw new Exception("user-not-in-organisation");
        }
    }

    /**
     * Permet de récupéré les administrateurs d'une organisation
     */
    public function getAdminFromOrganisation(Organisation $org){
        if (! $this->userIsInOrganisation($this->connexionService->getCurrentUser(), $org)) {
            throw new Exception("user-not-in-organisation");
        }
    }

    /**
     * Permet d'ajouter un utilisateur à une organisation
     */
    public function addUserFromOrganisation(Organisation $org){
        
    }

    /**
     * Permet de supprimer un utilisateur d'une organisation de la database
     */
    public function removeUserFromOrganisation(Organisation $org){

    }
}
