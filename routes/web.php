<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\planController;
use App\Http\Controllers\PaymentController;

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

    
// Route::get('/payment-page', function (Illuminate\Http\Request $request) {
//         return view('payment.pay', [
//             'plan_id' => $request->plan_id,
//             'amount' => $request->amount
//         ]);
//     })->name('payment.page');  

Route::get('/payment-page', [PaymentController::class, 'showPaymentPage'])
    ->name('payment.page');

Route::get('/select-plan', [PlanController::class, 'showPlans'])->name('select.plan');
