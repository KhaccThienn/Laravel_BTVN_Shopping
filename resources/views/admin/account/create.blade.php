@extends('layout.admin')

@section('title', 'Add Account')

@section('main')
    <div class="container p-4">
        <form action="{{ route('account.store') }}" method="post">
            @csrf
            <div class="row">

                <div class="form-group col-lg-6">
                    <label for="name">Username</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Username" value="{{ old('name') }}" aria-describedby="helpId">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-lg-6">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Email Address"
                        value="{{ old('email') }}" aria-describedby="helpId">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">

                <div class="form-group col-lg-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                        value="{{ old('password') }}" aria-describedby="helpId">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-lg-6">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Password Confirmation" value="{{ old('password_confirmation') }}"
                        aria-describedby="helpId">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="role">
                        <option value="0">Customers</option>
                        <option value="1">Administrator</option>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="1"
                                checked>
                            Online
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status0" value="0">
                            Banned
                        </label>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-block btn-outline-success">Submit</button>
        </form>
    </div>
@endsection
