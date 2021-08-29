<?php

use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//誰でも見れる
Route::get('', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('/@{user}', [AccountController::class, 'index'])->name('account');



// ログインユーザ
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    //ログインページ
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/messages', [MessageController::class, 'message'])->name('messages');

    //設定
    Route::get('/setting', [SettingController::class, 'profile'])->name('setting.account');
    Route::get('/setting/profile', [SettingController::class, 'profile'])->name('setting.profile');
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/logs', [LogController::class, 'index'])->name('admin.log');
    Route::get('/admin/accounts', [AdminAccountController::class, 'index'])->name('admin.account');
    Route::get('/admin/accounts/{id}', [AdminAccountController::class, 'show'])->name('admin.account.show');
    Route::get('/admin/accounts/{id}/edit', [AdminAccountController::class, 'edit'])->name('admin.account.edit');
    Route::post('/admin/accounts/{id}/edit', [AdminAccountController::class, 'update'])->name('admin.account.update');
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.role');
});
