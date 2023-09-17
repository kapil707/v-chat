<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class WebApiController extends Controller
{
    public function login_api(Request $request) {

        $validator = Validator::make($request->all(),[
            'username'=>'required',
            'password'=>'required',
        ]);

        $password = ($request->password);

        $where = array(
            'email'=>$request->username,
        );

        $user = User::where($where)->get();
        if($user->count()>0){
            if(Crypt::decrypt($user[0]["password"])==$password){

                $items = array(
                    'user_id'=>$user[0]["id"],
                    'user_name'=>$user[0]["name"],
                    'user_email'=>$user[0]["email"],
                );

                $request->session()->put($items);

                return response()->json([
                    'status'=>'200',
                    'islogin'=>true,
                    'message'=>'Logged in successfully',
                    'items'=>$items,
                ],200);
            } else{
                return response()->json([
                    'status'=>'200',
                    'islogin'=>false,
                    'message'=>"Invalid password",
                ],200);
            }
        }else{
            return response()->json([
                'status'=>'404',
                'message'=>"User Not Found",
            ],404);
        }
    }
}
