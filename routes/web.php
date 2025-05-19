<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PageController::class, 'HomePage']);


Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/rentals', function () {
    return Inertia::render('Rentals');
});
Route::get('/rentals', [PageController::class, 'SearchRentals']);
Route::post('/rentals', [PageController::class, 'SearchRentals']);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [PageController::class, 'AdminDashBoardPage']);

Route::get('/admin/cars', [CarController::class, "CarsTab"]);

Route::get('/admin/rentals', [PageController::class, "AdminRentalPage"]);

Route::get('/admin/customers', [PageController::class, "AdminCustomers"]);

Route::get('/admin/add-car-page', [PageController::class, "AddCarPage"]);

Route::post('/admin/add-car', [CarController::class, "AddCar"]);

Route::get('/admin/delete-car/{id}', [CarController::class, "DeleteCar"]);

Route::get('/admin/show-car-page/{id}', [PageController::class, "ShowCarPage"]);

Route::get('/admin/edit-car-page/{id}', [PageController::class, "EditCarPage"]);

Route::post('/admin/edit-car/{id}', [CarController::class, "EditCar"]);

Route::get('/admin/add-customer-page', [PageController::class, "AddCustomerPage"]);

Route::post('/admin/add-customer', [CustomerController::class, "AddCustomer"]);

Route::get('/admin/edit-customer-page/{id}', [PageController::class, "EditCustomerPage"]);

Route::post('/admin/edit-customer/{id}', [CustomerController::class, "EditCustomer"]);

Route::get('/admin/show-customer-page/{id}', [PageController::class, "ShowCustomer"]);

Route::get('/admin/delete-customer/{id}', [CustomerController::class, "DeleteCustomer"]);

Route::get('/admin/add-rental-page', [PageController::class, "AddRentalPage"]);

Route::post('/admin/add-rental', [RentalController::class, "AddRental"]);

Route::get('/admin/edit-rental-page/{id}', [PageController::class, "EditRentalPage"]);

Route::post('/admin/edit-rental/{id}', [RentalController::class, "EditRental"]);

Route::get('/admin/delete-rental/{id}', [RentalController::class, "DeleteRental"]);

});

Route::middleware(['auth', 'customer'])->group(function () {
Route::get('/customer/dashboard', [PageController::class, 'CustomerDashboardPage']);

Route::get('/customer/rentals', [PageController::class, 'CustomerRentalPage']);

Route::get('/customer/rental-history', [PageController::class, 'CustomerRentalHistoryPage']);


Route::get('/customer/car/{id}', [PageController::class, 'CarView']);

Route::post('/customer/car-rent/{id}', [CustomerController::class, 'CustomerCarRent']);

Route::get('/customer/rentals', [PageController::class, 'CustomerRentals']);

Route::get('/customer/rental-history', [PageController::class, 'CustomerRentalsHistory']);

Route::post('/customer/cancel-rental/{id}', [CustomerController::class, 'CustomerCancelRent']);
});




// Customer related routes





require __DIR__.'/auth.php';
