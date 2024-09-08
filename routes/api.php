<?php

use App\Http\Controllers\ApiControllers\BrandController;
use App\Http\Controllers\ApiControllers\CategoryController;
use App\Http\Controllers\ApiControllers\CityController;
use App\Http\Controllers\ApiControllers\CountryController;
use App\Http\Controllers\ApiControllers\GovernorateController;
use App\Http\Controllers\ApiControllers\ProductController;
use App\Http\Controllers\ApiControllers\SliderController;
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

Route::get('/categories', [CategoryController::class, 'index']);

Route::controller(ProductController::class)->group(function(){

    Route::get('/products', 'index');
    Route::get('/latest-products', 'latestProducts');
    Route::get('/most-ordered-products', 'mostOrdered');

});

Route::controller(BrandController::class)->group(function(){

    Route::get('/all-brands', 'index');
    Route::get('/most-famous-brands', 'mostFamousBrands');
    Route::get('/brand-details', 'show');

});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/governorates', [GovernorateController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);
Route::get('/homeSlider', [SliderController::class, 'homeSlider']);
