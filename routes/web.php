<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\AdSearchController;
use App\Http\Controllers\CRUDUserController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//HOME PAGES

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');

//AUTHENTICATION STEPS

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


require __DIR__ . '/auth.php';

// CRUD PAGE

Route::get('/profile', [CRUDUserController::class, 'index'])->middleware('verified')->name('profile');
Route::resource('profile', CRUDUserController::class);

//ADS PAGE

Route::get('/ads', [AdsController::class, 'index'])->middleware('verified')->name('ads');
Route::resource('ads', AdsController::class, [ 'names' => ['index' => 'ads']]);

//SEARCH ADS

Route::get('/search', [AdSearchController::class, 'index'])->name('search');
Route::post('/search', [AdSearchController::class, 'index']);

//MESSENGER

Route::get('/home', [MessageController::class, 'index'])->name('home');
Route::get('/message/{id}', [MessageController::class, 'getMessage'])->name('message');
Route::post('message', [MessageController::class, 'sendMessage']);