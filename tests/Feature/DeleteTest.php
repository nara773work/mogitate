<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Season;
use App\Models\Product;

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
