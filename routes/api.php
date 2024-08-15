<?php

<<<<<<< HEAD
use App\Http\Controllers\ApiControllers\CategoryController;
use App\Http\Controllers\ApiControllers\CityController;
use App\Http\Controllers\ApiControllers\CountryController;
use App\Http\Controllers\ApiControllers\GovernorateController;
use App\Http\Controllers\ApiControllers\ProductController;
=======
use App\Http\Controllers\Api\CategoryController;
>>>>>>> 88b59fffecc57da7a36944e1c00996fce5555674
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<<<<<<< HEAD
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/countries', [CountryController::class, 'index']);
Route::get('/governorates', [GovernorateController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);
=======
Route::get("ahmed", [CategoryController::class , "getCategories"]);
>>>>>>> 88b59fffecc57da7a36944e1c00996fce5555674
