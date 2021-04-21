<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

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

        if(array_key_exists('organisation', $paramsClean)) {
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
                if (!$this->orgService->userIsInOrganisation($this->me, $orgId)) {
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
                ["tags", NOT_REQUIRED, TYPE_STRING, $request->input('tags'), ""]
            ],
            self::IS_ORG_MEMBER
        );

        $org = $this->orgService->getOrganisationById($params['organisation']);
        $this->propositionService->createProposition($org, $this->me, $params['title'], $params['description'], $params['tags']);
        return $this->returnOutput($this->ack());
    }

    /**
     * @route get(api/proposition/{id}/tags)
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     */
    public function getPropositionTags(int $id) {
        $this->initialize([], self::NO_RIGHT, false);

        $proposition = $this->propositionService->getPropositionById($id);

        $result = [];
        foreach($proposition->getTag() as $tag) {
            array_push($result, $tag->arrayify());
        }
        return $this->returnOutput($result);
    }

    /**
     * @route post(api/proposition/{id}/like)
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     */
    public function likeProposition(Request $request, int $id) {
        $this->initialize(
            [
                ["organisation", REQUIRED, TYPE_INT, $request->input('organisation')],
            ], self::IS_ORG_MEMBER, true);


        $proposition = $this->propositionService->getPropositionById($id);
        $this->propositionService->likeProposition($proposition, $this->me);

        return $this->returnOutput($this->ack());
    }
    
    /**
     * @route post(api/proposition/{id}/dislike)
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     */
    public function dislikeProposition(Request $request, int $id) {
        $this->initialize(
            [
                ["organisation", REQUIRED, TYPE_INT, $request->input('organisation')],
            ], self::IS_ORG_MEMBER, true);

        $proposition = $this->propositionService->getPropositionById($id);
        $this->propositionService->dislikeProposition($proposition, $this->me);

        return $this->returnOutput($this->ack());
    }

    /**
<<<<<<< HEAD
     * @route get(api/proposition/{id}/vote)
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     */
    public function getVote(Request $request, int $id) {
        $this->initialize(
            [
            ],  self::NO_RIGHT, true);

        $proposition = $this->propositionService->getPropositionById($id);
        $like = $proposition->getLike();
        $dislike = $proposition->getDislike();

        $likers = $this->propositionService->getLikers($proposition);
        $dislikers = $this->propositionService->getDislikers($proposition);

        $return = [];

        $return["like"] = [
            "number" => $like,
            "users" => $likers,
        ];
        $return["dislike"] = [
            "number" => $dislike,
            "users" => $dislikers,
        ];

        return $this->returnOutput($return);
=======
     * @route get(api/proposition/organisation/{orgId})
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     */
    public function getPropositionByOrgId(int $orgId) {
        $this->initialize([], self::NO_RIGHT, false);

        $propositions = $this->propositionService->getPropositionByOrgId($orgId);

        $result = [];
        foreach($propositions as $proposition) {
            array_push($result, $proposition->arrayify());
        }

        return $this->returnOutput($result);
>>>>>>> 3ddb8a869a7f87e4f3ee360a6674c2e40bcde23b
    }
}
