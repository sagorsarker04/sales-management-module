@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product: {{ $product->name }}</h1>

    <p><strong>Price:</strong> {{ number_format($product->price, 2) }}</p>

    <a href="{{ route('products.edit', $product) }}" class="btn btn-outline">Edit</a>
    <a href="{{ route('products.index') }}" class="btn btn-outline">Back to list</a>
</div>
@endsection
