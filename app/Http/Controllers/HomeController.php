<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __8000construct()
    // {
    //     // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $galleries=Gallery::all();
        return view('home',compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required',
            'image.*'=>'image'
        ]);

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $fileName = time() . '_' . $image->getClientOriginalName();

                // $request->file('image')->move(public_path('image'),$fileName);

                $image->storeAs('upload', $fileName);

                $gallery=new Gallery;
                $gallery->filename=$fileName;
                $gallery->save();

            }
        }


        return back()->with('status','Images were uploaded');

    }

    public function destory($id)
    {
        $gallery = Gallery::findOrFail($id);
        Storage::delete('upload/' . $gallery->filename);
        $gallery->delete();
        return back()->with('status','An image was deleted');
    }

    public function download($id)
    {
        $gallery = Gallery::findOrFail($id);
        return Storage::download('upload/' . $gallery->filename);
    }


}
