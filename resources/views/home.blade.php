@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
            @endif
            <form method="post" enctype="multipart/form-data">
                @csrf
                @auth
                    <div class="input-group">
                        <input type="file" name="image[]" multiple class="form-control" id="inputGroupFile04"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        
                    </div>
                    <div class="form-floating mt-2">
                        <textarea class="form-control" placeholder="Description" id="floatingTextarea" name="desc"></textarea>
                        <label for="floatingTextarea">Description</label>
                    </div>
                    
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="public">
                        <label class="form-check-label" for="flexCheckDefault">
                            public
                        </label> 
                        
                    </div>
                    <button class="btn btn-primary mt-3" type="submit" id="inputGroupFileAddon04">Upload</button>

                @endauth
                
                
                <div class="row mt-5">
                    @foreach($galleries as $gallery)
                        
                        @if(auth()->user()->id!=$gallery->user_id && $gallery->isActive==1)
                        <div class="col-md-4 mt-3 mb-4">
                            <div class="card anothercard">
                                <img src="{{ asset('upload/'. $gallery->filename) }}" class="card-img-top" alt="image" width="100%" height="180" />

                                <div class="card-body">
                                    <h4 class="fw-bold">Description:</h4>
                                    <p class="card-title">{{ $gallery->description }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ asset('upload/'. $gallery->filename) }}" target="_blank" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('home.download',$gallery->id) }}" class="btn btn-success"><i class="fa-solid fa-circle-down"></i></a>
                                    <a href="{{ route('home.destory',$gallery->id)}}" class="btn btn-danger float-end"><i class="fa-solid fa-trash"></i></a>
                                    
                                </div>
                            </div>
                        </div>
                    
                        @elseif(auth()->user()->id==$gallery->user_id)
                        <div class="col-md-4 mt-3 mb-4">
                            <div class="card anothercard">
                                <img src="{{ asset('upload/'. $gallery->filename) }}" class="card-img-top" alt="image" width="100%" height="180" />

                                <div class="card-body">
                                    <h4 class="fw-bold">Description:</h4>
                                    <p class="card-title">{{ \Illuminate\Support\Str::limit($gallery->description, 150, ' ...') }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ asset('upload/'. $gallery->filename) }}" target="_blank" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('home.download',$gallery->id) }}" class="btn btn-success"><i class="fa-solid fa-circle-down"></i></a>
                                    <a href="{{ route('home.destory',$gallery->id)}}" class="btn btn-danger float-end"><i class="fa-solid fa-trash"></i></a>
                                    
                                </div>
                            </div>
                        </div>  
                        
                        @endif

                    @endforeach   
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection

<!-- {{-- https://www.positronx.io/laravel-upload-images-with-spatie-media-library-tutorial/ --}} -->
<!-- https://www.itsolutionstuff.com/post/laravel-8-user-roles-and-permissions-tutorialexample.html#at_pco=smlwn-1.0&at_si=6319c066244a6cf4&at_ab=per-2&at_pos=0&at_tot=1 -->
{{-- https://www.honeybadger.io/blog/user-roles-permissions-in-laravel/ --}}