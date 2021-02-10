<?php

namespace App\Http\Controllers;

use App\Entity\User;
use App\Entity\bd;
use App\Manager\UserManager;
use App\Service\ConnexionService;
use App\Service\UserService;
use Laravel\Lumen\Routing\Controller as BaseController;

class Api extends BaseController
{
    protected ?User $me = null;
    protected static UserService $userService;
    protected static ConnexionService $connexionService;

    protected function __construct() 
    {
        // ici on instancieras TOUT les services et manager
        $bd = new bd();
        $userManager = new UserManager($bd);
        $this->userService = new UserService($userManager);
        $this->connexionService = new ConnexionService($this->userService, $userManager);
    }

    protected function returnOutput($result){
            return response()->json($result);
    }
}
