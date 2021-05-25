<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOrder;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.delivery-order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.delivery-order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DeliveryOrder::create($request->all());
        return redirect()->route('delivery.index')->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryOrder $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryOrder $delivery)
    {
        return view('pages.delivery-order.edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryOrder $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryOrder $delivery)
    {
            $delivery->Update($request->all());

            return redirect()->route('delivery.index')->with('toast_success', 'Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryOrder $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryOrder $delivery)
    {
        $delivery->delete();
    }
}
