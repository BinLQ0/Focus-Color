<?php

namespace App\Http\Controllers\Modules\Master\Api;

use App\Http\Controllers\Controller;
use App\Models\Relation;

class RelationController extends Controller
{
    public function index()
    {
        return Relation::orderBy('name')->get();
    }
}
