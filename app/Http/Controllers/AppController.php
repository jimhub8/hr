<?php

namespace App\Http\Controllers;

use App\models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return App::take(1)->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $app_count = App::count();
        if ($app_count > 0) {
            $app = App::latest()->first();
            $app->app_name = $request->app_name;
            $app->logo = $request->logo;
            $app->phone = $request->phone;
            $app->email = $request->email;
            $app->website = $request->website;
            $app->address = $request->address;
        } else {
            $app = new App;
            $app->app_name = $request->app_name;
            $app->logo = $request->logo;
            $app->phone = $request->phone;
            $app->email = $request->email;
            $app->website = $request->website;
            $app->address = $request->address;
        }
        $app->save();
        return $app;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return App::find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $app = App::find($id);
        $app->app_name = $request->app_name;
        $app->logo = $request->logo;
        $app->phone = $request->phone;
        $app->email = $request->email;
        $app->website = $request->website;
        $app->address = $request->address;
        $app->save();
        return $app;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logo(Request $request, $id)
    {
        // return ($request->all());

        $upload = App::find($id);
        if ($request->hasFile('image')) {
            // dd($request->image);
            $img = $request->image;
            if (File::exists($upload->logo)) {
                dd('e');
                $image_path = $upload->logo;
                File::delete($image_path);
                dd($upload->logo);
            }
            dd($upload->logo, '2');
            $imagename = Storage::disk('public')->put('logo', $img);
            $imgArr = explode('/', $imagename);
            $image_name = $imgArr[1];
            $upload->logo = $image_name;
            $upload->save();
            return $upload;
        }
        // dd($request->image);

    }
}
