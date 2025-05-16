<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // GET /api/cart
    public function index()
    {
        $cart = Cart::with('items.product')
            ->firstOrCreate(
                ['user_id' => Auth::id(), 'status' => 'active']
            );

        return response()->json([
            'id'    => $cart->id,
            'items' => $cart->items->map(function ($item) {
                return [
                    'id'        => $item->id,
                    'product'   => $item->product,
                    'quantity'  => $item->quantity,
                    'price'     => $item->price,
                    'subtotal'  => $item->quantity * $item->price,
                ];
            }),
        ]);
    }

    // POST /api/cart/add
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        $product = Product::findOrFail($request->product_id);

        $item = $cart->items()->firstOrNew(
            ['product_id' => $product->id]
        );
        $item->quantity = ($item->exists ? $item->quantity : 0) + $request->quantity;
        $item->price    = $product->price;
        $item->save();

        return response()->json(['message' => 'Product added to cart']);
    }

    // PATCH /api/cart/update/{itemId}
    public function update(Request $request, $itemId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $item = CartItem::where('id', $itemId)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id())->where('status', 'active'))
            ->firstOrFail();

        $item->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart updated']);
    }

    // DELETE /api/cart/remove/{itemId}
    public function remove($itemId)
    {
        $item = CartItem::where('id', $itemId)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id())->where('status', 'active'))
            ->firstOrFail();
        $item->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }

    // POST /api/cart/checkout
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        $cart->update(['status' => 'checked_out']);

        return response()->json(['message' => 'Checkout complete']);
    }
}
