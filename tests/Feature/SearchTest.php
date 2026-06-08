<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $seed = true;

    public function test_search(): void
    {
        $validData = [
            'name' => 'キウイ',
        ];
        $response = $this->get('/products/search?name=キウイ');
        $response->assertStatus(200);
        $response->assertSee('キウイ');
        $response->assertDontSee('ストロベリー');

        $validData = [
            'name' => 'ウ',
        ];
        $response = $this->get('/products/search?name=ウ');
        $response->assertStatus(200);
        $response->assertSee('キウイ');
        $response->assertDontSee('ストロベリー');
    }

    public function test_sort(): void
    {
        $validData = [
            'sort' => 'ASC',
        ];
        $response = $this->get('/products/search?sort=ASC');
        $response->assertStatus(200);
        $response->assertSeeInOrder([600, 700, 800]);

        $validData = [
            'sort' => 'DESC',
        ];
        $response = $this->get('/products/search?sort=DESC');
        $response->assertStatus(200);
        $response->assertSeeInOrder([1400, 1200, 1100]);

        $validData = [
            'sort' => 'ASC',
            'name' => 'ウ',
        ];
        $response = $this->get('/products/search?name=ウ&sort=ASC');
        $response->assertStatus(200);
        $response->assertSeeInOrder([800, 1100]);
        $response->assertSee('キウイ');
        $response->assertSee('ブドウ');
        $response->assertDontSee('ストロベリー');
    }
}
