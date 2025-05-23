<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_cart_creates_cart_item()
    {
        // 1. Buat user & product dummy
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // 2. Authenticate via Sanctum
        $this->actingAs($user, 'sanctum');

        // 3. Panggil endpoint add-to-cart
        $response = $this->postJson('/api/cart/add', [
            'product_id' => $product->id,
            'quantity'   => 3,
        ]);

        $response->assertStatus(200);

        // 4. Pastikan record-nya ada di database
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity'   => 3,
            'price'      => $product->original_price,
        ]);
    }
}
