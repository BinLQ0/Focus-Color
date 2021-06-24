<?php

namespace App\Http\Controllers\Modules\Warehouse\Web;

use App\Http\Controllers\Controller;

class StocktakingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.modules.warehouse.stocktaking.export');
    }
}
