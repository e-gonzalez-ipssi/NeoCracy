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
        return $this->organisationManager->getUserById($id);
    }

    public function getOrganisationByName (string $nom): array {
        return $this->organisationManager->getOrganisationByName($nom);
    }

    public function deleteOrganisation(string $nom , User $user){
        // Renvoie une erreur si organisation inexistant
        $this->organisationManager->getOrganisationByName($nom);
        return $this->organisationManager->deleteOrganisation($nom, $user->getNom());
    }

}
