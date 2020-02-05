<?php

namespace App\Http\Controllers;

use App\models\Attendace;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter_data(Request $request, $filter)
    {
        // return $request->all();
        if ($filter == 'filter_attendance') {
            $filter_data = new Attendace();
        }

        if ($request->user) {
            $filter_data = $filter_data->where('user_id', $request->user);
        }

        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            $filter_data = $filter_data->whereBetween('created_at', [$start_date, $end_date]);
        }
        return $filter_data->paginate(500);
    }
}
