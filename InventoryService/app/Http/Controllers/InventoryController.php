<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return response()->json(Inventory::all());
    }

    public function show($id)
    {
        $inventory = Inventory::where('product_id', $id)->first();

        if (!$inventory) {
            return response()->json(['stock' => 0]);
        }

        return response()->json(['stock' => $inventory->stock]);
    }

    public function store(Request $request)
    {
        $inventory = Inventory::create($request->only(['product_id', 'stock']));
        return response()->json($inventory, 201);
    }

    public function update(Request $request, $product_id)
    {
        $inventory = Inventory::where('product_id', $product_id)->first();
        if (!$inventory)
            return response()->json(['message' => 'Not found'], 404);

        $inventory->update([
            'stock' => $request->input('stock')
        ]);

        return response()->json($inventory);
    }
}
