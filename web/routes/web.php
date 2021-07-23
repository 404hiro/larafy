<?php

use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\AccountController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

// ログインユーザ
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/logs', [LogController::class, 'index'])->name('admin.log');
    Route::get('/admin/accounts', [AccountController::class, 'index'])->name('admin.account');
    Route::get('/admin/accounts/{id}', [AccountController::class, 'show'])->name('admin.account.show');
    Route::get('/admin/accounts/{id}/edit', [AccountController::class, 'edit'])->name('admin.account.edit');
    Route::post('/admin/accounts/{id}/edit', [AccountController::class, 'update'])->name('admin.account.update');
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.role');
});
