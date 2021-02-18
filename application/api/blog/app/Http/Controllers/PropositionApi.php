<?php

namespace App\Http\Controllers;

use App\Entity\User;
use App\Entity\Proposition;
use Illuminate\Http\Request;

class PropositionApi extends Api
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
}
