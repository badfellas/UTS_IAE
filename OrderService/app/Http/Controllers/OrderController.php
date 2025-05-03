<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller {
    public function index() {
        return response()->json(Order::all());
    }

    public function show($id) {
        $order = Order::find($id);
        if (!$order) return response()->json(['message' => 'Order not found'], 404);
        return response()->json($order);
    }

    public function store(Request $request) {
        $user = Http::get('http://localhost:8001/api/users/'.$request->user_id)->json();
        $product = Http::get('http://localhost:8002/api/products/'.$request->product_id)->json();

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

    public function update(Request $request, $id) {
        $order = Order::find($id);
        if (!$order) return response()->json(['message' => 'Order not found'], 404);

        $order->update($request->only(['quantity', 'total']));
        return response()->json($order);
    }

    public function destroy($id) {
        $order = Order::find($id);
        if (!$order) return response()->json(['message' => 'Order not found'], 404);
        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }
}
