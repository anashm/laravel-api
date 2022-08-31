<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/users')->group(function(){
	
	Route::get('/test',[UserController::class,'test']);
	Route::post('/register',[UserController::class,'register']);
	Route::post('/login',[UserController::class,'login']);
	Route::post('/getUserInfos',[UserController::class,'getUserInfos']);
	Route::post('/updateProfile',[UserController::class,'updateProfile'])->name('updateProfile');
});