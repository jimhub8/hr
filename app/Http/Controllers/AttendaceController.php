<?php

namespace App\Http\Controllers;

use App\models\Attendace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Attendace::paginate(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 1;
        $actual = 6371 * acos(
            cos(deg2rad($request->lat1)) * cos(deg2rad($request->lat2))
                * cos(deg2rad($request->lon2) - deg2rad($request->lon1))
                + sin(deg2rad($request->lat1)) * sin(deg2rad($request->lat2))
        );

        if ($actual < 1) {
            $attendace = new Attendace();
            $attendace->user_id = Auth::id();
            $attendace->in_time = now();
            $attendace->status = 'Checked in';
            $attendace->save();
        }

        return $actual;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Attendace  $attendace
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $attendaces = Attendace::with('user')->latest();
        if ((int) $id != 0) {
            $attendaces = $attendaces->where('user_id', $id);
        }
        $attendaces = $attendaces->take(365)->get();
        $attendaces->transform(function ($attendace) {
            $start = date('Y-m-d H:i:s', strtotime($attendace->created_at));
            $start_ = $attendace->created_at;
            $end_ = $attendace->created_at->addHours(8);
            $attendace->start = $start;
            $end = $attendace->created_at;
            $attendace->end =  date('Y-m-d H:i:s', strtotime($end->addHours(9)));
            $attendace->name = ($attendace->user) ? $attendace->user->name : null;
            $attendace->details = 'Checked in on ' . date('D M m', strtotime($start_)) . ' at ' . date('H:i:s', strtotime($start_)) . '<br />' . 'Checked out on ' . date('D M m', strtotime($end_)) . ' at ' . date('H:i:s', strtotime($end_));
            $attendace->color = $this->random_color();
            return $attendace;
        });
        return $attendaces;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Attendace  $attendace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendace $attendace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Attendace  $attendace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendace $attendace)
    {
        //
    }

    public function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    public function random_color()
    {
        return '#' . $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}
