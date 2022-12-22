@extends('layout.app')

@section('title', 'Cart')

@section('main')
    <div class="container-fluid p-4">
        <div class="text-center">
            <h3>Your Cart</h3>
        </div>
        <a href="{{ route('order.history') }}" class="btn btn-outline-dark">View History Order</a>
        @if (count($carts_view) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts_view as $index => $ct)
                        <tr>
                            <td style="width: 5%;">
                                {{ $index }}
                            </td>
                            <td style="width: 5%;">
                                {{ $ct['product_id'] }}
                            </td>
                            <td style="width: 10%;">
                                {{ $ct['name'] }}
                            </td>
                            <td style="width: 20%;">
                                <img src="/uploads/{{ $ct['image'] }}" class="card-img" alt="">
                            </td>
                            <td style="width: 10%;">
                                {{ number_format($ct['price'], 2, '.', ',') }} vnd
                            </td>
                            <td style="width: 20%;">
                                <form action="{{ route('shop.update_cart', $ct['product_id']) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ct['product_id'] }}">
                                    <input type="text" name="quantity" value="{{ $ct['quantity'] }}"
                                        class="form-control">
                                    <button class="btn-success" type="submit">Update</button>
                                </form>
                            </td>
                            <td style="width: 10%;">
                                {{ number_format($ct['price'] * $ct['quantity'], 2, '.', ',') }} vnd
                            </td>
                            <td style="width: 10%;">
                                <a href="{{ route('shop.delete_cart', $ct['product_id']) }}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-right">
                            ToTal ?
                        </td>
                        <td colspan="2">
                            {{ number_format($totalPrice, 2, '.', ',') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('home.index') }}" class="btn btn-sm btn-primary">Tiếp tục mua hàng</a>
                <a href="{{ route('shop.clear_cart') }}" class="btn btn-sm btn-danger"
                    onclick="return confirm('Bạn có chắc không?')">Xóa
                    hết</a>
                <a href="{{ route('order.checkout') }}" class="btn btn-sm btn-success">Đặt hàng</a>
            </div>
        @else
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Giỏ hàng rỗng</strong> Giỏ hàng đang rỗng, <a href="{{ route('home.index') }}">hãy click vào
                    đây</a> để tiếp
                tục mua hàng
            </div>

        @endif

    </div>
@endsection
