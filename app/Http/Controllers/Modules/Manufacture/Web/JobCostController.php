<?php

namespace App\Http\Controllers\Modules\Manufacture\Web;

use App\Http\Controllers\Controller;
use App\Models\JobCost;
use Illuminate\Http\Request;

class JobCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.modules.manufacture.job-cost.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.modules.manufacture.job-cost.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        JobCost::create($request->all());
        return redirect()->intended(route('jobcost.index'))->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobCost  $JobCost
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCost $jobcost)
    {
        return view('pages.modules.manufacture.job-cost.createOrUpdate', compact('jobcost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCost  $JobCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCost $jobcost)
    {
        $jobcost->Update($request->all());
        return redirect()->route('jobcost.index')->with('toast_success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobCost  $JobCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCost $jobcost)
    {
        $jobcost->delete();
    }
}
