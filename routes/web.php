<?php

use App\Http\Controllers\Web\AdjustmentController;
use App\Http\Controllers\Web\DeliveryOrderController;
use App\Http\Controllers\Web\HistoryController;
use App\Http\Controllers\Web\JobCostController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RelationController;
use App\Http\Controllers\Web\MaterialReleaseController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProductResultController;
use App\Http\Controllers\Web\RackController;
use App\Http\Controllers\Web\ReceiveItemController;
use App\Http\Controllers\Web\StocktakingController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\WarehouseController;
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

Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login', [LoginController::class, 'attempt'])->name('attemptLogin');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware('auth')->group(function () {

    /**
     * HOME Route
     */
    Route::view('/', 'pages.home')->name('home');

    Route::get('/products/{product}/history', [HistoryController::class, 'index']);

    /**
     * Resource Route
     */
    Route::resource('/adjustment', AdjustmentController::class);
    Route::resource('/delivery', DeliveryOrderController::class);
    Route::resource('/jobcost', JobCostController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/racks', RackController::class);
    Route::resource('/receive', ReceiveItemController::class);
    Route::resource('/relations', RelationController::class);
    Route::resource('/result', ProductResultController::class);
    Route::resource('/warehouses', WarehouseController::class);

    Route::group(['middleware' => ['permission:manufacture module']], function () {
        Route::resource('/release', MaterialReleaseController::class);
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('/users', UserController::class);
    });

    /**
     * 
     */
    Route::get('/stocktaking/export', [StocktakingController::class, 'cutOff'])->name('stocktaking.export');
});
