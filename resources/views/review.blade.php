@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
            <div class="alert alert-success">
                    {{ session('success') }}
                </div>
        @endif  
            <div class="card mt-3">
                <div class="card-header">
                    <h2>Review Form</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control"/>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="emal" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" rows="5" class="form-control"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-secondary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
