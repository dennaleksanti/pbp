<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\register;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    // public function getAuthenticatedUser(){
    //     try{
    //         if(! $user = JWTAuth::parseToken()->authenticate()){
    //             return response()->json(['user_not_found'],404);
    //         }
    //     }catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
    //         return response()->json(['token_expired'], $e->getStatusCode());
    //     }catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
    //         return response()->json(['token_invalid'], $e->getStatusCode());
    //     }catch(Tymon\JWTAuth\Exceptions\JWTException $e){
    //         return response()->json(['token_absent'], $e->getStatusCode());
    //     }
    //     return response()->json(compact('user'));
    // }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
        ]);

        $credentials = $request->only('username','password');
        try{
            if(!$token = JWTAuth::attempt($credential)){
                return response()->json(['error'=>'Incorrect username or password'],404);
            }
        }catch(JWTException $e){
            return response()->json(['error'=>'could_not_create_token'],500);
        }
        return response()->json(['token'=>$token]);
    }

    public function logout()
    {
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['succes'=>true]);
        }catch(JWTException $e){
            return response()->json([
                'error'=>'Failed to logout, please try again'
            ],500);
        }
    }
}
