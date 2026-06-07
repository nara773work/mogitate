<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $seed = true;

    public function test_delete(): void
    {
        $product = Product::first();

        $response = $this->delete('/products/'.$product->id.'/delete');

        $response->assertStatus(302);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
