<?php

namespace App\Service;

use App\Entity\Organisation;
use App\Entity\User;
use App\Manager\OrganisationManager;
use App\Service\ConnexionService;
use App\Service\UserService;
use Exception;

class  OrganisationService {

    private OrganisationManager $organisationManager;
    private ConnexionService $connexionService;
    private UserService $userService;

    public function __construct (OrganisationManager $organisationManager, ConnexionService $connexionService, UserService $userService) {
        $this->organisationManager = $organisationManager;
        $this->connexionService = $connexionService;
        $this->userService = $userService;
    }

    public function createOrganisation (
        User $user,
        string $nom, 
        ?string $description, 
        ?string $lienSite
    ) {
        // si une organisation avec le même nom éxiste déjà, on renvoie une erreur
        try {
            $this->getOrganisationByName($nom);
            throw new Exception();
        }
        catch (Exception $e) {
            if ($e->getMessage() === "error-organisation-not-found") {
                $this->organisationManager->createOrganisation($nom, $description, $lienSite, $user->getId());
            }
            else {
                throw new Exception("error-org-already-exist");
            }
            
        }
    }

    public function getOrganisationById (int $id): Organisation {
        return $this->organisationManager->getOrganisationById($id);
    }

    public function getOrganisationByName (string $nom): Organisation {
        return $this->organisationManager->getOrganisationByName($nom);
    }

    /**
     * Permet de supprimer une organisation
     * 
     * @param Organisation $org l'organisation
     * @param User $user l'utilisateur qui effectue l'action
     * 
     * @return void
     */
    public function deleteOrganisation(Organisation $org , User $user): void{
        if(
            !in_array($user, $this->getAdminsFromOrganisation($org))
            && !$user->isAdmin() // si l'utilisateur est admin du site il peut supprimer n'importe quel org
        )
        {
            throw new Exception("error-no-permission");
        }

        // Renvoie une erreur si organisation inexistant
        $this->organisationManager->deleteOrganisation($org, $user->getNom());
    }

    /**
     * Permet de vérifier si un utilisateur est dans une organisation
     * 
     * @param User $user l'utilisateur dont on veux vérifier l'appartenance
     * @param Organisation $org l'organisation
     * 
     * @return bool
     */
    public function userIsInOrganisation(User $user, int $orgId): bool{
        $userOrgs =  $this->organisationManager->getOrganisationsFromUser($user->getId());
        foreach ($userOrgs as $org) {
            if($org["id_Organisation"] == $orgId){
                return true;
            }
        }
        return false;
    }

    /**
     * Permet d'ajouter un utilisateur à une organisation
     */
    public function addUserFromOrganisation(Organisation $org, User $user): void{
        $this->organisationManager->addUserToOrganisation($org->getId(), $user->getId());
    }

    /**
     * Permet de supprimer un utilisateur d'une organisation de la database
     */
    public function removeUserFromOrganisation(Organisation $org, User $user): void{
        if ($this->userIsInOrganisation($user, $org->getId())) {
            throw new Exception("user-not-in-organisation");
        }

        $this->organisationManager->deleteUserToOrganisation($org->getId(), $user->getId());
    }

    /**
     * Permet de récupéré les utilisateurs d'une organisation
     */
    public function getUsersFromOrganisation(Organisation $org){
        $membersId = $this->organisationManager->getUsersFromOrganisation($org->getId());
    
        $membersList = [];
    
        foreach($membersId as $userId) {
            $user = $this->userService->getUserById($userId["id_Utilisateur"]);
            array_push($membersList, $user->arrayify());
        }

        return $membersList;
    }

    /**
     * Permet de récupéré les administrateurs d'une organisation
     */
    public function getAdminsFromOrganisation(Organisation $org){
        $adminsId = $this->organisationManager->getAdminsFromOrganisation($org->getId());
    
        $adminsList = [];
    
        foreach($adminsId as $userId) {
            $user = $this->userService->getUserById($userId["id_Utilisateur"]);
            array_push($adminsList, $user->arrayify());
        }

        return $adminsList;
    }

    public function addAdminToOrganisation(Organisation $org, User $user){
        if ($this->userIsOrgAdmin($user, $org->getId())) {
            throw new Exception("user-is-already-admin");
        }

        // si l'utilisateur n'est pas dans l'organisation on le rajoute
        if (!$this->userIsInOrganisation($user, $org->getId())) {
            $this->addUserFromOrganisation($org, $user);
        }

        $this->organisationManager->addAdminToOrganisation($org->getId(), $user->getId());
    }

    public function userIsOrgAdmin(User $user, int $orgId): bool {
        $admins = $this->organisationManager->getAdminsFromOrganisation($orgId);

        foreach ($admins as $admin) {
            if($admin["id_Utilisateur"] == $user->getId()){
                return true;
            }
        }
        return false;
    }
}
