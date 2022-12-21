@extends('layout.admin')

@section('title', 'Create Product')

@section('main')
    <div class="container p-4">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" role="form">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Product's Name"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="Product's Price">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="sale_price">Sale Price</label>
                <input type="text" name="sale_price" id="sale_price" class="form-control" value="0"
                    placeholder="Product's Sale Price">
                @error('sale_price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status1" value="{{ 1 ?? old('status') }}" checked>
                        Show
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status0" value="{{ 0 ?? old('status') }}">
                        Hide
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Product's Description" cols="30"
                    rows="5">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'checked' : '' }}>{{ $cate->id }} - {{ $cate->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
