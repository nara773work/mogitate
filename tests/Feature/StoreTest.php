<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

use App\Models\Season;
use App\Models\Product;

class StoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected $seed = true;

    public function test_detail(): void{
        $product = Product::first();
        $product->load('seasons');

        $response = $this->get('/products/detail/' . $product->id);
        $response->assertOk();

        if ($product) {
            $response->assertSee($product->image);
            $response->assertSee($product->name);
            $response->assertSee($product->price);
            $response->assertSee($product->description);

            foreach ($product->seasons as $season) {
            $response->assertSee((string)$season->id);

            $response->assertSee('checked');

            }
        }
    }

    public function test_register(): void
    {
        $response = $this->get('products/register');
        
        $response->assertOk();
        $response->assertViewIs('products.register');
        $response->assertSee('商品名を入力');
        $response->assertSee('値段を入力');
        $response->assertSee('商品の説明を入力');

        $response = $this->get('products');
        $response->assertOk();
    }

    public function test_store(): void
    {
        
        $product = [
            "name" => "test",
            "price"=>300,
            "season_ids"=>[1,4],
            "image"=>UploadedFile::fake()->image('test.png'),
            "description"=>"test"
        ];

        $response = $this->post('/products/store',$product);
        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            "name" => "test",
            "price"=>300,
            "description"=>"test"
        ]);

        $product_register = Product::where('name', 'test')->first();


        foreach ($product["season_ids"] as $season_ids) {
            $this->assertDatabaseHas('product_season', [
                'product_id' => $product_register->id,
                'season_id' => $season_ids,
            ]);
    }

    }
}
