<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Adjustment;
use Illuminate\Http\Request;

class AdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.adjustment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.adjustment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Adjustment::create($request->all());
        return redirect()->intended('adjustment')->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adjustment  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjustment $adjustment)
    {
        return view('pages.adjustment.edit', compact('adjustment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjustment $adjustment)
    {

        $adjustment->update($request->all());
        return redirect()->intended('adjustment')->with('toast_success', 'Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adjustment  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Adjustment::destroy($id);
    }
}
