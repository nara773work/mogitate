<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $seed = true;

    public function test_update(): void
    {

        $product = Product::first();
        $product_update = [
            'name' => 'test',
            'price' => 600,
            'season_ids' => [1],
            'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
        ];
        $response = $this->put('/products/'.$product->id.'/update', $product_update);

        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'name' => 'test',
            'price' => 600,
            'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $product_update_db = Product::where('name', 'test')->first();
        foreach ($product_update['season_ids'] as $season_ids) {
            $this->assertDatabaseHas('product_season', [
                'product_id' => $product_update_db->id,
                'season_id' => $season_ids,
            ]);
        }

        $product_update_img = [
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'season_ids' => $product->seasons->pluck('id')->toArray(),
            'image' => UploadedFile::fake()->image('test_update.png'),
        ];

        $response = $this->put('/products/'.$product->id.'/update', $product_update_img);
        $product_update_img_db = Product::find($product->id);

        $this->assertNotNull($product_update_img_db->image);

        $realPath = str_replace('storage/', '', $product_update_img_db->image);
        Storage::disk('public')->assertExists($realPath);

        if (Storage::disk('public')->exists($realPath)) {
            Storage::disk('public')->delete($realPath);
        }
    }
}
