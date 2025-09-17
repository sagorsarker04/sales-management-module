<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getPrice($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['price' => $product->price]);
    }
}
