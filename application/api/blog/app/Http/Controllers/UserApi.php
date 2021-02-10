<?php

namespace App\Http\Controllers;

use App\Entity\bd;
use App\Entity\User;
use App\Manager\UserManager;
use App\Service\ConnexionService;
use App\Service\UserService;

class UserApi extends Api
{
    private const NO_RIGHT = 1;

    private ?User $me = null;
    private UserService $userService;
    private ConnexionService $connexionService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $bd = new bd();
        $userManager = new UserManager($bd);
        $this->userService = new UserService($userManager);
        $this->connexionService = new ConnexionService($this->userService, $userManager);
    }

    private function initialize(
        array $param = [],
        int $right = self::NO_RIGHT,
        bool $isConnected = true
    ) {
        if ($isConnected) {
            $this->me = $this->connexionService->getCurrentUser();
        }

        $this->checkAccess($right, $this->me);

        // TODO #95 faire une méthode pour récupéré les paramêtres et les initializers en parametre utilisable
    }

    private function checkAccess(int $right, ?User $me) {
        switch ($right) {
            case self::NO_RIGHT:
            default:
                return;
        }
    }

    /**
     * @route get(api/user/{id})
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     * 
     * @return  mixed les informations de l'utilisateur au format JSON
     */
    public function getUser(int $id) {
        $this->initialize([], self::NO_RIGHT, false);
        $user = $this->userService->getUserById($id);
        return $this->returnOutput($user->arrayify());
    }
}
