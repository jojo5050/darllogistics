<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\IosRegisterController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('about', 'aboutPage')->name('home.about');
    Route::get('contact', 'contactPage')->name('home.contact');
    Route::get('dispatch-services', 'dispatchPage')->name('home.dispatch');
    Route::get('privacy', 'privacyPage')->name('home.privacy');
});


Route::get('/ios/signup', [IosRegisterController::class, 'showSignupForm'])
    ->name('ios.signup');

    Route::prefix('ios/register')->group(function () {
        Route::post('/user', [IosRegisterController::class, 'registerUser']);
        Route::post('/company', [IosRegisterController::class, 'registerCompany']);
    });


Route::get('/select-plan', function () {
    return view('payment.select-plan', [
        'userEmail' => session('user_email'),
        'userId' => session('user_id'),
    ]);
})->name('select.plan');


Route::get('/payment', function (\Illuminate\Http\Request $request) {

    return view('payment.pay', [
        'plan_id'   => $request->plan_id,
        'amount'    => $request->amount,
        'userEmail' => session('user_email'),
        'apiToken'  => session('api_token'), 
    ]);

})->name('payment.page');