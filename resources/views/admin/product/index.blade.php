@extends('layout.admin')

@section('title', 'Product Management')

@section('main')
    <div class="p-4">
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>
                    {{ session('success') }}
                </strong>
            </div>
        @endif
        <div class="row align-items-center">
            <div class="add col-lg-6">
                <a href="{{ route('product.create') }}" class="btn btn-outline-success rounded-0">Add &plus;</a>
                <a href="{{ route('product.exports') }}" class="btn btn-outline-success rounded-0">Export</a>
                <a href="{{ route('product.recycle_bin') }}" class="btn btn-outline-warning rounded-0">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
            <div class="search col-lg-6">
                <form action="" method="get" class="form-inline">
                    <input type="text" name="keyword" id="" class="form-control w-75 rounded-0"
                        placeholder="Search...">
                    <button type="submit" class="btn btn-outline-success rounded-0 w-25" title="Search...">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price (VND)</th>
                    <th>Sale Price (VND)</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $prod)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $prod->id }}</td>
                        <td>{{ $prod->name }}</td>
                        <td>{{ number_format($prod->price, 2, '.', ',') }}</td>
                        <td>{{ number_format($prod->sale_price, 2, '.', ',') }}</td>
                        <td style="width: 10%;">
                            <img src="/uploads/{{ $prod->image }}" alt="" class="card-img">

                        </td>
                        <td>{!! $prod->status == 1
                            ? "<span class='badge badge-success rounded-0'>Show</span>"
                            : "<span class='badge badge-danger rounded-0'>Hide</span>" !!}</td>
                        <td>{{ $prod->description ?? 'Null' }}</td>
                        <td>
                            <a href="{{ route('category.show', $prod->categories->id) }}"
                                title="View Details of {{ $prod->categories->name }}"
                                class="card-link">{{ $prod->categories->name }}</a>
                        </td>
                        <td style="width: 10%;">
                            <form action="{{ route('product.destroy', $prod->id) }}" method="post">
                                <a href="{{ route('product.edit', $prod->id) }}" class="btn btn-outline-success rounded-0">
                                    <i class="fa fa-edit"></i></a>
                                @method('DELETE') @csrf
                                <button type="submit" onclick="return confirm('Want to delete ?')"
                                    class="btn btn-outline-danger rounded-0">
                                    <i class="fa fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
