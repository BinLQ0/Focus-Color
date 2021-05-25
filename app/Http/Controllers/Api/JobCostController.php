<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobCost;

class JobCostController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        return JobCost::orderBy('date')->get();
    }
}
