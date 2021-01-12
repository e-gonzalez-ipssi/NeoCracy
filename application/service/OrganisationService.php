<?php

include '../manager/OrganisationManager.php';

class  OrganisationService {

    private OrganisationManager $organisationManager;

    public function __construct (OrganisationManager $organisationManager) {
        $this->$organisationManager = $organisationManager;
    }

    public function addOrganisation (string $nom, string $description, string $lienSite): array {

        return $this->organisationManager->createOrganisation($nom, $description, $lienSite);
    }

    public function getOrganisationById (int $id): User {
        return $this->organisationManager->getUserById($id);
    }

    public function getOrganisationByName (string $nom): array {
        return $this->organisationManager->getOrganisationByName($nom);
    }

}
