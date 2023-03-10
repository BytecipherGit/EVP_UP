<?php

namespace App\Helpers;
use App\Models\User;

class Helper {

    public static function helperfunction1(){
        return "helper function 1 response";
    }

    public static function getUserDetails($id=0){
        $user = User::find($id);
        return $user;
    }
}