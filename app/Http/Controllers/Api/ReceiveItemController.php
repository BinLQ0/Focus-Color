<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReceiveItem;

class ReceiveItemController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        return ReceiveItem::with('company')->orderBy('date')->get();
    }
}
