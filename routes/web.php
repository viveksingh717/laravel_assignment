<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/home', [EmployeeController::class, 'index'])->name('home');

Route::get('/add_emp', [EmployeeController::class, 'create'])->name('add_emp');
Route::post('/store', [EmployeeController::class, 'store'])->name('store');
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
Route::get('/delete/{id}', [EmployeeController::class, 'destroy'])->name('delete');

Route::get('/company', [CompanyController::class, 'index'])->name('company');
Route::get('/add_company', [CompanyController::class, 'create'])->name('add_company');
Route::post('/company_store', [CompanyController::class, 'store'])->name('company_store');
Route::get('/company_edit/{id}', [CompanyController::class, 'edit'])->name('company_edit');
Route::post('/company_update/{id}', [CompanyController::class, 'update'])->name('company_update');
Route::get('/company_delete/{id}', [CompanyController::class, 'destroy'])->name('company_delete');

