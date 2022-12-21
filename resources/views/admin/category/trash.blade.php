@extends('layout.admin')

@section('title', 'Category RecycleBin')

@section('main')
    <div class="container p-4">
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
                            <form action="{{ route('category.force_delete', $cat->id) }}" method="post">
                                <a href="{{ route('category.restore', $cat->id) }}" class="btn btn-outline-primary rounded-0" title="Edit Category {{ $cat->name }}">
                                    <i class="fa fa-trash-restore"></i>
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
    </div>
@endsection
