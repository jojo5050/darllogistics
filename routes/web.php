<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('about', 'aboutPage')->name('home.about');
    Route::get('contact', 'contactPage')->name('home.contact');
    Route::get('dispatch-services', 'dispatchPage')->name('home.dispatch');
    Route::get('privacy', 'privacyPage')->name('home.privacy');
});

Route::get('/ios/signup', function () {
    return view('register-ios');
})->name('ios.signup');

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])
    ->name('register');
