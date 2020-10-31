<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function auth(Request $request){
       $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
             
        /**Check the validation becomes fails or not
        */
        if ($validator->fails()) {
            /**Return error message
            */
            return response()->json([ 'error'=> $validator->errors() ]);
        }
        /**Read the credentials passed by the user
    */
    $credentials = [
        'email' => $request->email,
        'password' => $request->password
    ];

    /**Check the credentials are valid or not
    */
    if( auth()->attempt($credentials) ){
        /**Store the information of authenticated user
        */
        $user = Auth::user();
        /**Create token for the authenticated user
        */
        
        $success['token'] = "Bearer ".$user->createToken('AppName')->accessToken;
        return response()->json(['success' => $success], 200);
    } else {
        /**Return error message
        */
        return response()->json(['error'=>'Unauthorised'], 401);
    }

   }
}
