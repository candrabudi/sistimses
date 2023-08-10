<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'login')->name('user.login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
});
Auth::routes();
Route::controller(DashboardController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/datatable', 'datatable')->name('datatable');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'delete')->name('delete');
    Route::get('/district', 'getDistrict')->name('getDistrict');
    Route::get('/exportToExcel', 'exportToExcel')->name('exportToExcel');
    Route::get('/sub-district', 'getSubDistrict')->name('getSubDistrict');
   
});
Route::controller(AuthController::class)->group(function() {
    Route::get('/logout', 'logout')->name('user.logout');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
