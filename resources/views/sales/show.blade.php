@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Sale Details</h1>
            <a href="{{ route('sales.index') }}" class="btn btn-primary">Back to Sales</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <p><strong>Customer:</strong> {{ $sale->user->name }}</p>
            <p><strong>Total:</strong> {{ $sale->total }}</p>
            <p><strong>Date:</strong> {{ $sale->created_at->format('Y-m-d') }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Items</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->discount }}</td>
                            <td>{{ ($item->quantity * $item->price) - $item->discount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if ($sale->notes->count() > 0)
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Notes</h3>
                @foreach ($sale->notes as $note)
                    <p>{{ $note->note }}</p>
                @endforeach
            </div>
        </div>
    @endif
@endsection
