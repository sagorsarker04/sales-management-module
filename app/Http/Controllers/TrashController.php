<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $sales = Sale::onlyTrashed()->with('user')->paginate(10);
        return view('trash.index', compact('sales'));
    }

    public function restore($id)
    {
        $sale = Sale::onlyTrashed()->findOrFail($id);
        $sale->restore();

        return redirect()->route('trash.index')->with('success', 'Sale restored successfully.');
    }
}
