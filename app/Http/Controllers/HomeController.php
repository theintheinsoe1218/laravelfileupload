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
        $this->middleware('auth')->except(['index','store', 'download']);
    }

    public function index()
    {
        
        // $galleries=Gallery::where('user_id','!=',auth()->user()->id)->get();
        // dd($galleries);
        // $galleries=auth()->user()->galleries;
        // print_r($galleryarray[0]->isActive);
        $galleries=Gallery::all();
        // $galleryarray=json_decode($galleries);
        // $arrlength=count($galleries);
        // echo $arrlength;

        // foreach($galleries as $gallery){
        //     if(auth()->user() && $gallery->isActive==1){
        //         $galleryreal=$gallery;
                
        //     }else{
        //         $galleryreal=$gallery->isActive=='private';
        //     }
        // }




            // for($i=0;$i<$arrlength;$i++){
            //     $user=auth()->user();
            //     // echo $user;
            //     $isPublic = $galleries[$i]->isActive==1;
            //     // echo $isPublic;
            //     if($isPublic && $user){
            //         // print_r($galleries[$i]);
            //         $galleriesreal=$galleries[$i];
            //         echo($galleriesreal);
                    
            //         // print_r($galleriesreal);
            //         // return view('home',compact('galleriesreal'));
            //     }else{
            //         // print_r($galleries[$i]->isActive='private');
            //         $galleriesreal=$galleries[$i]->isActive='private';
            //         // return view('home',compact('galleriesreal'));
            //         echo($galleriesreal);
            //         // echo'hi';
            //     }

            //         // return view('home',compact('galleriesreal'));

            // }
        
        // echo $isOwner;

        return view('home',compact('galleries'));
        
        

    }

    public function detail(){
        // $galleries=auth()->user()->galleries;
        $galleriesActive=Gallery::where('user_id','!=',auth()->user()->id)->orWhere('isActive','==','1')->get();


        return view('detail',compact('galleriesActive'));
    }

    public function store(Request $request)
    {
        
        // dd($request->public);
        $request->validate([
            'image'=>'required',
            'image.*'=>'image'
        ]);

        

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                // $fileName = time() . '_' . $image->getClientOriginalName();

                // $request->file('image')->move(public_path('image'),$fileName);

                // $image->storeAs('upload', $fileName);

                // $gallery=new Gallery;
                // $gallery->filename=$fileName;
                // $gallery->save();

                // $name = time().'_'.$image->getClientOriginalName();


                // $image_name = $image->getRealPath();
                // // dd($image_name);
                // Cloudder::upload($image_name, null);
                // list($width, $height) = getimagesize($image_name);
                // $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height]);
                // $image->storeAs('upload', $name);

                // $this->saveImages($request, $image_url);

                $uploadedFileUrl = cloudinary()->upload($image->getRealPath(),[
                    'folder'=>'fileupload'
                ])->getSecurePath();
                // dd($uploadedFileUrl);
                // $image->storeAs('upload/', $uploadedFileUrl);

                
                $gallery=new Gallery;
                $gallery->filename= $uploadedFileUrl;
                $gallery->isActive=$request->boolean('public');
                $gallery->user_id=auth()->user()->id;
                $gallery->save();
                // return response()->json([
                //     'status'=>'Image Uploaded Successfully',
                //     'gallery'=>$gallery
                // ]);
                
            }

            
        }

        return back()->with('status','Image uploaded Successfully');
        // return response()->json(['success'=>'Form Submitted successfully.']);


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
