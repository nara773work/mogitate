<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $seed = true;

    public function test_index(): void
    {
        $products = Product::all();
        $response = $this->get('products');

        $response->assertOk();
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');

        $response->assertViewHas('products', function ($products) {
            return $products->count() === 6;
        });

        $response = $this->get('products?page=2');
        $response->assertViewHas('products', function ($products) {
            return $products->count() === 4;
        });

    }

    public function test_index_show(): void{
        $response = $this->get('products');
        $product = Product::first();

        if ($product) {
            $response->assertSee($product->image);
            $response->assertSee($product->name);
            $response->assertSee($product->price);
        }

    }

    public function test_search(): void
    {
        $products = Product::all();
        $response = $this->get('products/search');

        $response->assertOk();
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
    }

    public function test_detail(): void
    {
        $products = Product::first();
        $seasons = Season::all();
        $response = $this->get('products/detail/'.$products->id);

        $response->assertOk();
        $response->assertViewIs('products.detail');
        $response->assertViewHas('product');
        $response->assertViewHas('seasons');
    }
}
