@extends('layout.app')
@section('title', 'Sign Up')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>Form Sign Up</h2>
        </div>
        {{-- @if (session('alert'))
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ session('alert') }}</strong>
        </div>
        @endif --}}
        <hr>
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror rounded-0" placeholder="Username" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror rounded-0" value="{{ old('email') }}"
                        placeholder="Email Address">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-lg-6">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror rounded-0" value="{{ old('phone') }}"
                        placeholder="Phone Number">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Gender</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" id="gender1" value="1"
                                    checked>
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" id="gender0" value="0">
                                Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="birthday">Date of Birth</label>
                        <input type="date" name="birthday" id="birthday" class="form-control @error('birthday') is-invalid @enderror rounded-0" value="{{ old('birthday') }}">
                        @error('birthday')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror rounded-0">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Password" class="form-control @error('password_confirmation') is-invalid @enderror rounded-0">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-success btn-block rounded-0">Submit</button>
        </form>
    </div>
@endsection
