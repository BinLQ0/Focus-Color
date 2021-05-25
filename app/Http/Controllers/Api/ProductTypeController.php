<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SelectResource;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function getSelect2()
    {
        return SelectResource::collection(ProductType::select('id', 'name')->get());
    }
}
