@extends('layout.admin')

@section('title', 'Update Category')

@section('main')
    <div class="p-4 container">
        <form action="{{ route('category.update', $cat->id) }}" method="post" role="form">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{ $cat->id }}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Category's Name"
                    value="{{ $cat->name ?? old('name') }}"
                    aria-describedby="helpId">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status1" value="1" {{ $cat->status == 1 ? 'checked' : '' }}>
                        Show
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status0" value="0" {{ $cat->status == 0 ? 'checked' : '' }}>
                        Hide
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
