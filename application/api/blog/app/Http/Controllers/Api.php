<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;

class Api extends BaseController
{
    protected function returnOutput($result){
            return response()->json($result);
    }
}
