<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonResponsibleController;
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
Route::controller(PersonResponsibleController::class)->group(function() {
    Route::get('/person-responsible', 'index')->name('person-responsible');
    Route::get('/person-responsible/datatable', 'datatable')->name('person-responsible.datatable');
    Route::post('/person-responsible/store', 'store')->name('person-responsible.store');
    Route::get('/person-responsible/edit/{id}', 'edit')->name('person-responsible.edit');
    Route::post('/person-responsible/update/{id}', 'update')->name('person-responsible.update');
    Route::delete('/person-responsible/delete/{id}', 'delete')->name('person-responsible.delete');
   
});
Route::controller(AuthController::class)->group(function() {
    Route::get('/logout', 'logout')->name('user.logout');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
