@extends('layout.app')

@section('title', 'Home Page')

@section('main')
    <div class="container-fluid">
        <div id="carouselId" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                <li data-target="#carouselId" data-slide-to="1"></li>
                <li data-target="#carouselId" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/04d7d2105464265.617b69951ef14.png"
                        class="card-img" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Title</h3>
                        <p>Description</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/04d7d2105464265.617b69951ef14.png"
                        class="card-img" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Title</h3>
                        <p>Description</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/04d7d2105464265.617b69951ef14.png"
                        class="card-img" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Title</h3>
                        <p>Description</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="new-product">
            <div class="text-center h2">
                New Products
            </div>
            <div class="container">
                <div class="row">
                    @forelse ($newProducts as $np)
                        <div class="card col-lg-3 mt-3 border-0" style="width: 18rem;">
                            <a href="{{ route('shop.detail', ['id' => $np->id, 'slug' => slug_format($np->name)]) }}"
                                class="text-decoration-none">
                                <img src="uploads/{{ $np->image }}" class="card-img-top" alt="...">
                                <div class="card-img-overlay">
                                    {!! $np->status == 1
                                        ? "<span class='badge badge-success'>In Stock</span>"
                                        : "<span class='badge badge-danger'>Out Of Stock</span>" !!}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Name: {{ $np->name }}</h5>
                                    <p class="card-text  {{ $np->sale_price > 0 ? 'text-danger' : 'text-success' }}">Price:
                                        $ {{ $np->price }}</p>
                                    @if ($np->sale_price > 0)
                                        <p class="card-text text-success">
                                            Sale Price: $ {{ $np->sale_price }} </p>
                                        <span> Discount:
                                            {{ number_format((1 - $np->sale_price / $np->price) * 100, 2, '.', ',') }}
                                            %</span>
                                    @else
                                    @endif
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-lg-6 text-center justify-content-between">
                            No data
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="random-product mt-5">
            <div class="text-center h2">
                Random Products
            </div>
            <div class="container">
                <div class="row">
                    @forelse ($randomProducts as $np)
                        <div class="card col-lg-3 mt-3 border-0" style="width: 18rem;">
                            <a href="{{ route('shop.detail', ['id' => $np->id, "slug" => slug_format($np->name)]) }}" class="text-decoration-none">
                                <img src="uploads/{{ $np->image }}" class="card-img-top" alt="...">
                                <div class="card-img-overlay">
                                    {!! $np->status == 1
                                        ? "<span class='badge badge-success'>In Stock</span>"
                                        : "<span class='badge badge-danger'>Out Of Stock</span>" !!}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Name: {{ $np->name }}</h5>
                                    <p class="card-text  {{ $np->sale_price > 0 ? 'text-danger' : 'text-success' }}">Price:
                                        $ {{ $np->price }}</p>
                                    @if ($np->sale_price > 0)
                                        <p class="card-text text-success">
                                            Sale Price: $ {{ $np->sale_price }} </p>
                                        <span> Discount:
                                            {{ number_format((1 - $np->sale_price / $np->price) * 100, 2, '.', ',') }}
                                            %</span>
                                    @else
                                    @endif
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-lg-6 text-center justify-content-between">
                            No data
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="saling-product mt-5">
            <div class="text-center h2">
                Saling Products
            </div>
            <div class="container">
                <div class="row">
                    @forelse ($saleProducts as $np)
                        <div class="card col-lg-3 mt-3 border-0" style="width: 18rem;">
                            <a href="{{ route('shop.detail', ['id' => $np->id, "slug" => slug_format($np->name)]) }}" class="text-decoration-none">

                                class="text-decoration-none text-dark">
                                <img src="uploads/{{ $np->image }}" class="card-img-top" alt="...">
                                <div class="card-img-overlay">
                                    {!! $np->status == 1
                                        ? "<span class='badge badge-success'>In Stock</span>"
                                        : "<span class='badge badge-danger'>Out Of Stock</span>" !!}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $np->name }}</h5>
                                    <p class="card-text text-success">
                                        Sale Price: $ {{ $np->sale_price }} </p>
                                    <span> Discount:
                                        {{ number_format((1 - $np->sale_price / $np->price) * 100, 2, '.', ',') }}
                                        %</span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-lg-6 text-center justify-content-between">
                            No data
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection
