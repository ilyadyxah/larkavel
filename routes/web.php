<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NewsController;
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


Route::group([
    'prefix' => 'news',
    'as' => 'news::'
],function() {

    Route::get('/', [NewsController::class, 'index'])
        ->name('index');

    Route::get('/categories', [NewsController::class, 'categories'])
        ->name('categories');

    Route::get('/categories/{id}', [NewsController::class, 'category'])
        ->name('category');

    Route::get('/card/{id}', [NewsController::class, 'card'])
        ->name('card');
});

Route::group([
    'prefix' => 'admin/',
],function() {
    Route::group([
        'prefix' => 'news/',
        'as' => 'admin::news::'
    ],function() {

    Route::get('index', [AdminNewsController::class, 'index'])
        ->name('index');

    Route::get('create', [AdminNewsController::class, 'create'])
        ->name('create');

    Route::post('save', [AdminNewsController::class, 'save'])
        ->name('save');

    Route::get('update/{news}', [AdminNewsController::class, 'update'])
        ->name('update');

    Route::get('delete/{id}', [AdminNewsController::class, 'delete'])
        ->name('delete');

    Route::match(['get', 'post'], '/find/', [AdminNewsController::class, 'find'])
        ->name('find');
    });

    Route::group([
        'prefix' => 'category/',
        'as' => 'admin::category::'
    ],function() {
        Route::get('create', [CategoryController::class, 'create'])
            ->name('create');

        Route::get('update/{id}', [CategoryController::class, 'update'])
            ->name('update');

        Route::get('delete/{id}', [CategoryController::class, 'delete'])
            ->name('delete');

        Route::post('save', [CategoryController::class, 'save'])
            ->name('save');
    });

});

Route::get('/locale/{lang}', [LocaleController::class, 'index'])
    ->name('locale')
->middleware('locale');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get( 'admin/profile/update', [ProfileController::class, 'update'])
    ->name('admin::profile::update');

Route::post('admin/profile/save', [ProfileController::class, 'save'])
    ->name('admin::profile::save')
    ->middleware('profile');

