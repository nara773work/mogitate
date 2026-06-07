<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    protected $seed = true;

    public function test_products_belongs_to_seasons(): void
    {
        $product = Product::first();

        $this->assertCount(2, $product->seasons);
    }

    public function test_seasons_belongs_to_products(): void
    {
        $season = Season::first();

        $this->assertCount(3, $season->products);
    }
}
