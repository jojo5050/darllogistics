<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\IosRegisterController;
use App\Models\User;

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

Route::get('/password/reset', function () {
    return view('password_reset_handler');
})->name('password.reset');

// 2. The API endpoint the JavaScript calls to sync MySQL
Route::post('/api/user/sync-password-reset', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'new_password' => 'required|min:6',
    ]);

    // Find the user in MySQL
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'success' => false, 
            'message' => 'User not found in local database.'
        ], 404);
    }

    // Update the password in MySQL
    // We hash it here so it's ready for the next standard login attempt
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'MySQL password updated successfully.'
    ]);
});