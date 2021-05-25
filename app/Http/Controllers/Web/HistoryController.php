<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * 
     */
    public function index(Product $product)
    {
        return view('pages.history.view', compact('product'));
    }
}
