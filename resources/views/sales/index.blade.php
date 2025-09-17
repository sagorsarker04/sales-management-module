@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Sales</h1>
            <a href="{{ route('sales.create') }}" class="btn btn-primary">Create Sale</a>
            <a href="{{ route('trash.index') }}" class="btn btn-secondary">Trash</a>
            <a href="{{ route('products.index') }}" class="btn btn-outline">Products</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <form action="{{ route('sales.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" value="{{ request('customer_name') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{ request('product_name') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="date_from" class="form-control" placeholder="Date From" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="date_to" class="form-control" placeholder="Date To" value="{{ request('date_to') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>{{ $sale->total }}</td>
                            <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info">View</a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" data-action="{{ route('sales.destroy', $sale->id) }}" data-id="{{ $sale->id }}" method="POST" class="js-delete-form" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $sales->links() }}
            <p>Total per page: {{ $total_per_page }}</p>
        </div>
    </div>
@endsection
