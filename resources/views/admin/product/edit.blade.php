@extends('layout.admin')

@section('title', 'Update Product')

@section('main')
    <div class="container p-4">
        <form action="{{ route('product.update', $prod->id) }}" method="post" enctype="multipart/form-data" role="form">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $prod->id }}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Product's Name"
                    value="{{ old('name') ?? $prod->name }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control"
                    value="{{ old('price') ?? $prod->price }}" placeholder="Product's Price">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="sale_price">Sale Price</label>
                <input type="text" name="sale_price" id="sale_price" class="form-control"
                    value="{{ old('sale_price') ?? $prod->sale_price }}" placeholder="Product's Sale Price">
                @error('sale_price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" value="{{ old('image') ?? $prod->image }}">
                <div class="img" style="width: 20%;">
                    <img src="/uploads/{{ $prod->image }}" alt="" class="card-img">
                </div>
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status1"
                            {{ $prod->status == 1 ? 'checked' : '' }} value="{{ 1 ?? old('status') }}">
                        Show
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status0"
                            {{ $prod->status == 0 ? 'checked' : '' }} value="{{ 0 ?? old('status') }}">
                        Hide
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Product's Description" cols="30"
                    rows="5">{{ old('description') ?? $prod->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach ($categories as $cate)
                        @if ($prod->category_id == $cate->id)
                            <option value="{{ $cate->id }}" selected
                                {{ old('category_id') == $cate->id ? 'checked' : '' }}>
                                {{ $cate->id }} - {{ $cate->name }}</option>
                        @else
                            <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'selected' : '' }}>
                                {{ $cate->id }} - {{ $cate->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
