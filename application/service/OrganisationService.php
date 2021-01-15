<?php

include '../manager/OrganisationManager.php';

class  OrganisationService {

    private OrganisationManager $organisationManager;

    public function __construct (OrganisationManager $organisationManager) {
        $this->$organisationManager = $organisationManager;
    }

    public function createOrganisation (string $nom, string $description, string $lienSite , User $user): array {
        return $this->organisationManager->createOrganisation($nom, $description, $lienSite, $user->getNom());
    }

    public function getOrganisationById (int $id): Organisation {
        return $this->organisationManager->getOrganisationById($id);
    }

    public function getOrganisationByName (string $nom): array {
        return $this->organisationManager->getOrganisationByName($nom);
    }

    public function deleteOrganisation(string $nom , User $user){
        // TODO: ajouter une condition pour empecher un utilisateur qui n'est pas admin d'une org de la delete

        // Renvoie une erreur si organisation inexistant
        $this->organisationManager->getOrganisationByName($nom);
        return $this->organisationManager->deleteOrganisation($nom, $user->getNom());
    }

    /**
     * Permet de vérifier si un utilisateur est dans une organisation
     */
    public function userIsInOrganisation(User $user, Organisation $org){
        if (in_array($org->getId(), $this->organisationManager->getOrganisationsFromUser($user->getId()))) {
            return true;
        }
        return false;
    }

    /**
     * Permet d'ajouter un utilisateur à une organisation
     */
    public function addUserFromOrganisation(Organisation $org, User $user){
        if (! $this->userIsInOrganisation($this->connexionService->getCurrentUser(), $org)) {
            throw new Exception("user-not-in-organisation");
        }
        $this->organisationManager->addUserToOrganisation($org->getId(), $user->getId());
    }

    /**
     * Permet de supprimer un utilisateur d'une organisation de la database
     */
    public function removeUserFromOrganisation(Organisation $org, User $user){
        if (! $this->userIsInOrganisation($this->connexionService->getCurrentUser(), $org)) {
            throw new Exception("user-not-in-organisation");
        }
        $this->organisationManager->deleteUserToOrganisation($org->getId(), $user->getId());
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

}
