<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function (){
    return redirect('/register');
});


Route::get('/login', [EmployeeController::class, 'login'])->middleware('alreadyLogin');
Route::get('/register', [EmployeeController::class, 'register'])->middleware('alreadyLogin');

Route::post('/register/user', [EmployeeController::class, 'registerUser'])->name('registerUser');
Route::post('/login/user', [EmployeeController::class, 'loginUser'])->name('loginUser');

Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->middleware('isLoginId');
Route::get('/logout', [EmployeeController::class, 'logout'])->name('logout');


Route::post('/post', [PostController::class, 'store'])->name('postCreate');
