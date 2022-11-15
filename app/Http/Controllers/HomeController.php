<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Gate;

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


    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'download']);
    }

    public function index()
    {
        
        $galleries=Gallery::all();
        return view('home',compact('galleries'));
        
    }


    public function store(Request $request)
    {
        
        // dd($request->all());
        $request->validate([
            'image'=>'required',
            'image.*'=>'image',
            'desc'=>'required',
        ]);

        

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $fileName = time() . '_' . $image->getClientOriginalName();

                // $image->move(public_path('image'),$fileName);

                $image->storeAs('upload', $fileName);

                // $gallery=new Gallery;
                // $gallery->filename=$fileName;
                // $gallery->save();

                // $name = time().'_'.$image->getClientOriginalName();


                


                // $uploadedFileUrl = cloudinary()->upload($image->getRealPath(),[
                //     'folder'=>'laravalfileupload'
                // ])->getSecurePath();
                // // dd($uploadedFileUrl);
                // $image->storeAs('upload', $uploadedFileUrl);

                // $image->move(public_path('upload'),$uploadedFileUrl);


                
                $gallery=new Gallery;
                $gallery->filename= $fileName;
                $gallery->description=$request->desc;
                $gallery->isActive=$request->boolean('public');
                $gallery->user_id=auth()->user()->id;
                $gallery->save(); 
                // $image->storeAs('upload/', $uploadedFileUrl);

            }  
        }

        return back()->with('status','Image uploaded Successfully');
    }

    

    public function destory($id)
    {
        $gallery = Gallery::findOrFail($id);
        if(Gate::allows('gallery-delete',$gallery)){
            Storage::delete('upload/' . $gallery->filename);
            $gallery->delete();
            return back()->with('status', 'An image was deleted');
        }else{
            return back()->with('status', 'Unauthorize');

        }
    }

    public function download($id)
    {
        $gallery = Gallery::findOrFail($id);
        return Storage::download('upload/'.$gallery->filename);
    }

}
