<?php

namespace App\Http\Controllers;

use App\Entity\User;
use App\Entity\bd;
use App\Manager\UserManager;
use App\Service\ConnexionService;
use App\Service\UserService;
use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;

class Api extends BaseController
{
    protected ?User $me = null;
    protected UserService $userService;
    protected ConnexionService $connexionService;

    protected function __construct() 
    {
        // ici on instancieras TOUT les services et manager
        $bd = new bd();
        $userManager = new UserManager($bd);
        $this->userService = new UserService($userManager);
        $this->connexionService = new ConnexionService($this->userService, $userManager);
    }

    protected function getParams($params) {
        if(empty($params)){
            return [];
        }


        $result = [];

        foreach ($params as $param) {
            if ($param[1]) {
                if (empty($_POST[$param[0]])) {
                    throw new Exception("param-is-required");
                }
                $result [$param[0]] = $_POST[$param[0]];
            }
            if (empty($_POST[$param[0]])) {
                $result [$param[0]] = null;
            }
            $result [$param[0]] = $_POST[$param[0]];
        }

        return $result;
    }

    protected function returnOutput($result){
            return response()->json($result);
    }

    protected function ack() {
        return ["ack" => TRUE];
    }
}
