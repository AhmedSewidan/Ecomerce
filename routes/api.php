<?php

use App\Http\Controllers\ApiControllers\AuthController;
use App\Http\Controllers\ApiControllers\BrandController;
use App\Http\Controllers\ApiControllers\CategoryController;
use App\Http\Controllers\ApiControllers\CityController;
use App\Http\Controllers\ApiControllers\CountryController;
use App\Http\Controllers\ApiControllers\GovernorateController;
use App\Http\Controllers\ApiControllers\OrderController;
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

// Category Controller
Route::controller(CategoryController::class)->group(function(){

    Route::get('/categories', 'index');
    Route::get('/show-category/{id}', 'show')->name('show-category');

});

// Product Controller
Route::controller(ProductController::class)->group(function(){

    Route::get('/products', 'index');
    Route::get('/latest-products', 'latestProducts');
    Route::get('/most-ordered-products', 'mostOrdered');
    Route::get('/show-product/{id}', 'show')->name('show-product');

});

// Brand Controller
Route::controller(BrandController::class)->group(function(){

    Route::get('/all-brands', 'index');
    Route::get('/most-famous-brands', 'mostFamousBrands');
    Route::get('/brand-details', 'show');

});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/governorates', [GovernorateController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);

// Slider Controller
Route::controller(SliderController::class)->group(function(){

    Route::get('/sliders', 'index');
    Route::get('/home-slider', 'homeSlider')->name('home-slider');

});


Route::middleware(['guest'])->group(function(){
    Route::controller(AuthController::class)->group(function(){

        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/send-OTP', 'sendOTP');
        Route::post('/check-OTP', 'checkOTP');
    });
});


Route::middleware(['auth'])->group(function(){
    Route::controller(AuthController::class)->group(function(){

        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::post('/me', 'me');
        Route::put('/update/{id}', 'update');
        Route::post('/reset-password', 'resetPassword');
    });

    Route::controller( OrderController::class )->group( function(){

        Route::get('/order-in-cart', 'orderInCart');
        Route::post('/add-to-cart', 'addTOcart');
        Route::post('/edit-quantity', 'editQuantity');
        Route::get('/remove-from-cart', 'removeFromCart');
        Route::get('/clear-cart', 'clearCart');
    } );

});
