<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
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
Route::prefix('/admin')->group(function () {
    // Admin Login
    Route::match(['GET', 'POST'], 'login', [AdminController::class, 'login']);
    // ADMIN DASHBOARD
    Route::group(['middleware' => ['admin']], function () {
        //Check Admin Password
        Route::post('check-admin-password', [AdminController::class, 'checkAdminPassword'])->name('check-admin-password');
        //Update Admin Details
        Route::match(['GET', 'POST'], 'update-admin-details', [AdminController::class, 'updateAdminDetails']);
        //Update Vendor Details
        Route::match(['GET', 'POST'], 'update-vendor-details/{slug}', [AdminController::class, 'updateVendorDetails']);
        //Update Admin Password
        Route::match(['GET', 'POST'], 'update-admin-password', [AdminController::class, 'updateAdminPassword']);
        //Admin Dashboard
        Route::match(['GET', 'POST'], 'dashboard', [AdminController::class, 'dashboard']);
        // Update Admins /Subadmins / Vendors
        Route::get('admins/{type?}', [AdminController::class, 'admins']);
        // View Vendor Details
        Route::get('view-vendor-details/{id}', [AdminController::class, 'viewVendorDetails']);
        // Update Admin Status
        Route::post('update-admin-status', [AdminController::class, 'updateAdminStatus']);

        //Admin Logout
        Route::get('/logout', [AdminController::class, 'logout']);

        //Sections
        Route::get('/sections', [SectionController::class, 'sections']);
        // Update Section Status
        Route::post('update-section-status', [SectionController::class, 'updateSectionStatus']);
        // Delete Section
        Route::get('delete-section/{id}', [SectionController::class, 'deleteSection']);
        // Add section
        Route::match(['GET', 'POST'], 'add-edit-section/{sectionId?}', [SectionController::class, 'addEditSection']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
