<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::prefix('/admin')->group(function(){
// Admin Login
Route::match(['GET','POST'],'login',[AdminController::class,'login']);
// ADMIN DASHBOARD
Route::group(['middleware'=> ['admin']],function(){
    //Update Admin Password
    Route::match(['GET','POST'],'update-admin-password',[AdminController::class,'updateAdminPassword']);
    //Admin Dashboard
    Route::match(['GET','POST'],'dashboard',[AdminController::class,'dashboard']);
    //Admin Logout
    Route::get('/logout',[AdminController::class,'logout']);
});

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';