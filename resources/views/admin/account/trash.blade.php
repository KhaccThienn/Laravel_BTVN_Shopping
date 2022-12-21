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
                        <td style="width: 15%;">
                            <form action="{{ route('account.force_delete', $acc->id) }}" method="post">
                                <a href="{{ route('account.restore', $acc->id) }}" class="btn btn-outline-primary rounded-0">
                                    <i class="fa fa-trash-restore"></i>
                                </a>
                                @method('DELETE') @csrf
                                <button type="submit" onclick="return confirm('Want to delete ?')"
                                title="Delete Account {{ $acc->name }}"
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
