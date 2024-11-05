<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerformanceTestController;


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

Route::get('/', function () {
    return view('app');
});
//Route to redirect to Google
Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);

// Route for Google callback
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/performance-test', function () {
    return view('app'); // Assuming 'app' is your main Blade view loading the Vue app
});