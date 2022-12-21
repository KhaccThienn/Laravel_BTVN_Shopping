@extends('layout.app')
@section('title', 'Sign In')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>Form Sign In</h2>
        </div>
        @if (session('alert'))
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ session('alert') }}</strong>
        </div>
        @endif
        <hr>
        <form action="{{ route('user.login') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror rounded-0" placeholder="Email"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror rounded-0" placeholder="Password"
                    value="{{ old('password') }}">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <button type="submit" class="btn btn-outline-success btn-block rounded-0">Submit</button>
        </form>
    </div>
@endsection
