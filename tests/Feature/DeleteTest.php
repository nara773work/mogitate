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
        $seasonId = $product->seasons()->first()?->id;

        $response = $this->delete('/products/'.$product->id.'/delete');

        $response->assertStatus(302);

        $response->assertRedirect('/products');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);

        if ($seasonId) {
            $this->assertDatabaseMissing('product_season', [
                'product_id' => $product->id,
                'season_id' => $seasonId
            ]);
    }}
}
