<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StocktakingController extends Controller
{
    public function cutOff()
    {
        return view('pages.stocktaking.export');
    }
}
