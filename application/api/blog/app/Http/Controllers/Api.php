<?php

namespace App\Http\Controllers;

use App\Entity\User;
use App\Entity\bd;
use App\Manager\UserManager;
use App\Service\ConnexionService;
use App\Service\UserService;
use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;

include "Constant.php";

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
            //check sur les types
            $this->checkType($param[2], $param[3]);


            // on ajoute le paramêtre a la liste
            // check si le paramêtre est REQUIRED ou non
            if ($param[1]) {
                if (empty($param[3])) {
                    throw new Exception("param-is-required");
                }
                $result [$param[0]] = $param[3];
            }
            if (empty($param[3])) {
                $result [$param[0]] = null;
            }
            else {
                $result [$param[0]] = $param[3];
            }
        }

        return $result;
    }

    private function checkType(int $typeRequired, $value) {
        if ($typeRequired === TYPE_INT) {
            $value = intval($value);
            if(!is_int($value) && !is_null($value)) {
                throw new Exception("type-is-invalid");
            }
        }

        if ($typeRequired === TYPE_STRING) {
            if(!is_string($value) && !is_null($value)) {
                throw new Exception("type-is-invalid");
            }
        }

        if ($typeRequired === TYPE_INT_NOT_NEGATIF_OR_NULL) {
            $value = intval($value);
            if(!is_int($value) && !is_null($value) && $value <= 0) {
                throw new Exception("type-is-invalid");
            }
        }

    }

    protected function returnOutput($result){
            return response()->json($result);
    }

    protected function ack() {
        return ["ack" => TRUE];
    }
}
