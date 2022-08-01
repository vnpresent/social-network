<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('/unauthorized',function (){
    return response()->json(['success'=>false,'message'=>'unauthorized','data'=>null]);
})->name('login');

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/logout',[AuthController::class,'logout']);
    Route::post('/refresh',[AuthController::class,'refresh']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/index',[UserController::class,'index']);
    Route::get('/me',[UserController::class,'me']);
    Route::post('/update',[UserController::class,'update']);
});

Route::group(['prefix' => 'post'], function () {
    Route::get('/index',[PostController::class,'index']);
    Route::post('/create',[PostController::class,'create']);
    Route::post('/update/{id}',[PostController::class,'update'])->can('post_update,id');
    Route::get('/show/{id}',[PostController::class,'show']);
//    Route::post('/comment',[PostController::class,'comment']);
});

Route::group(['prefix' => 'comment'], function () {
    Route::post('/create',[CommentController::class,'create']);
    Route::post('/update/{id}',[CommentController::class,'update'])->can('comment_update,id');
    Route::get('/delete',[CommentController::class,'delete'])->can('comment_delete,id');
});

Route::group(['prefix' => 'tag'], function () {
    Route::get('/search',[TagController::class,'search']);
});

Route::group(['prefix' => 'permission'], function () {
    Route::get('/index',[PermissionController::class,'index']);
    Route::post('/create',[PermissionController::class,'create']);
});

Route::group(['prefix' => 'role'], function () {
    Route::get('/index',[RoleController::class,'index']);
    Route::post('/create',[RoleController::class,'create']);
    Route::get('/show/{id}',[RoleController::class,'show']);
    Route::post('/update/{id}',[RoleController::class,'update']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/index',[AdminController::class,'index'])->can('admin_index');
    Route::post('/create',[AdminController::class,'create']);
    Route::post('/update/{id}',[AdminController::class,'update']);
    Route::post('/delete/{id}',[AdminController::class,'delete']);
});
