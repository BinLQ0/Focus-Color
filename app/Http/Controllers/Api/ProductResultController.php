<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductResult;

class ProductResultController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        return ProductResult::with('release')->withCount('products')->orderBy('date')->get();
    }
}
