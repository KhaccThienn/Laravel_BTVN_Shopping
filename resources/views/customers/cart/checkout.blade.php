@extends('layout.app')

@section('title', 'CheckOut')

@section('main')
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-4">
                <h2>Order Detail: </h2>
                @if (count($cart->getCart()) > 0)
                    <form action="" method="POST" role="form">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $customer->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="text" class="form-control" name="email" value="{{ $customer->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $customer->address }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Order Now</button>
                    </form>
                @endif
            </div>
            <div class="col-md-8">
                <h2>Your Cart: Quantity: {{ number_format($cart->getTotalQty(), 2, '.', ',') }}, Total Price:
                    {{ number_format($cart->getTotalPrice(), 2, '.', ',') }} đ
                </h2>

                @if (count($cart->getCart()) > 0)

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->getCart() as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ number_format($item['price']) }} đ</td>
                                    <td>
                                        <form action="{{ route('shop.update_cart', $item['product_id']) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                style="width:80px; text-align: center">
                                            <button class="btn btn-sm btn-success">Update</button>
                                        </form>
                                    </td>
                                    <td>{{ number_format($item['quantity'] * $item['price']) }} đ</td>
                                    <td>
                                        <a href="{{ route('shop.delete_cart', $item['product_id']) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc không?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Giỏ hàng rỗng</strong> Giỏ hàng đang rỗng, <a href="{{ route('home.index') }}">hãy click
                            vào
                            đây</a> để tiếp tục mua hàng
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
