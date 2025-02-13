<?php

use App\Http\Controllers\AssignedLoadController;
use App\Http\Controllers\AssignedVehicleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffSalaryController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\json;

Route::get('/', function () {
    return response()->json([
        "message" => "API reached successfully.",
        "code" => 1,
        "status" => "success"
    ]);
});

Route::post('/v2/register', [AuthController::class, 'register']);
Route::post('/v2/login', [AuthController::class, 'login']);
Route::post('/v2/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/v2/subscribers', [SubscriberController::class, 'store']);
Route::get('/v2/plans', [PlanController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('v2')->group(function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        // Vehicles Routes
        Route::prefix('vehicles')->group(function () {
            Route::get('/', [VehicleController::class, 'index']); // List all vehicles
            Route::post('/', [VehicleController::class, 'store']); // Create a new vehicle
            Route::get('/{id}', [VehicleController::class, 'show']); // Show a single vehicle
            Route::put('/{id}', [VehicleController::class, 'update']); // Update a vehicle
            Route::delete('/{id}', [VehicleController::class, 'destroy']); // Delete a vehicle
        });

        // Vehicles Assigned Routes
        Route::prefix('vehicles-assigned')->group(function () {
            Route::get('/', [AssignedVehicleController::class, 'index']);
            Route::post('/', [AssignedVehicleController::class, 'store']);
            Route::get('/{id}', [AssignedVehicleController::class, 'show']);
            Route::put('/{id}', [AssignedVehicleController::class, 'update']);
            Route::delete('/{id}', [AssignedVehicleController::class, 'destroy']);
        });

        // Wages Routes
        Route::prefix('wages')->group(function () {
            Route::get('/', [WageController::class, 'index']);
            Route::post('/', [WageController::class, 'store']);
            Route::get('/{id}', [WageController::class, 'show']);
            Route::put('/{id}', [WageController::class, 'update']);
            Route::delete('/{id}', [WageController::class, 'destroy']);
        });

        // Users Routes
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);

            Route::get('/profiles', [ProfileController::class, 'index']);
            Route::get('/profiles/{id}', [ProfileController::class, 'show']);
            Route::put('/profiles/{id}', [ProfileController::class, 'update']);
            Route::get('/profile', [ProfileController::class, 'userProfile']);
            Route::delete('/profiles/{id}', [ProfileController::class, 'destroy']);
        });

        // Loads Routes
        Route::prefix('loads')->group(function () {
            Route::get('/', [LoadController::class, 'index']);
            Route::post('/', [LoadController::class, 'store']);
            Route::get('/{load_id}', [LoadController::class, 'show']);
            Route::put('/{load_id}', [LoadController::class, 'update']);
            Route::delete('/{load_id}', [LoadController::class, 'destroy']);
        });

        // Loads Assigned Routes
        Route::prefix('loads-assigned')->group(function () {
            Route::get('/', [AssignedLoadController::class, 'index']);
            Route::post('/', [AssignedLoadController::class, 'store']);
            Route::get('/{id}', [AssignedLoadController::class, 'show']);
            Route::put('/{id}', [AssignedLoadController::class, 'update']);
            Route::delete('/{id}', [AssignedLoadController::class, 'destroy']);
        });

        // Tickets Routes
        Route::prefix('tickets')->group(function () {
            Route::get('/', [TicketController::class, 'index']);
            Route::post('/', [TicketController::class, 'store']);
            Route::get('/{id}', [TicketController::class, 'show']);
            Route::put('/{id}', [TicketController::class, 'update']);
            Route::delete('/{id}', [TicketController::class, 'destroy']);
        });

        // Subscribers Routes
        Route::prefix('subscribers')->group(function () {
            Route::get('/', [SubscriberController::class, 'index']);

            Route::get('/{id}', [SubscriberController::class, 'show']);
            Route::put('/{id}', [SubscriberController::class, 'update']);
            Route::delete('/{id}', [SubscriberController::class, 'destroy']);
        });

        // Pickups Routes
        Route::prefix('pickups')->group(function () {
            Route::get('/', [PickupController::class, 'index']);
            Route::post('/', [PickupController::class, 'store']);
            Route::get('/{id}', [PickupController::class, 'show']);
            Route::put('/{id}', [PickupController::class, 'update']);
            Route::delete('/{id}', [PickupController::class, 'destroy']);
        });

        // Staff Salaries Routes
        Route::prefix('staff-salaries')->group(function () {
            Route::get('/', [StaffSalaryController::class, 'index']);
            Route::post('/', [StaffSalaryController::class, 'store']);
            Route::get('/{id}', [StaffSalaryController::class, 'show']);
            Route::put('/{id}', [StaffSalaryController::class, 'update']);
            Route::delete('/{id}', [StaffSalaryController::class, 'destroy']);
        });

        // Plan routes
        Route::prefix('plans')->group(function () {

            Route::post('/', [PlanController::class, 'store']);
            Route::get('/{id}', [PlanController::class, 'show']);
            Route::put('/{id}', [PlanController::class, 'update']);
            Route::delete('/{id}', [PlanController::class, 'destroy']);
        });

        // Payments
        Route::prefix('payments')->group(function () {
            Route::get('/{user_id}/payments', [PaymentController::class, 'userPayments']);
            Route::post('/', [PaymentController::class, 'store']);
            Route::get('/', [PaymentController::class, 'index']);
        });

        // Drivers
        Route::prefix('drivers')->group(function () {
            Route::get('/', [UserController::class, 'drivers']);
        });
    });
});

