@extends('layout.admin')

@section('title', 'Category Management')

@section('main')
    <div class="container p-4">
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
                <a href="{{ route('category.create') }}" title="Add New Category" class="btn btn-outline-success rounded-0">Add &plus;</a>
                <a href="{{ route('category.recycle_bin') }}" title="View Trash" class="btn btn-outline-warning rounded-0"><i class="fa fa-trash"></i></a>
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
                    <th style="width: 15%;">Product Count</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $cat->id }}</td>
                        <td>
                            <a href="{{ route('category.show', $cat->id) }}" title="View Details of {{ $cat->name }}"
                                class="card-link">{{ $cat->name }}</a>

                        </td>
                        <td>{{ $cat->products->count() }}</td>

                        <td>{!! $cat->status == 1
                            ? "<span class='badge badge-success rounded-0'>Show</span>"
                            : "<span class='badge badge-danger rounded-0'>Hide</span>" !!}</td>
                        <td style="width: 15%;">
                            <form action="{{ route('category.destroy', $cat->id) }}" method="post">
                                <a href="{{ route('category.show', $cat->id) }}" class="btn btn-outline-primary rounded-0" title="View Detail Of {{ $cat->name }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-outline-success rounded-0" title="Edit Category {{ $cat->name }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @method('DELETE') @csrf
                                <button type="submit" onclick="return confirm('Want to delete ?')"
                                title="Delete Category {{ $cat->name }}"
                                    class="btn btn-outline-danger rounded-0">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
