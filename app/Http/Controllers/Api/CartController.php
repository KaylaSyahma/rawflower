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
         $userId = Auth::id();

    if (!$userId) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    
        // line ini sampe 28 buat ngefilter user jadi tiap user cart nya beda beda
        // hindarin firstOrCreate() waktu pake relasi yang butuh with() atau ada kemungkinan kondisi kompleks. Karena dia bisa ngeluarin data user lain
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->with('items.product.productImages', 'items.product.category')
            ->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'status'  => 'active'
            ]);
            $cart->load('items.product.productImages', 'items.product.category');
        }

        return response()->json([
            'id' => $cart->id,
            'items' => $cart->items->map(function ($item) {
                $product = $item->product;
                $images = $product->productImages->pluck('image')->map(function ($image) {
                    return asset('storage/' . $image);
                });

                return [
                    'id'       => $item->id,
                    'product'  => [
                        'id'          => $product->id,
                        'category'      => [
                            'id'   => $product->category->id,
                            'name' => $product->category->name,
                        ],
                        'name'        => $product->name,
                        'slug'        => $product->slug,
                        'description' => $product->description,
                        'original_price' => $product->original_price,
                        'quantity'    => $product->quantity,
                        'popular'     => $product->popular,
                        'status'      => $product->status,
                        'images'      => $images, // cuma ini yang dimunculin dari relasi
                    ],
                    'quantity' => $item->quantity,
                    'price'    => $item->price,
                    'subtotal' => $item->quantity * $item->price,
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

        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'status'  => 'active'
            ]);
        }

        $product = Product::findOrFail($request->product_id);

        $item = $cart->items()->firstOrNew(
            ['product_id' => $product->id]
        );
        $item->quantity = ($item->exists ? $item->quantity : 0) + $request->quantity;
        $item->price    = $product->original_price;
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