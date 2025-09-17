@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Trash</h1>
            <a href="{{ route('sales.index') }}" class="btn btn-primary">Back to Sales</a>
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
                        <th>Deleted Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>{{ $sale->total }}</td>
                            <td>{{ $sale->deleted_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('trash.restore', $sale->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $sales->links() }}
        </div>
    </div>
@endsection
