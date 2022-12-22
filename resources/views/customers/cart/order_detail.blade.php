@extends('layout.app')
@section('title', 'Order Details')
@section('main')
    <div class="container-fluid">
        <h2>Order details
        </h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Order Informations</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <td>#{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Order date
                            </th>
                            <td>{{ $order->created_at->format('d/m/yy') }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>{{ number_format($order->totalPrice()) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($order->status == 0)
                                    <span class="label label-warning">Pending</span>
                                @elseif ($order->status == 1)
                                    <span class="label label-primary">Approved</span>
                                @elseif ($order->status == 2)
                                    <span class="label label-success">Completed</span>
                                @else
                                    <span class="label label-danger">Canceled</span>
                                @endif
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>


            <div class="col-md-6">
                <h3>Shipment Details </h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $order->phone }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>



        <h3>Product details of the order</h3>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">Np.</th>
                    <th>Product's Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $detail)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->price) }} đ</td>
                        <td>{{ number_format($detail->price * $detail->quantity) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
