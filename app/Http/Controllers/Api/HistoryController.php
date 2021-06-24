<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Models\Product;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Get History by Product
     * @param App\Models\Product $product
     * @return JSON
     */
    public function index(Product $product)
    {
        $product = $product->load('history.histories', 'history.rack.warehouse');

        return HistoryResource::collection($product->history->sortBy(function ($history) {
            return Carbon::createFromFormat('d/m/Y', $history->histories->date);
        }));
    }
}
