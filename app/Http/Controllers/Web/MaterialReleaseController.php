<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialReleaseRequest as Request;
use App\Models\MaterialRelease;

class MaterialReleaseController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:release-update', ['only' => ['edit']]);
        $this->middleware('permission:release-create', ['only' => ['create']]);
        $this->middleware('permission:release-destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.material-release.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.material-release.create');
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
        return redirect()->intended('release')->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialRelease $release
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialRelease $release)
    {
        return view('pages.material-release.edit', compact('release'));
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
        return redirect()->intended('release')->with('toast_success', 'Created Successfully!');
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
