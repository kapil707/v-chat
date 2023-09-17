<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function login(Request $request) {
        return view("website/login");
    }

    public function home(Request $request) {
        return view("website/login");
    }


    public function insert_user(){

        $admin_user = new User;
        $admin_user->name = "kapil";
        $admin_user->email = "kapil707sharma@gmail.com";
        $admin_user->password = Crypt::encrypt("123456");
        $admin_user->save();
    }
}
