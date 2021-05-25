<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Relation;

class RelationController extends Controller
{
    public function index()
    {
        return Relation::all();
    }
}
