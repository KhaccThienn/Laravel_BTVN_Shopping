@extends('layout.app')

@section('title', 'Order List')

@section('main')
    <div class="container">
        <h2>List of traded orders</h2>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th>Purchase date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer->orders as $order)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>{{ number_format($order->totalPrice()) }} đ</td>
                        <td>
                            @if ($order->status == 0)
                                <span class="label label-warning">Pending</span>
                            @elseif ($order->status == 1)
                                <span class="label label-primary">Approved</span>
                            @elseif ($order->status == 2)
                                <span class="label label-success">Completed</span>
                            @else
                                <span class="label label-danger">Cancelled</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('order.detail', $order->id) }}" class="btn btn-sm btn-primary">View Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
