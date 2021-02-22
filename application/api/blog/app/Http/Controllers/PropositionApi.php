<?php

namespace App\Http\Controllers;

use App\Entity\User;
use App\Entity\Proposition;
use Illuminate\Http\Request;
use App\Entity\Organisation;
use Exception;
use Hamcrest\Type\IsInteger;

class PropositionApi extends Api
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
        bool $isConnected = true
    ): array {
        if ($isConnected) {
            $this->me = $this->connexionService->getCurrentUser();
        }

        $paramsClean = $this->getParams($params);

        if($paramsClean['organisation']) {
            $this->checkAccess($right, $paramsClean['organisation']);
        }
        else {
            $this->checkAccess($right);
        }

        return $paramsClean;
    }

    /**
     * Permet de faire des différents check de permission
     * - créer un nouveau case par nouveau type de permission
     */
    private function checkAccess(int $right, ?int $orgId = null) {
        switch ($right) {
            case self::IS_ORG_MEMBER:
                if (!$this->orgService->userIsOrgAdmin($this->me, $orgId)) {
                    throw new Exception("error-permission-error");
                }
                break;
            case self::NO_RIGHT:
            default:
                return;
        }
    }

    /**
     * @route get(api/proposition/{id})
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     */
    public function getProposition(int $id) {
        $this->initialize([], self::NO_RIGHT, false);

        $proposition = $this->propositionService->getPropositionById($id);
        return $this->returnOutput($proposition->arrayify());
    }

    /**
     * @route post(api/proposition/)
     */
    public function createProposition(Request $request) {
        $params = $this->initialize(
            [
                ["organisation", REQUIRED, TYPE_INT, $request->input('organisation')],
                ["title", REQUIRED, TYPE_STRING, $request->input('title')],
                ["description", NOT_REQUIRED, TYPE_STRING, $request->input('description'), ""],
                // ajouter les tags une fois que ca marchera pour le reste
            ],
            self::IS_ORG_MEMBER
        );

        $org = $this->orgService->getOrganisationById($params['organisation']);
        $this->propositionService->createProposition($org, $this->me, $params['title'], $params['description']);

        return $this->returnOutput($this->ack());
    }

    /**
     * @route get(api/proposition/{id}/tags)
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     */
    public function getPropositionTags(int $id) {
        $this->initialize([], self::NO_RIGHT, false);

        $tags = $this->propositionService->getPropositionTags($id);

        $result = [];
        foreach($tags as $tag) {
            array_push($result, $tag->arrayify());
        }
        return $this->returnOutput($result);
    }
}
