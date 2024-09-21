<?php

use App\Http\Controllers\ApiControllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Mail\SendCode;
use App\Mail\SendOTP;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/send', function () {
//     try{

//         $mail = Mail::to('ahmedsewidan139@gmail.com')->send(new SendOTP('1235'));

//         if( $mail ){
//             return 'Mail sent successfully';
//         }
        
//     } catch ( \Exception $e ){

//         return $e->getMessage();
//     }
// });
