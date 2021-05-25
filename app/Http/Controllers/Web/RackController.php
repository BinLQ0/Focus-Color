<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Rack;
use Illuminate\Http\Request;

class RackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.racks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.racks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Rack::create($request->all());
        return redirect()->intended('racks')->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Rack $rack
     * @return \Illuminate\Http\Response
     */
    public function edit(Rack $rack)
    {
        return view('pages.racks.edit', compact('rack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Rack $rack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rack $rack)
    {
        $rack->update($request->all());
        return redirect()->intended('racks')->with('toast_success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rack $rack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rack $rack)
    {
        $rack->delete();
    }
}
