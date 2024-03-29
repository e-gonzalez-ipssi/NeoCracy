<?php

namespace App\Service;

use App\Entity\Organisation;
use App\Entity\User;
use App\Entity\Proposition;
use App\Manager\OrganisationManager;
use App\Service\UserService;
use Exception;

class  OrganisationService {

    private OrganisationManager $organisationManager;
    private UserService $userService;

    public function __construct (OrganisationManager $organisationManager, UserService $userService) {
        $this->organisationManager = $organisationManager;
        $this->userService = $userService;
    }

    /**
     * Fonction permettant de créer une organisation
     * 
     * @param User $user L'utilisateur qui créer l'organisation
     * @param string $nom Le nom de l'organisation a créer
     * @param string $descritpion Une description pour l'organisation
     * @param string $lienSite Un lien vers le site de l'organisation
     */
    public function createOrganisation (
        User $user,
        string $nom, 
        ?string $description, 
        ?string $lienSite,
        ?string $image
    ) {
        // si une organisation avec le même nom éxiste déjà, on renvoie une erreur
        try {
            $this->getOrganisationByName($nom);
            throw new Exception();
        }
        catch (Exception $e) {
            if ($e->getMessage() === "error-organisation-not-found") {
                $this->organisationManager->createOrganisation($nom, $description, $lienSite, $image, $user->getId() , $user->getMail());
            }
            else {
                throw new Exception("error-org-already-exist");
            }
            
        }
    }

    /**
     * Permet de récupéré une liste d'organisation
     * 
     * @return array Retourne la liste de toute les organisations
     */
    public function getOrganisations(): array {
        return $this->organisationManager->getOrganisations();
    }

    /**
     * Permet de récupéré un object Organisation via son id
     * 
     * @param int $id L'id de l'organisation a rechercher
     * 
     * @return Organisation L'organisation recherchée
     */
    public function getOrganisationById (int $id): Organisation {
        return $this->organisationManager->getOrganisationById($id);
    }

    /**
     * Permet de récupéré un object Organisation via son nom
     * 
     * @param string $nom Le nom de l'organisation a rechercher
     * 
     * @return Organisation L'organisation recherchée
     */
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
    public function addUserFromOrganisation(Organisation $org,  $userMail): void{
        $this->organisationManager->addUserToOrganisation($org->getId(), $userMail);
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
            $userRow = $user->arrayify();
            array_push($userRow , (object)['isAdmin' => $this->userIsOrgAdmin($user , $org->getId())]);
            array_push($membersList,  $userRow);
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

    /**
     * Permet d'ajouter un admin a une organisation
     * 
     * @param Organisation $org L'organisation dans laquelle on souhaite ajouter un admin
     * @param User $user L'utilisateur à ajouter en temps qu'admin
     */
    public function addAdminToOrganisation(Organisation $org, User $user){
        if ($this->userIsOrgAdmin($user, $org->getId())) {
            throw new Exception("user-is-already-admin");
        }

        if (!$this->userIsInOrganisation($user, $org->getId())) {
            throw new Exception("user-is-not-org-member");
        }

        $this->organisationManager->addAdminToOrganisation($org->getId(), $user->getId());
    }

    /**
     * Vérifie si un utilisateur est admin de l'organisation
     * 
     * @param User $user L'utilisateur d'on on souhaite vérifier les droits
     * @param int $orgId L'id de l'organisation
     * 
     * @return bool True = est admin / False = n'est pas admin
     * 
     * TODO ne plus utiliser $orgId mais $org
     */
    public function userIsOrgAdmin(User $user, int $orgId): bool {
        $admins = $this->organisationManager->getAdminsFromOrganisation($orgId);

        foreach ($admins as $admin) {
            if($admin["id_Utilisateur"] == $user->getId()){
                return true;
            }
        }
        return false;
    }

    /**
     * Permet de récupéré la listes des tags déjà éxistant d'une organisation
     * 
     * @param Organisation $org L'organisation d'on on souhaite récupéré les tags
     * 
     * @return array La liste des tags d'une organisation
     */
    public function getOrganisationTags(Organisation $org): array {
        return $this->organisationManager->getOrganisationTags($org->getId());
    }

    /**
     * Permet d'ajouter un tag à la listes des tags déjà éxistant d'une organisation
     * 
     * @param Organisation $org L'organisation ou on veux ajouter les tags
     * @param string $tagName Le nom du tag a ajouter
     */
    public function addTagToOrganisation(Organisation $org, string $tagName) {
        $this->organisationManager->addTagToOrganisation($org->getid(), $tagName);
    }

    /**
     * Permet de récupéré l'id d'un tag d'une organisation via son nom
     * 
     * @param Organisation $org L'organisation ou on veux chercher le tag
     * @param string $tagName Le nom du tag a récupérer
     * 
     * @return int L'id du tag
     */
    public function getTagId(Organisation $org, string $tagName): int {
        return $this->organisationManager->getTagId($org->getid(), $tagName);
    }
}
