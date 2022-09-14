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
                        
                        <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">Upload</button>
                    </div>
                    <div class="form-check float-end mt-3">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="public">
                        <label class="form-check-label" for="flexCheckDefault">
                            public
                        </label> 
                        
                    </div>
                @endauth
                <div class="row mt-5">
                    @foreach ($galleries as $gallery)
                
                    @if($gallery->user_id==auth()->user()->id)
                    
                    <div class="col-md-4 mt-3 mb-4">
                        <div class="card">
                            <div class="card-body p-0">
                                <img src="{{ $gallery->filename }}" alt="image" width="100%" height="180" />
                            </div>
                            <div class="card-footer">
                                <a href="{{ $gallery->filename }}" target="_blank" class="btn btn-info">View</a>
                                <a href="{{ route('home.download',$gallery->id) }}" class="btn btn-success">Download</a>
                                <a href="{{ route('home.destory',$gallery->id)}}" class="btn btn-danger float-end">Delete</a>
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

