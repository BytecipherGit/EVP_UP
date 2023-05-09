<?php

namespace App\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\EmailConfiguration;

class Helper {

    public static function helperfunction1(){
        return "helper function 1 response";
    }

    public static function getUserDetails($id=0){
        $user = User::find($id);
        return $user;
    }

    public static function getSmtpConfig($id=0)
    {
        $mail = EmailConfiguration::where('company_id',$id)->first();
        // dd($mail);
        if ($mail) {
            return $mail;     
        }
      
     }
   
}