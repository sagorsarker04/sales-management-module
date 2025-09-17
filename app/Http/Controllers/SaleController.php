<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::with('user', 'items.product')
            ->when($request->filled('customer_name'), function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->customer_name . '%');
                });
            })
            ->when($request->filled('product_name'), function ($query) use ($request) {
                $query->whereHas('items.product', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->product_name . '%');
                });
            })
            ->when($request->filled('date_from') && $request->filled('date_to'), function ($query) use ($request) {
                $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
            })
            ->paginate(10);

        $total_per_page = $sales->sum(function ($sale) {
            return $sale->items->sum(function ($item) {
                return ($item->price * $item->quantity) - $item->discount;
            });
        });

        return view('sales.index', compact('sales', 'total_per_page'));
    }

    public function create()
    {
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();
        return view('sales.create', compact('customers', 'products'));
    }

    public function store(SaleRequest $request)
    {
        $sale = Sale::create([
            'user_id' => $request->user_id,
            'total' => calculateSaleTotal($request->items),
        ]);

        foreach ($request->items as $item) {
            $sale->items()->create($item);
        }

        if ($request->has('notes')) {
            $sale->notes()->create(['note' => $request->notes]);
        }

        // If request expects JSON (AJAX) return JSON, otherwise redirect to the created sale page
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => 'Sale created successfully.', 'sale_id' => $sale->id]);
        }

        return redirect()->route('sales.show', $sale->id)->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::with('user', 'items.product', 'notes')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // not implemented
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // not implemented
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \Illuminate\Support\Facades\Log::info("Deleting sale with ID: $id");

        $sale = Sale::findOrFail($id);

        // Use the model delete method (works with soft deletes if the model uses SoftDeletes)
        $sale->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Sale deleted successfully.']);
        }

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
