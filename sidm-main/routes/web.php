<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\HypothesisController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
use App\Models\History;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => ['auth', 'biodata']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('level:admin,poli,sik');

    Route::resource('/evidence', EvidenceController::class);

    Route::resource('/hypothesis', HypothesisController::class);

    Route::get('/role', [RoleController::class, 'index'])->name('role.index')->middleware('level:admin');
    Route::post('/store-role', [RoleController::class, 'store'])->name('role.store')->middleware('level:admin');

    Route::get('/role/forward', [RoleController::class, 'forward'])->name('role.forward.index')->middleware('level:admin');
    Route::post('/role/forward/store', [RoleController::class, 'forwardStore'])->name('role.forward.store')->middleware('level:admin');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index')->middleware('level:admin');
    Route::post('/setting', [SettingController::class, 'save'])->name('setting.save')->middleware('level:admin');
    Route::post('/value', [SettingController::class, 'saveValue'])->name('value.save')->middleware('level:admin');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile/{user}', [DashboardController::class, 'profile_update'])->name('profile.update');

    Route::get('/history/{history}/print', [HistoryController::class, 'print'])->name('history.print');
    Route::resource('history', HistoryController::class);
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::group([], function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
    });

    Route::get('/report/hypothesis', [DashboardController::class, 'reportHypothesis'])->name('report.hypothesis.index');
    Route::post('/report/hypothesis', [DashboardController::class, 'reportHypothesis'])->name('report.hypothesis.index');
    Route::get('/report/hypothesis/print', [DashboardController::class, 'reportHypothesisPrint'])->name('report.hypothesis.print');

    Route::get('/report/user', [DashboardController::class, 'reportUser'])->name('report.user.index');
    Route::post('/report/user', [DashboardController::class, 'reportUser'])->name('report.user.index');
    Route::get('/report/user/print', [DashboardController::class, 'reportUserPrint'])->name('report.user.print');
    Route::resource('/patient', PatientController::class)->middleware('level:admin,poli');

    Route::get('/expert-system', [DashboardController::class, 'expert_system'])->name('expert-system');
    Route::post('/expert-system', [DashboardController::class, 'expert_system_post'])->name('expert-system-post');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/biodata', [DashboardController::class, 'biodata'])->name('biodata.index');
    Route::post('/biodata', [DashboardController::class, 'biodataStore'])->name('biodata.store');
});

Route::group(['middleware' => ['level:admin', 'auth']], function () {
    Route::resource('/user', UserController::class);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [DashboardController::class, 'login'])->name('login');
    Route::post('/login-process', [DashboardController::class, 'login_process'])->name('login_process');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [DashboardController::class, 'register'])->name('register');
    Route::post('/register-process', [DashboardController::class, 'register_process'])->name('register_process');
});
