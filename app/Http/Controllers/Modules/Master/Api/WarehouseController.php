<?php

namespace App\Http\Controllers\Modules\Master\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        return Warehouse::orderBy('name')->get();
    }

    /**
     * Display a listing of the resource
     */
    public function getWarehouse(Warehouse $warehouse)
    {
        return $warehouse;
    }
}
