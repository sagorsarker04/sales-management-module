@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Create Sale</h1>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <form id="sale-form">
                @csrf
                <div class="form-group">
                    <label for="user_id">Customer</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="sale-items">
                        <tr>
                            <td>
                                <select name="items[0][product_id]" class="form-control product-select">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="items[0][quantity]" class="form-control quantity" min="1" value="1"></td>
                            <td><input type="number" name="items[0][price]" class="form-control price" min="0" readonly></td>
                            <td><input type="number" name="items[0][discount]" class="form-control discount" min="0" value="0"></td>
                            <td><input type="text" class="form-control line-total" readonly></td>
                            <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" id="add-item" class="btn btn-primary">Add Item</button>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Grand Total: <span id="grand-total">0.00</span></h3>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Create Sale</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            let itemIndex = 1;

            function calculateTotal() {
                let grandTotal = 0;
                $('#sale-items tr').each(function () {
                    let quantity = $(this).find('.quantity').val();
                    let price = $(this).find('.price').val();
                    let discount = $(this).find('.discount').val();
                    let lineTotal = (quantity * price) - discount;
                    $(this).find('.line-total').val(lineTotal.toFixed(2));
                    grandTotal += lineTotal;
                });
                $('#grand-total').text(grandTotal.toFixed(2));
            }

            $('#sale-items').on('change', '.product-select', function () {
                let price = $(this).find(':selected').data('price');
                $(this).closest('tr').find('.price').val(price);
                calculateTotal();
            });

            $('#sale-items').on('input', '.quantity, .discount', function () {
                calculateTotal();
            });

            $('#add-item').click(function () {
                let products = @json($products);
                let options = '<option value="">Select Product</option>';
                products.forEach(function (product) {
                    options += `<option value="${product.id}" data-price="${product.price}">${product.name}</option>`;
                });

                let newRow = `
                    <tr>
                        <td>
                            <select name="items[${itemIndex}][product_id]" class="form-control product-select">
                                ${options}
                            </select>
                        </td>
                        <td><input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity" min="1" value="1"></td>
                        <td><input type="number" name="items[${itemIndex}][price]" class="form-control price" min="0" readonly></td>
                        <td><input type="number" name="items[${itemIndex}][discount]" class="form-control discount" min="0" value="0"></td>
                        <td><input type="text" class="form-control line-total" readonly></td>
                        <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
                    </tr>
                `;
                $('#sale-items').append(newRow);
                itemIndex++;
            });

            $('#sale-items').on('click', '.remove-item', function () {
                $(this).closest('tr').remove();
                calculateTotal();
            });

            $('#sale-form').submit(function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: '{{ route("sales.store") }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert(response.success);
                        window.location.href = '{{ route("sales.index") }}';
                    },
                    error: function (response) {
                        let errors = response.responseJSON.errors;
                        let errorMessages = '';
                        for (let key in errors) {
                            errorMessages += errors[key][0] + '\n';
                        }
                        alert(errorMessages);
                    }
                });
            });
        });
    </script>
@endpush
