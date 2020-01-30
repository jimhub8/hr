<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function hr()
    {
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (Auth::user()->can($permission->name)) {
                $permissions[$permission->name] = true;
            } else {
                $permissions[$permission->name] = false;
            }
        }
        $user = Auth::user();
        // $country = Country::find($user->country_id);
        // dd($country);
        // $user->country_name = $country->country_name;
        // $users->transform(function ($user, $key) {
        //     $country = Country::find($user->country_id);
        //     $user->country_name = $country->name;
        // 	return $user;
        // });
        // dd(json_decode(json_encode((Auth::user()), false)));
        $auth_user = Arr::prepend($user->toArray(), $permissions, 'can');
        return view('welcome', compact('auth_user'));
    }
    public function courierHome()
    {
        return redirect('/')->where('name', '[A-Za-z]+');
    }

    /**
     * Load homepage
     *
     * @param  Request $request
     * @return view
     */
    public function index(Request $request)
    {
        // $ip = request()->ip();
        $ip = '41.80.11.117';

        dd(geoip($ip));

        // return redirect('/login');
        // if (Auth::check()) {
        //     return redirect('/courier');
        // }
    }

    public function distance(Request $request)
    {
        // return $request->all();
        // return 1;
        return $actual = 6371 * acos(
            cos(deg2rad($request->lat1)) * cos(deg2rad($request->lat2))
            * cos(deg2rad($request->lon2) - deg2rad($request->lon1))
            + sin(deg2rad($request->lat1)) * sin(deg2rad($request->lat2))
        );
    }
}
