<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('user/login',[AuthController::class,'login']);
Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');
Route::post('register',[AuthController::class,'register']);

//post
 Route::get('allPostList',[PostController::class,'getAllPost']);
 Route::post('post/search',[PostController::class,'postSearch']);
 Route::post('post/details',[PostController::class,'postDetails']);
 //category
 Route::get('allCategory',[CategoryController::class,'getAllCategory']);
 Route::post('category/search',[CategoryController::class,'categorySearch']);

 //action log
 Route::post('post/actionLog',[ActionLogController::class,'setActionLog']);
