<?php

namespace App\Http\Controllers\Modules\Master\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RackResource;
use App\Models\Rack;

class RackController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $racks = Rack::query();

        // Get by Warehouse ID
        $racks = $racks->when(request()->has('warehouse'), function ($q) {
            return $q->where('warehouse_id', request('warehouse'));
        });

        // Get by Product ID
        $racks = $racks->when(request()->has('product'), function ($q) {
            return $q->with(['history' => function ($q) {
                return $q->where('product_id', request('product'));
            }]);
        });
        
        return RackResource::collection($racks->with('warehouse')->orderBy('code')->get());
    }

    /**
     * Get Rack by ID
     */
    public function getBy(Rack $rack)
    {
        return $rack->load('warehouse');
    }
}
