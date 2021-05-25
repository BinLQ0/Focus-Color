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
        return ProductResource::collection(
            Product::withHistory()->get()
        );
    }

    /**
     * 
     */
    public function getRacks(Product $product)
    {
        return RackResource::collection($product->uniqueOf('racks')->flatten());
    }
}
