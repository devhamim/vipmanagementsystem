<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DailyCostController;
use App\Http\Controllers\DataEntryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeHomeView;
use App\Http\Controllers\MatchmakingController;
use App\Http\Controllers\PaymentDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes();

// Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/post', [LoginController::class, 'login'])->name('login.post');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin user list route
Route::group(['prefix'=>'admin'],function(){
    Route::resource('user', UsersController::class)->middleware('checkRole:1');
    Route::resource('setting', SettingController::class)->middleware('checkRole:1');
    Route::resource('dailycost', DailyCostController::class)->middleware('checkRole:1,2');
    Route::resource('employe', EmployeeController::class)->middleware('checkRole:1,2');
    Route::resource('attendance', AttendanceController::class)->middleware('checkRole:1,2');
});
// Home route

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function(){
    Route::resource('profile', ProfileController::class);
    Route::resource('dataentry', DataEntryController::class);
    Route::resource('paymentdata', PaymentDataController::class);
    Route::resource('matchmaking', MatchmakingController::class);

});

Route::get('/dailycost/search', [DailyCostController::class, 'search'])->name('dailycost.search');
Route::get('/dataentry/search', [DataEntryController::class, 'dataentrysearch'])->name('dataentry.search');
Route::get('/paymentdata/search', [PaymentDataController::class, 'paymentdata_search'])->name('paymentdata.search');

// attendance
Route::post('/attendance/save', [AttendanceController::class, 'saveAttendance'])->name('attendance.save');
Route::post('/attendance/off-day', [AttendanceController::class, 'markOffDay'])->name('attendance.markOffDay');

// employee
Route::post('/employee/generate', [EmployeeController::class, 'generateEmployeeData'])->name('employee.generate');

// employdashboard
Route::get('/employe/home/view/{id}', [EmployeHomeView::class, 'employe_home_view'])->name('employe.home.view');
Route::get('/return/home', [EmployeHomeView::class, 'return_home'])->name('return.home');
