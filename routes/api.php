<?php

use App\Http\Controllers\ChangePasswordConroller;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

//Protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    //post
    Route::post('/logout', [LoginController::class, 'logout']);

    // company endpoints

    Route::get('allCompanies', [CompanyController::class , 'allCompanies']);
    Route::apiResource('companies', CompanyController::class);

    // User endpoints
    Route::apiResource('users', UserController::class);

    //Inventory endpoints
    Route::apiResource('inventories', InventoryController::class);

    //change password
    Route::post('change-password',  [ChangePasswordConroller::class, 'changePassword']);
});

//Public
Route::post('/login', [LoginController::class , 'login']);
Route::post('/register' , [RegisterController::class , 'register']);
