@extends('layout.app')

@section('title', 'Order Success')

@section('main')
    <div class="container p-4">
        <div class="jumbotron">
            <h1 class="display-3">Order Successfully</h1>
            <p class="lead">Please Check Your Email And Your Orders History</p>
            <hr class="my-2">
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="{{ route('shop.index') }}" role="button">Return to shop</a>
            </p>
        </div>
    </div>
@endsection
