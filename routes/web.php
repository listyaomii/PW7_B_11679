<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CustomerController;
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
Route::get('/', function () {
return view('dashboard');
});
Route::resource('/book', BookController::class);
Route::resource('/bookings', BookingsController::class);
Route::resource('customer', CustomerController::class);
// Route::delete('/bookings/{id}', [BookingsController::class, 'destroy'])->name('bookings.destroy');
