<div class="col-md-4 mt-3 mb-4">
    <div class="card">
        <div class="card-body p-0">
            <img src="{{ $gallery->filename }}" alt="image" width="100%" height="180" />
        </div>
        <div class="card-footer">
            <a href="{{ $gallery->filename }}" target="_blank" class="btn btn-info">View</a>
            <a href="{{ route('home.download',$gallery->id) }}" class="btn btn-sm btn-success">Download</a>
            <a href="{{ route('home.destory',$gallery->id)}}" class="btn btn-danger float-end">Delete</a>
        </div>
        

    </div>
</div>

@php
                        $galleryarray=json_decode($galleries);
                        $arrlength=count($galleryarray);
                        for($i=0;$i<$arrlength;$i++){
                        $user=auth()->user();
                        // echo $user;
                        $isPublic = $galleryarray[$i]->isActive==1;
                        // echo $isPublic;
                    if($isPublic && $user){
                            // print_r($galleryarray[$i]);
                            $galleriesreal=$galleryarray[$i];
                            // print_r($galleriesreal);
                            // return view('home',compact('galleries'));
                        }else{
                            // print_r($galleryarray[$i]->isActive='private');
                            $galleriesreal=$galleryarray[$i]->isActive='private';
                            // return view('home',compact('galleries'));
                            print_r($galleriesreal);
                            // echo'hi';
                        }
                    }
                            
                    @endphp