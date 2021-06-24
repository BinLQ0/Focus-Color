<?php

namespace App\Http\Controllers\Modules\Manufacture\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductResult;
use Illuminate\Http\Request;

class ProductResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.modules.manufacture.product-result.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.modules.manufacture.product-result.createOrUpdate');
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
        return redirect()->intended(route('result.index'))->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductResult  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductResult $result)
    {
        $result = $result->load('release');
        $result->materialUsed = $result->release->products->sum('pivot.quantity');
        
        return view('pages.modules.manufacture.product-result.createOrUpdate', [
            'result' => $result,
            'release' => $result->release
        ]);
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
        return redirect()->intended(route('result.index'))->with('toast_success', 'Updated Successfully!');
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