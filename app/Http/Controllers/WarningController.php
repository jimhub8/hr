<?php

namespace App\Http\Controllers;

use App\models\Warning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Warning::paginate(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Warning  $warning
     * @return \Illuminate\Http\Response
     */
    public function show(Warning $warning)
    {
        dd('dwdw');
        $user = Auth::user();
        return $user->warnings;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Warning  $warning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warning $warning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Warning  $warning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warning $warning)
    {
        //
    }
}
