<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductResult;
use App\Http\Requests\ProductResultRequest as Request;

class ProductResultController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:result-update', ['only' => ['edit']]);
        $this->middleware('permission:result-create', ['only' => ['create']]);
        $this->middleware('permission:result-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.product-result.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product-result.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProductResult::create($request->all());
        return redirect()->intended('result')->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductResult  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductResult $result)
    {
        return view('pages.product-result.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductResult  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductResult $result)
    {
        $result->update($request->all());
        return redirect()->intended('result')->with('toast_success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductResult $result)
    {
        $result->delete();
    }
}
