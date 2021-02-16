<?php

namespace App\Http\Controllers;

use App\Entity\User;
use Illuminate\Http\Request;

class OrganisationApi extends Api
{
    private const NO_RIGHT = 1;

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
        bool $isConnected = true
    ): array {
        if ($isConnected) {
            $this->me = $this->connexionService->getCurrentUser();
        }

        $this->checkAccess($right, $this->me);

        $paramsClean = $this->getParams($params);

        return $paramsClean;
    }

    /**
     * Permet de faire des différents check de permission
     * - créer un nouveau case par nouveau type de permission
     */
    private function checkAccess(int $right, ?User $me) {
        switch ($right) {
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
     * @param int $id l'id de l'organisation que l'on recherche
     * 
     * @return  mixed les informations de l'organisation au format JSON
     */
    public function getOrgMembers(int $id) {
        $this->initialize([], self::NO_RIGHT, true);

        $users = $this->orgService->getUsersFromOrganisation($id);
        return $this->returnOutput($users);
    }
}
