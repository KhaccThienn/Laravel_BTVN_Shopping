<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @yield('css')
    <style>
        /* The container <div> - needed to position the dropdown content */
        .dropdownss {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            width: 250px;
            position: absolute;
            background-color: #f1f1f1;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdownss:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">Thienn Neeee</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('shop.index') }}">Product</a>
                </li>

                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" id="dropdownId" href="" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        @foreach ($cats as $cate)
                            <a class="dropdown-item"
                                href="{{ route('shop.shop_cate', $cate->id) }}">{{ $cate->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">{{ Auth::check() ? Auth::user()->name : 'Account...' }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        @auth
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Your Account</a>
                            <a class="dropdown-item" href="{{ route('user.sign-out') }}">Sign Out</a>
                        @else
                            <a class="dropdown-item" href="{{ route('user.sign-in') }}">Sign In</a>
                            <a class="dropdown-item" href="{{ route('user.sign-up') }}">Sign Up</a>
                        @endauth

                    </div>
                </li>
                @auth
                    <li class="nav-item dropdownss active">
                        <a href="{{ route('shop.show_cart') }}" class="dropbtn nav-link">Cart <span
                                class="badge badge-success">{{ $carts->getTotalQty() }}</span></a>
                        <div class="dropdown-content">
                            @foreach ($cartss as $ct)
                                <a href="{{ route('shop.detail', ['id' => $ct['product_id'], "slug" => slug_format($ct['name'])]) }}">
                                    <div class="d-flex align-items-center">
                                        <div class="img" style="width: 15%;">
                                            <img src="{{ url('') }}/uploads/{{ $ct['image'] }}" alt="" class="card-img">
                                        </div>
                                        <div class="text">
                                            <p class="p-0"> {{ $ct['name'] }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endauth

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" name="keyword" value="{{ request()->keyword }}"
                    placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    @yield('main')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    @yield('js')
</body>

</html>
