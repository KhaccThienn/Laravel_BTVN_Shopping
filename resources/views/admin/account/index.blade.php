@extends('layout.admin')

@section('title', 'Account')

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
                <a href="{{ route('account.create') }}" class="btn btn-outline-success rounded-0">Add &plus;</a>
                <a href="{{ route('account.recycle_bin') }}" class="btn btn-outline-warning rounded-0">
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
                    <th>No.</th>
                    <th>ID</th>
                    <th>User's Name</th>
                    <th>Email Address</th>
                    <th>Created At</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $acc)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $acc->id }}</td>
                        <td>{{ $acc->name }}</td>
                        <td>{{ $acc->email }}</td>
                        <td>{{ $acc->created_at }}</td>
                        <td>{{ $acc->role }}</td>
                        <td>{{ $acc->status == 1 ? "Online" : "Banned" }}</td>
                        <td>
                            <form action="{{ route('account.destroy', $acc->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('account.edit', $acc->id) }}"  class="btn btn-outline-success"><i class="fa fa-edit"></i></a>
                                <button type="submit" {{ $acc->role == 1 ? 'disabled' : '' }} class="btn btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
