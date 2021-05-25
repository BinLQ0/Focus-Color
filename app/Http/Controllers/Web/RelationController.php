<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.relations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.relations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Relation::create($request->all());
        
        return redirect()->route('relations.index')
            ->with('toast_success', 'Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Relation $relation
     * @return \Illuminate\Http\Response
     */
    public function show(Relation $relation)
    {
        $relation = $relation->load(['receives.products', 'delivery.products']);
        return view('pages.relations.view', compact('relation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Relation $relation
     * @return \Illuminate\Http\Response
     */
    public function edit(Relation $relation)
    {
        return view('pages.relations.edit', compact('relation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Relation $relation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relation $relation)
    {
        $relation->update($request->all());
        
        return redirect()->route('relations.index')
            ->with('toast_success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Relation $relation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relation $relation)
    {
        $relation->delete();
    }
}
