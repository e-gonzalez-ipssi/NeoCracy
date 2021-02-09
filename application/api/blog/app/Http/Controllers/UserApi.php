<?php

namespace App\Http\Controllers;

use Neocracy\Entity\bd;
use UserManager;
use UserService;

include "..\..\..\..\..\\entity\bd.php";
include "..\..\..\..\..\\service\UserService.php";
include "..\..\..\..\..\\manager\UserManager.php";

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
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'neocracy';

        $bd = new bd($dbhost, $dbuser, $dbpass, $dbname);
        $userManager = new UserManager($bd);
        $this->userService = new UserService($userManager);
    }

    public function getUser($id) {
        $user = $this->userService->getUserById($id);

        return response()->json($user);
    }
    //
}
