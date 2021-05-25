<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialReleaseResource;
use App\Models\MaterialRelease;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaterialReleaseController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $release = MaterialRelease::query();

        // Check if request has 'search' text
        $release = $release->when(request()->has('search'), function ($q) {
            $q->where('for', 'like', '%' . request('search') . '%');
        });

        // Check if request has 'status' ('processing', 'closed')
        $release = $release->when(request()->has('status'), function ($q) {
            if (request('status') == 'processing') $q->doesntHave('result');
            else $q->has('result');
        });

        //Check if return with sum
        $release = $release->when(request()->has('hasTotal'), function ($q) {
            $q->with('products');
        }); 

        // Check range of date default for 3 month ago
        $release = $release->whereBetween('date', [
            request('startDate', Carbon::now()->subMonth(2)->firstOfMonth()), 
            request('endDate', Carbon::now()->endOfMonth())]);

        return MaterialReleaseResource::collection($release->orderBy('for')->with('endProduct', 'result')->get());
    }
}
