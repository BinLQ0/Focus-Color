<?php

namespace App\Http\Controllers\Modules\Warehouse\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOrder;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $delivery = DeliveryOrder::query();

        // Check range of date default for 3 month ago
        $delivery = $delivery->when(request()->has('startDate') && request()->has('endDate'), function ($q) {
            $start  = Carbon::createFromFormat('d/m/Y', request('startDate'));
            $end    = Carbon::createFromFormat('d/m/Y', request('endDate'));

            $q->whereBetween('date', [
                Carbon::parse($start), Carbon::parse($end)
            ]);
        });

        return $delivery->with('company')->orderBy('date')->get();
    }
}
