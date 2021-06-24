<?php

namespace App\Http\Controllers\Modules\Manufacture\Web;

use App\Http\Controllers\Controller;
use App\Models\MaterialRelease;
use Illuminate\Http\Request;

class MaterialReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.modules.manufacture.material-release.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.modules.manufacture.material-release.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MaterialRelease::create($request->all());
        return redirect()->intended(route('release.index'))->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialRelease $release
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialRelease $release)
    {
        return view('pages.modules.manufacture.material-release.createOrUpdate', compact('release'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MaterialRelease $release
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialRelease $release)
    {
        $release->Update($request->all());
        return redirect()->intended(route('release.index'))->with('toast_success', 'Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialRelease $release
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialRelease $release)
    {
        $release->delete();
    }
}
