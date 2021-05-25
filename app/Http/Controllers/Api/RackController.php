<?php

namespace App\Http\Controllers\Api;

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
        // Transformation into query
        $racks = Rack::query();

        // Get by Warehouse ID
        $racks = $racks->when(request()->has('warehouse'), function ($q) {
            $q->where('warehouse_id', request('warehouse'));
        });

        // Set Parameter to Hide Quantity
        request()->merge([
            'show' => false
        ]);

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
