<?php

namespace App\Http\Controllers;

use App\Entity\User;
use Illuminate\Http\Request;

include "Constant.php";

class UserApi extends Api
{
    private const NO_RIGHT = 1;

    public function __construct()
    {
        parent::__construct();
    }

    private function initialize(
        array $params = [],
        int $right = self::NO_RIGHT,
        bool $isConnected = true
    ) {
        if ($isConnected) {
            $this->me = $this->connexionService->getCurrentUser();
        }

        $this->checkAccess($right, $this->me);

        $paramsClean = $this->getParams($params);

        return $paramsClean;
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
        $params = $this->initialize([], self::NO_RIGHT, false);

        $user = $this->userService->getUserById($id);
        return $this->returnOutput($user->arrayify());
    }

    /**
     * @route post(api/connect/)
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     * 
     * @return  mixed les informations de l'utilisateur au format JSON
     */
    public function connect(Request $request) {
        $params = $this->initialize(
            [
                ["mail", true, 2, $request->input('mail')],
                ["password", true, 1, $request->input('password')],
            ],
            self::NO_RIGHT, 
            false, 
            $request
        );
        
        $this->connexionService->connexion();
        return $this->returnOutput($this->ack());
    }
}
