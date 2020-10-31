<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmersonTestesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**Route for login API */


//get token
Route::post('token', [AuthController::class, 'auth']);

/**Midlleware for Auth Routes */
Route::middleware('auth:api')->group(function(){
    Route::resources([
        'user' => UserController::class,
    ]);
   
});

