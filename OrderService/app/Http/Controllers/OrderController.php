<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use App\Jobs\NotifyProduct;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (!$order)
            return response()->json(['message' => 'Order not found'], 404);
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $userServiceUrl = env('USER_SERVICE_URL');
        $productServiceUrl = env('PRODUCT_SERVICE_URL');
        $inventoryServiceUrl = env('INVENTORY_SERVICE_URL');

        // Ambil user
        $userResponse = Http::get("$userServiceUrl/api/users/{$request->user_id}");
        $productResponse = Http::get("$productServiceUrl/api/products/{$request->product_id}");

        if (!$userResponse->successful() || !$productResponse->successful()) {
            return response()->json(['error' => 'User or product not found'], 404);
        }

        $user = $userResponse->json();
        $product = $productResponse->json();

        // Ambil stok dari InventoryService
        $inventoryResponse = Http::get("$inventoryServiceUrl/api/inventories/{$product['id']}");

        if (!$inventoryResponse->successful()) {
            return response()->json(['error' => 'Inventory not found'], 404);
        }

        $inventory = $inventoryResponse->json();
        $currentStock = $inventory['stock'];

        if ($currentStock < $request->quantity) {
            return response()->json(['error' => 'Stock not sufficient'], 400);
        }

        // Kurangi stok
        $newStock = $currentStock - $request->quantity;
        Http::put("$inventoryServiceUrl/api/inventories/{$product['id']}", [
            'stock' => $newStock
        ]);

        // Simpan order
        $order = Order::create([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'product_id' => $product['id'],
            'product_name' => $product['name'],
            'product_price' => $product['price'],
            'quantity' => $request->quantity,
            'total' => $product['price'] * $request->quantity,
        ]);

        return response()->json($order, 201);
    }


    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order)
            return response()->json(['message' => 'Order not found'], 404);

        $order->update($request->only(['quantity', 'total']));
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order)
            return response()->json(['message' => 'Order not found'], 404);
        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }
}
