<?php

namespace App\Http\Controllers\Modules\Manufacture\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductResult;
use Carbon\Carbon;

class ProductResultController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $result = ProductResult::query();

        // Check range of date default for 3 month ago
        $result = $result->when(request()->has('startDate') && request()->has('endDate'), function ($q) {
            $start  = Carbon::createFromFormat('d/m/Y', request('startDate'));
            $end    = Carbon::createFromFormat('d/m/Y', request('endDate'));

            $q->whereBetween('date', [
               Carbon::parse($start), Carbon::parse($end)
            ]);
        });

        return $result->with('release')->withCount('products')->orderBy('date')->get();
    }
}
