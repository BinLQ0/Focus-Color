<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Models\Product;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * 
     */
    public function index(Product $product)
    {
        return HistoryResource::collection($product->load('history.histories')->history->load('rack.warehouse')->sortBy(function ($history, $key) {
            return Carbon::createFromFormat('d/m/Y', $history->histories->date);
        }));
    }
}
