<?php

namespace App\Http\Controllers\Api;

use App\Exports\StockTakingExport;
use App\Http\Controllers\Controller;
use App\Models\Adjustment;

class AdjustmentController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        return Adjustment::orderBy('date')->get();
    }
}
