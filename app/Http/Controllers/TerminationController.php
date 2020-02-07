<?php

namespace App\Http\Controllers;

use App\models\Termination;
use Illuminate\Http\Request;

class TerminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Termination::paginate(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function show(Termination $termination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function edit(Termination $termination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Termination $termination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Termination  $termination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Termination $termination)
    {
        //
    }
}
