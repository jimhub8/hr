<?php

namespace App\Http\Controllers;

use App\models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shift::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shift = new Shift();
        $shift->user_id = $request->user_id;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->late_count_time = $request->late_count_time;
        $shift->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Shift::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shift = Shift::find($id);
        $shift->user_id = $request->user_id;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->late_count_time = $request->late_count_time;
        $shift->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shift::find($id)->delete();
    }
}
