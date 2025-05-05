<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Login;
use App\Http\Controllers\ManageProfileController;

// Route::get('/vendor-dashboard', function () {
//     return view('vendor/dashboard');
// });
// Route::get('/', function () {
//     return view('auth/login');
// });
// Route::post('/login', [Login::class, 'login'])->name('login');
// Route::get('/', [Login::class, 'showLoginForm']);

Route::get('/login', [Login::class, 'showLoginForm'])->name('login');
Route::post('/login', [Login::class, 'login'])->name('loginss');

// Route::post('/login', [Login::class, 'login'])->name('loginss');
Route::get('/', function() {
    return redirect()->route('login');
});

// Route::get('/register', function () {
//     return view('auth/register');
// });

Route::get('register', [Login::class, 'showForm'])->name('register.form');
Route::post('register-submit', [Login::class, 'submitForm'])->name('register.submit');
Route::get('register-success', [Login::class, 'RegisterSuccess'])->name('register.success');

Route::post('/logout', [Login::class, 'logout'])->name('logout');


Route::get('/vendor-dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/client-dashboard', [DashboardController::class, 'clientDashboard'])->name('client.dashboard')->middleware('auth');

// Route::get('/manage-profile', [DashboardController::class, 'index']);

Route::get('/manage-profile', [ManageProfileController::class, 'GetProfile'])->name('manage-profile')->middleware('auth');
Route::get('/manage-profilea', [ManageProfileController::class, 'GetManageProfile'])->name('profile.data')->middleware('auth');
Route::post('/manage-profiless', [ManageProfileController::class, 'SubmitProfile'])->name('profile.datass')->middleware('auth');

Route::get('/manage-compliance', [ManageProfileController::class, 'GetCompliance'])->name('manage-compliance')->middleware('auth');
Route::get('/document-Attached', [ManageProfileController::class, 'GetDocument'])->name('document-Attached')->middleware('auth');

Route::get('/pan-details/{id}', [ManageProfileController::class, 'GetPanDetails'])->name('/pan-details')->middleware('auth');
Route::get('/Bank-details/{id}', [ManageProfileController::class, 'GetBankDetails'])->name('/bank-details')->middleware('auth');
Route::get('/msme-details/{id}', [ManageProfileController::class, 'GetMSMEDetails'])->name('/msme-details')->middleware('auth');


Route::post('/remove-pan-details/{id}', [ManageProfileController::class, 'Removepan'])->name('/remove-details')->middleware('auth');
Route::post('/remove-bank-details/{id}', [ManageProfileController::class, 'RemoveBankDetails'])->name('/remove-details')->middleware('auth');
Route::post('/remove-msme-details/{id}', [ManageProfileController::class, 'RemoveMsmeDetails'])->name('/remove-msme-details')->middleware('auth');


Route::post('/save-pan-details/{id}', [ManageProfileController::class, 'Savepan'])->name('/save-details')->middleware('auth');
Route::post('/save-bank-details/{id}', [ManageProfileController::class, 'updateBank'])->name('/save-details')->middleware('auth');
Route::post('/save-msme-details/{id}', [ManageProfileController::class, 'updateMsme'])->name('/save-details')->middleware('auth');

// Route::get('/my-clients', function () {
//     return view('vendor/my-clients');
// });
Route::get('/my-clients', [ManageProfileController::class, 'GetMyClients'])->name('my-clients')->middleware('auth');
// Route::get('/contact-info', function () {
//     return view('vendor/contact-info');
// });

Route::get('/contact-info', [Login::class, 'ContactInfo'])->name('contact-info')->middleware('auth');
Route::get('/change-password', [Login::class, 'ChangePassword'])->name('change-password')->middleware('auth');
Route::post('/update-password', [Login::class, 'UpdatePassword'])->name('update-password')->middleware('auth');