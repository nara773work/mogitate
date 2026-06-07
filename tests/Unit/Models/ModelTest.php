<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Models\Season;

class ModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;
    protected $seed = true;

    public function test_prducts_belongsTo_seasons(): void
    {
        $product = Product::first();

        $this->assertCount(2, $product->seasons);
    }

    public function test_seasons_belongsTo_prducts(): void{
        $season = Season::first();

        $this->assertCount(3, $season->products);
    }

}
