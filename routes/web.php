<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstalaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\NastaveniWebuController;
use App\Models\Page;

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
    return view('pages.index');
});

Route::get('/admin/instalace', [InstalaceController::class, 'index']);
Route::post('/admin/instalace', [InstalaceController::class, 'store']);
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

Route::group(['middleware' => 'admin.auth'], function () {
    // Administrační routy zde
    Route::get('/admin/panel', [PanelController::class, 'index']);
    Route::get('/admin/prispevky', [PostController::class, 'index']);
    Route::get('/admin/stranky', [PageController::class, 'index']);
    Route::get('/admin/prispevek/upravit/{id}', [PostController::class, 'edit']);
    Route::post('/admin/prispevek/upravit/{id}', [PostController::class, 'update']);
    Route::get('/admin/stranka/upravit/{id}', [PageController::class, 'edit']);
    Route::post('/admin/stranka/upravit/{id}', [PageController::class, 'update']);
    Route::get('/admin/prispevek/novy', [PostController::class, 'new']);
    Route::post('/admin/prispevek/novy', [PostController::class, 'create']);
    Route::get('/admin/stranka/nova', [PageController::class, 'new']);
    Route::post('/admin/stranka/nova', [PageController::class, 'create']);
    Route::get('/admin/nastaveni', [SettingsController::class, 'index']);
    Route::get('/admin/nastaveni/web', [NastaveniWebuController::class, 'edit']);
    Route::post('/admin/nastaveni/web', [NastaveniWebuController::class, 'update']);
    Route::get('/admin/nastaveni/vzhled', [NastaveniWebuController::class, 'vzhled']);
    Route::post('/admin/nastaveni/vzhled', [NastaveniWebuController::class, 'ulozitVzhled']);
    Route::get('/admin/nastaveni/navigace', [NavigationController::class, 'edit']);
    Route::post('/admin/nastaveni/navigace', [NavigationController::class, 'update']);
});

Route::get('/{postType}/{post}', [PostController::class, 'show'])->where('postType', 'film|serial|divadlo')->where('post', '.*');

Route::get('/{slug}', [PageController::class, 'showBySlug'])->where('slug', '.*');
