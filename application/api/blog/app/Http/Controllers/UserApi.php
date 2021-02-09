<?php

namespace App\Http\Controllers;

use App\Entity\bd;
use App\Manager\UserManager;
use App\Service\UserService;

class UserApi extends Api
{
    private UserService $userService;

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
    }

    public function getUser($id) {
        $user = $this->userService->getUserById($id);
        return response()->json($user->arrayify());
    }
    //
}
