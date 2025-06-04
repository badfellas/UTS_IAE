<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::all();

        $inventoryServiceUrl = env('INVENTORY_SERVICE_URL');

        $productsWithStock = $products->map(function ($product) use ($inventoryServiceUrl) {
            // Panggil InventoryService untuk ambil stok produk ini
            $response = Http::get("$inventoryServiceUrl/api/inventories/{$product->id}");

            $stock = $response->successful() ? ($response->json()['stock'] ?? 0) : 0;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $stock,
            ];
        });

        return response()->json($productsWithStock);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only(['name', 'price']));
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);
        $product->update($request->only(['name', 'price']));
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
