<?php

namespace App\Http\Controllers\Modules\Warehouse\Api;

use App\Exports\StockTakingExport;
use App\Http\Controllers\Controller;
use App\Imports\AdjustmentStocktaking;
use App\Models\Adjustment;
use Carbon\Carbon;

class StocktakingController extends Controller
{
    /**
     * 
     */
    public function exportToExcel()
    {
        $date = request()->has('date') ? Carbon::createFromFormat('d/m/Y', request('date')) : now();
        return (new StockTakingExport($date))->download('Stocktaking-' . $date->format('Ymd') . '.xlsx');
    }

    /**
     * 
     */
    public function ImportFromExcel()
    {
        $date = request()->has('dateImport') ? Carbon::createFromFormat('d/m/Y', request('dateImport')) : now();

        $adjustment = Adjustment::firstOrCreate([
            'date' => request('dateImport', $date)
        ],[
            'for' => 'ST'.$date->format('Ym'),
            'description' => 'Stocktaking '.$date->format('d-m-Y'),
            'status' => 'Uploading'
        ]);

        (new AdjustmentStocktaking($date, $adjustment))->import(request()->file('file'));
        
        return redirect()->intended('adjustment')->with('toast_success', 'Created Successfully!');
    }
}
