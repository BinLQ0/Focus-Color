<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RackResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $products = Product::query();

        // Check if request has 'search' text
        $products = $products->when(request()->has('search'), function ($q) {
            $q->where('for', 'like', '%' . request('search') . '%');
        });

        $products = $products->with('history.histories')->orderBy('name');
        
        return ProductResource::collection($products->get());
    }
}
