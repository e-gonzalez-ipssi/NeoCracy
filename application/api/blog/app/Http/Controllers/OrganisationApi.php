<?php

namespace App\Http\Controllers;

use App\Entity\User;
use Illuminate\Http\Request;
use Exception;

class OrganisationApi extends Api
{
    private const NO_RIGHT = 1;
    private const IS_ORG_MEMBER = 2;

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
    ): array {
        if ($isConnected) {
            $this->me = $this->connexionService->getCurrentUser();
        }

        $this->checkAccess($right, $orgId);

        $paramsClean = $this->getParams($params);

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
                    throw new Exception("error-permission-error");
                }
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
    public function getOrg(int $id) {
        $this->initialize([], self::NO_RIGHT, false);

        $org = $this->orgService->getOrganisationById($id);
        return $this->returnOutput($org->arrayify());
    }

    /**
     * @route get(api/organisation/{id}/members)
     * 
     * @param int $orgId l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function getOrgMembers(int $orgId) {
        $this->initialize([], self::IS_ORG_MEMBER, true, $orgId);

        $users = $this->orgService->getUsersFromOrganisation($orgId);
        return $this->returnOutput($users);
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
                ["lienSite", NOT_REQUIRED, TYPE_STRING, $request->input('lienSite'), 'www.neocracy.fr'],
            ],
            self::NO_RIGHT, 
            true
        );

        $this->orgService->createOrganisation(
            $this->me,
            $params["nom"],
            $params["description"],
            $params["lienSite"],
        );
        return $this->returnOutput($this->ack());
    }
}
