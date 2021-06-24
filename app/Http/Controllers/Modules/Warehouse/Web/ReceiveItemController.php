<?php

namespace App\Http\Controllers\Modules\Warehouse\Web;

use App\Http\Controllers\Controller;
use App\Models\ReceiveItem;
use Illuminate\Http\Request;

class ReceiveItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.modules.warehouse.receive-item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.modules.warehouse.receive-item.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ReceiveItem::create($request->all());
        return redirect()->intended(route('receive.index'))->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiveItem  $receive
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiveItem $receive)
    {
        return view('pages.modules.warehouse.receive-item.createOrUpdate', compact('receive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiveItem $receive)
    {
        $receive->update($request->all());
        return redirect()->intended(route('receive.index'))->with('toast_success', 'Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiveItem $receive)
    {
        $receive->delete();
    }
}
