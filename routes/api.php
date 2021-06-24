<?php

use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductTypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Modules\Manufacture\Api\MaterialReleaseController;
use App\Http\Controllers\Modules\Manufacture\Api\ProductResultController;
use App\Http\Controllers\Modules\Manufacture\Api\JobCostController;
use App\Http\Controllers\Modules\Master\Api\WarehouseController;
use App\Http\Controllers\Modules\Master\Api\RackController;
use App\Http\Controllers\Modules\Master\Api\RelationController;
use App\Http\Controllers\Modules\Warehouse\Api\AdjustmentController;
use App\Http\Controllers\Modules\Warehouse\Api\DeliveryOrderController;
use App\Http\Controllers\Modules\Warehouse\Api\ReceiveItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/manufacture')->group(function () {
    Route::get('/release', [MaterialReleaseController::class, 'index'])->name('api.release');
    Route::get('/result', [ProductResultController::class, 'index'])->name('api.result');
    Route::get('/jobcost', [JobCostController::class, 'index'])->name('api.jobcost');
});

Route::prefix('/warehouse')->group(function () {
    Route::get('/adjustment', [AdjustmentController::class, 'index'])->name('api.adjustment');
    Route::get('/receive', [ReceiveItemController::class, 'index'])->name('api.receive');
    Route::get('/delivery', [DeliveryOrderController::class, 'index'])->name('api.delivery');

    Route::post('/stocktaking/export', [StocktakingController::class, 'exportToExcel'])->name('api.stocktaking.export');
    Route::post('/stocktaking/import', [StocktakingController::class, 'importFromExcel'])->name('api.stocktaking.import');
});

Route::get('/products', [ProductController::class, 'index'])->name('api.product');
Route::get('/users', [UserController::class, 'index'])->name('api.user');
Route::get('/relation', [RelationController::class, 'index'])->name('api.relation');

Route::get('/warehouses', [WarehouseController::class, 'index'])->name('api.warehouse');
Route::get('/warehouse/{warehouse}', [WarehouseController::class, 'getWarehouse'])->name('api.warehouse.show');

Route::get('/racks', [RackController::class, 'index'])->name('api.rack');
Route::get('/rack/{rack}', [RackController::class, 'getBy'])->name('api.rack.show');

Route::get('/product-types/getSelect2', [ProductTypeController::class, 'getSelect2'])->name('api.product-type.select');

Route::get('product/{product}/history', [HistoryController::class, 'index'])->name('api.history');
