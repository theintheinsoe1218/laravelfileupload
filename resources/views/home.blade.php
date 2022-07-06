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
                <div class="input-group">
                    <input type="file" name="image[]" multiple class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">Upload</button>
                </div>
                <div class="row mt-5">
                    @foreach ($galleries as $gallery)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body p-0">
                                    <img src="{{ asset('/upload/'.$gallery->filename) }}" alt="{{ $gallery->filename }}" class="img-fluid"/>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ $gallery->image_link }}" target="_blank" class="btn btn-info">View</a>
                                    <a href="{{ route('home.download',$gallery->id) }}" class="btn btn-success">Download</a>
                                    <a href="{{ route('home.destory',$gallery->id)}}" class="btn btn-danger float-end">Delete</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
