@extends('layout.app')

@section('title', 'Product Page')

@section('main')
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-3">
                <form action="" method="get">
                    <div class="form-group">
                        <label for="order">Sort By...</label>
                        <select class="form-control " name="order" id="order">
                            <option value="name-ASC">Name (a - z)</option>
                            <option value="name-DESC">Name (z - a)</option>
                            <option value="price-ASC">Price (low - high)</option>
                            <option value="price-DESC">Price (high - low)</option>
                        </select>
                        <button type="submit" class="btn btn-app btn-outline-primary"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <div class="list-group">
                    <a href="{{ route('shop.index') }}"
                        class="list-group-item list-group-item-action {{ !request()->route('id') ? 'active' : '' }}""
                        aria-current="true">
                        All
                    </a>
                    @foreach ($cats as $cate)
                        <a href="{{ route('shop.shop_cate', $cate->id) }}"
                            class="list-group-item list-group-item-action {{ request()->route('id') == $cate->id ? 'active' : '' }}"
                            aria-current="true">
                            {{ $cate->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($allProds as $prod)
                        <div class="card col-lg-3 mt-3">
                            <a href="{{ route('shop.detail', $prod->id) }}" class="text-dark text-decoration-none">
                                <img class="card-img-top" src="/uploads/{{ $prod->image }}" alt="">
                                <div class="card-img-overlay">
                                    {!! $prod->status == 1
                                        ? "<span class='badge badge-success'>In Stock</span>"
                                        : "<span class='badge badge-danger'>Out Of Stock</span>" !!}
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $prod->name }}</h4>
                                    <p class="card-text  {{ $prod->sale_price > 0 ? 'text-danger' : 'text-success' }}">
                                        Price:
                                        $ {{ $prod->price }}</p>
                                    @if ($prod->sale_price > 0)
                                        <p class="card-text text-success">
                                            Sale Price: $ {{ $prod->sale_price }} </p>
                                        <span> Discount:
                                            {{ number_format((1 - $prod->sale_price / $prod->price) * 100, 2, '.', ',') }}
                                            %</span>
                                    @else
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        {{ $allProds->links() }}
    </div>
@endsection
