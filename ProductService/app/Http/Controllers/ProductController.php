<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {
    public function index() {
        return response()->json(Product::all());
    }

    public function show($id) {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product not found'], 404);
        return response()->json($product);
    }

    public function store(Request $request) {
        $product = Product::create($request->only(['name', 'price']));
        return response()->json($product, 201);
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product not found'], 404);
        $product->update($request->only(['name', 'price']));
        return response()->json($product);
    }

    public function destroy($id) {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product not found'], 404);
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
