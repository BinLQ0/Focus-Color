<?php

use App\Http\Controllers\Modules\Manufacture\Web\JobCostController;
use App\Http\Controllers\Modules\Manufacture\Web\MaterialReleaseController;
use App\Http\Controllers\Modules\Manufacture\Web\ProductResultController;
use App\Http\Controllers\Modules\Master\Web\RackController;
use App\Http\Controllers\Modules\Master\Web\RelationController;
use App\Http\Controllers\Modules\Master\Web\WarehouseController;
use App\Http\Controllers\Modules\Warehouse\Web\AdjustmentController;
use App\Http\Controllers\Modules\Warehouse\Web\DeliveryOrderController;
use App\Http\Controllers\Modules\Warehouse\Web\ReceiveItemController;
use App\Http\Controllers\Modules\Warehouse\Web\StocktakingController;
use App\Http\Controllers\Web\HistoryController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\UserController;
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

Route::get('/login', [LoginController::class, 'view'])
    ->name('login');

Route::post('/login', [LoginController::class, 'attempt'])
    ->name('attempt');

Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::middleware('auth')->group(function () {

    /**
     * HOME Route
     */
    Route::view('/', 'pages.home')->name('home');

    Route::get('/products/{product}/history', [HistoryController::class, 'index']);

    Route::prefix('/module/manufacture')->middleware('permission:manufacture module')->group(function () {
        Route::resource('/release', MaterialReleaseController::class);
        Route::resource('/result', ProductResultController::class);
        Route::resource('/jobcost', JobCostController::class);
    });

    Route::prefix('/module/warehouse')->middleware('permission:warehouse module')->group(function () {
        Route::resource('/adjustment', AdjustmentController::class);
        Route::resource('/receive', ReceiveItemController::class);
        Route::resource('/delivery', DeliveryOrderController::class);

        Route::get('stocktaking/create', [StocktakingController::class, 'create'])->name('stocktaking.create');
    });

    Route::resource('/products', ProductController::class);

    Route::resource('/relations', RelationController::class);
    Route::resource('/warehouses', WarehouseController::class);
    Route::resource('/racks', RackController::class);

    Route::group(['middleware' => ['role:Administrator']], function () {
        Route::resource('/users', UserController::class);
    });
});
