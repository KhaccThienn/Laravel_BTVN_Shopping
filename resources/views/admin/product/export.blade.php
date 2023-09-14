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
                    <img src="{{ url('') }}/uploads/{{ $prod->image }}" alt="" class="card-img">

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
            </tr>
        @endforeach
    </tbody>
</table>
