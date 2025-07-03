<?php

use App\Http\Controllers\AssignedLoadController;
use App\Http\Controllers\AssignedVehicleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BolController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DropController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteJobController;
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
            $data = $request->user();
            $data['profile'] = $data->profile;
            $data['company'] = $data->load('company');
            $data['profile']['avatar'] = 'https://ui-avatars.com/api/?name='.$data->name;
            $data['payment'] = $data->payment;
            return response()->json(['data' => $data, 'message' => 'Auth User fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        });

        Route::prefix('auth')->group(function () {
            Route::post('/request-otp', [AuthController::class, 'requestOtp']);
            Route::post('/change-password', [AuthController::class, 'changePassword']);
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
            Route::get('/{user_id}/invoices', [InvoiceController::class, 'userInvoices']);
            Route::get('/companies/{id}', [UserController::class, 'showCompanies']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);

            Route::get('/profiles', [ProfileController::class, 'index']);
            Route::get('/profiles/{id}', [ProfileController::class, 'show']);
            Route::put('/profiles/{id}', [ProfileController::class, 'update']);
            Route::get('/profile', [ProfileController::class, 'userProfile']);
        });

        Route::prefix('companies')->group(function () {
            Route::get('/', [CompanyController::class, 'index']);
            Route::post('/', [CompanyController::class, 'store']);
            Route::get('/{id}', [CompanyController::class, 'show']);
            Route::put('/{id}', [CompanyController::class, 'update']);
            Route::delete('/{id}', [CompanyController::class, 'destroy']);
            Route::get('/routes/{id}', [RouteController::class, 'companyRoutes']);
            Route::get('/delivered-routes/{id}', [RouteController::class, 'companyDeliveredRoutes']);
            Route::get('/pickedup-routes/{id}', [RouteController::class, 'companyPickedUpRoutes']);
            Route::get('/pending-routes/{id}', [RouteController::class, 'companyPendingRoutes']);
            Route::get('/accepted-routes/{id}', [RouteController::class, 'companyAcceptedRoutes']);
            Route::get('/rejected-routes/{id}', [RouteController::class, 'companyRejectedRoutes']);
        });

        Route::post('/add-company-staff', [UserController::class, 'store']);

        // Loads Routes
        Route::prefix('routes')->group(function () {
            Route::get('/', [RouteController::class, 'index']);
            Route::post('/', [RouteController::class, 'store']);
            Route::get('/{id}', [RouteController::class, 'show']);
            Route::put('/{route}', [RouteController::class, 'update']);
            Route::delete('/{id}', [RouteController::class, 'destroy']);
            Route::get('/drop-route/{id}', [RouteController::class, 'dropRoute']);
            Route::get('/pickup-route/{id}', [RouteController::class, 'pickupRoute']);
            Route::get('/delivered-routes', [RouteController::class, 'deliveredRoutes']);
            Route::get('/pickedup-routes', [RouteController::class, 'pickedupRoutes']);
            Route::get('/pending-routes', [RouteController::class, 'pendingRoutes']);
            Route::get('/rejected-routes', [RouteController::class, 'rejectedRoutes']);
            Route::get('/accepted-routes', [RouteController::class, 'acceptedRoutes']);
            Route::get('/invoice/{route}', [RouteController::class, 'invoice']);
        });

        Route::get('/deliveries', [RouteJobController::class, 'deliveries']);
        Route::get('/pickups', [RouteJobController::class, 'pickups']);

        Route::prefix('route-jobs')->group(function () {
            Route::get('/{id}', [RouteController::class, 'show']);
            Route::delete('/{id}', [RouteController::class, 'destroy']);
        });

        // Loads Assigned Routes
        Route::prefix('loads-assigned')->group(function () {
            Route::get('/drivers/{driver_id}', [RouteController::class, 'driverRoutes']);
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

        // Staff Salaries Routes
        Route::prefix('payrolls')->group(function () {
            Route::get('/', [PayrollController::class, 'index']);
            Route::post('/', [PayrollController::class, 'store']);
            Route::get('/{payroll_number}', [PayrollController::class, 'fetchPayroll']);
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
            Route::get('/routes/{driver_id}', [RouteController::class, 'driverRoutes']);
            Route::post('/upload-bol', [RouteController::class, 'UploadBol']);
            Route::get('/delivered-routes/{driver_id}', [RouteController::class, 'driverDeliveredRoutes']);
            Route::get('/pending-routes/{driver_id}', [RouteController::class, 'driverPendingRoutes']);
            Route::get('/pickup-routes/{driver_id}', [RouteController::class, 'driverPickedRoutes']);
            Route::get('/assign-route', [RouteController::class, 'assignRoute']);
            Route::get('/reject-route', [RouteController::class, 'rejectRoute']);
            Route::get('/accept-route', [RouteController::class, 'acceptRoute']);

            Route::get('/rejected-routes/{driver_id}', [RouteController::class, 'driverRejectedRoutes']);
            Route::get('/accepted-routes/{driver_id}', [RouteController::class, 'driverAcceptedRoutes']);
        });

        // Dispatchers
        Route::prefix('dispatchers')->group(function () {
            Route::get('/', [UserController::class, 'dispatchers']);
        });

        // BOL
        Route::prefix('bol')->group(function () {
            Route::get('/', [BolController::class, 'index']);
            Route::get('/{bol}', [BolController::class, 'show']);
            Route::put('/{bol}', [BolController::class, 'update']);
            Route::delete('/{bol}', [BolController::class, 'destroy']);
            Route::get('/driver-bols/{driver_id}', [BolController::class, 'driverBols']);
        });

        // Invoices
        Route::prefix('invoices')->group(function () {
            Route::controller(InvoiceController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::get('/{invoice}', 'show');
                Route::post('/filter-invoices', 'filterInvoiceByDate');
            });
        });
    });
});

