<?php

namespace App\Http\Controllers;

use App\Entity\Organisation;
use Illuminate\Http\Request;
use Exception;

class OrganisationApi extends Api
{
    private const NO_RIGHT = 1;
    private const IS_ORG_MEMBER = 2;
    private const IS_NOT_ORG_MEMBER = 3;
    private const IS_ORG_ADMIN = 4;

    private Organisation $org;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fonction qui permet d'initialiser la requete
     *  - initilise les paramêtres requis ou non pour faire fonctionner l'api
     *  - fait les checks de permissions d'utilisation
     *  - vérifie si l'utilisateur a besoin d'être connecté ou pas
     */
    private function initialize(
        array $params = [],
        int $right = self::NO_RIGHT,
        bool $isConnected = true,
        int $orgId = null
    ){
        $paramsClean = $this->getParams($params);

        if ($isConnected) {
            if(isset($paramsClean["userToken"])){
                $userToken = $paramsClean["userToken"];
                $this->me = $this->connexionService->getCurrentUserWithToken($userToken);
            } 
            else {
                $this->me = $this->connexionService->getCurrentUser();
            } 
        }

        if(!is_null($orgId)){
            $this->org = $this->orgService->getOrganisationById($orgId);
        }

        $this->checkAccess($right, $orgId);

        return $paramsClean;
    }

    /**
     * Permet de faire des différents check de permission
     * - créer un nouveau case par nouveau type de permission
     */
    private function checkAccess(int $right, int $orgId = null) {
        switch ($right) {
            case self::IS_ORG_MEMBER:
                if (!$this->orgService->userIsInOrganisation($this->me, $orgId)) {
                    throw new Exception("error-permission");
                }
                break;
            case self::IS_NOT_ORG_MEMBER:
                if ($this->orgService->userIsInOrganisation($this->me, $orgId)) {
                    throw new Exception("error-permission");
                }
                break;
            case self::IS_ORG_ADMIN:
                if (!$this->orgService->userIsOrgAdmin($this->me, $orgId)) {
                    throw new Exception("error-permission");
                }
                break;
            case self::NO_RIGHT:
            default:
                return;
        }
    }

    /**
     * @route get(api/organisation/{id})
     * 
     * @param int $id l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function getOrg(int $orgId) {
        $this->initialize([], self::NO_RIGHT, false, $orgId);

        return $this->returnOutput($this->org->arrayify());
    }

    /**
     * @route get(api/organisation/{id}/members)
     * 
     * @param int $orgId l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function getOrgMembers(Request $request, int $orgId) {
        $this->initialize([
            ["userToken", NOT_REQUIRED, TYPE_STRING, $request->input('userToken')],
        ], self::IS_ORG_MEMBER, true, $orgId);

        $users = $this->orgService->getUsersFromOrganisation($this->org);
        return $this->returnOutput($users);
    }

    /**
     * @route get(api/organisation/{id}/admins)
     * 
     * @param int $orgId l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function getOrgAdmins(Request $request, int $orgId) {
        $this->initialize([
            ["userToken", NOT_REQUIRED, TYPE_STRING, $request->input('userToken')],
        ], self::IS_ORG_MEMBER, true, $orgId);

        $users = $this->orgService->getAdminsFromOrganisation($this->org);
        return $this->returnOutput($users);
    }

    
    /**
     * @route post(api/organisation/{orgId}/admins)
     * 
     * @param int $orgId l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function addOrgAdmin(Request $request, int $orgId) {
        $params = $this->initialize(
            [                
                ["mail", REQUIRED, TYPE_MAIL, $request->input('mail')],
                ["userToken", NOT_REQUIRED, TYPE_STRING, $request->input('userToken')],
            ], 
            self::IS_ORG_MEMBER, 
            true, 
            $orgId
        );

        $userToAdd = $this->userService->getUserByMail($params["mail"]);
        $this->orgService->addAdminToOrganisation($this->org, $userToAdd);
        return $this->returnOutput($this->ack());
    }

    /**
     * @route post(api/organisation/{id}/members)
     * 
     * @param int $orgId l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function addOrgMembers(Request $request, int $orgId) {
        $params = $this->initialize([
            ["email", REQUIRED, TYPE_MAIL, $request->input('email')],
            ["userToken", NOT_REQUIRED, TYPE_STRING, $request->input('userToken')],
        ], self::IS_ORG_ADMIN, true, $orgId);

        $this->orgService->addUserFromOrganisation($this->org, $params['email']);
        return $this->returnOutput($this->ack());
    }

    /**
     * @route post(api/organisation/)
     * 
     * @param int $id l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function createOrg(Request $request) {
        $params = $this->initialize(
            [
                ["nom", REQUIRED, TYPE_STRING, $request->input('nom')],
                ["description", NOT_REQUIRED, TYPE_STRING, $request->input('description'), 'La super description de mon organisation'],
                ["lienSite", NOT_REQUIRED, TYPE_URL, $request->input('lienSite'), 'www.neocracy.fr'],
                ["image", NOT_REQUIRED, TYPE_URL, $request->input('image'), ''],
                ["userToken", NOT_REQUIRED, TYPE_STRING, $request->input('userToken')],
            ],
            self::NO_RIGHT, 
            true
        );

        $this->orgService->createOrganisation(
            $this->me,
            $params["nom"],
            $params["description"],
            $params["lienSite"],
            $params["image"],
        );
        return $this->returnOutput($this->ack());
    }
}
