@extends('layout.app')

@section('title', 'Detail')

@section('main')
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6">
                <img src="/uploads/{{ $prod->image }}" alt="" class="card-img">
            </div>
            <div class="col-lg-6">
                <small>ID: {{ $prod->id }}</small>
                <h2>{{ $prod->name }}</h2>
                <p>Category: {{ $prod->categories->name }}</p>
                <p>Status: {!! $prod->status == 1
                    ? "<span class='badge badge-success'>In Stock</span>"
                    : "<span class='badge badge-danger'>Out Of Stock</span>" !!}</p>
                <p class="card-text  {{ $prod->sale_price > 0 ? 'text-danger' : 'text-success' }}">Price:
                    $ {{ $prod->price }}</p>
                @if ($prod->sale_price > 0)
                    <p class="card-text text-success">
                        Sale Price: $ {{ $prod->sale_price }} </p>
                    <span> Discount:
                        {{ number_format((1 - $prod->sale_price / $prod->price) * 100, 2, '.', ',') }}
                        %</span>
                @else
                @endif
                <h4>Description: </h4>
                <p>{{ $prod->description ?? 'NULL' }}</p>

                @auth
                    @if ($prod->status == 1)
                        <form action="{{ route('shop.cart', $prod->id) }}" method="post">
                            @csrf
                            <input type="text" name="quantity" value="1" class="form-control @error('quantity') is-invalid @enderror">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn btn-block btn-outline-success"><i class="fa fa-cart-plus"></i></button>
                        </form>
                    @else
                        <p>This product is out of stock right now, <a href="{{ route('shop.index') }}">Return to shop</a></p>
                    @endif

                @else
                    <a href="{{ route('user.sign-in') }}" class="btn btn-outline-primary rounded-0">
                        Login To Buy This Item<span class="badge badge-primary"></span>
                    </a>
                @endauth

            </div>
        </div>
    </div>
@endsection
