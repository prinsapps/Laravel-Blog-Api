<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\CommentController;
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
Route::group(['prefix' => 'v1'], function(){
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class,'login']);
    Route::get('login', ['as'=>'login',RegisterController::class,'login']);
});
   
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::resource('blogs', BlogController::class);
    Route::resource('comment', CommentController::class);
    Route::get('/user', function( Request $request ){
     return $request->user();
    });
});
