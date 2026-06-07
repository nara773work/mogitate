<?php

namespace Tests\Unit;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    protected $seed = true;

    public function test_update_request(): void
    {
        $request = new ProductRequest;
        $request->setMethod('PUT');
        
        $rules = $request->rules();

        $validData = [
            'name' => 'test',
            'price' => 120,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $validator = Validator::make($validData, $request->rules(), method_exists($request, 'messages') ? $request->messages() : []);
        $this->assertTrue($validator->passes());

        $invalidData = [
            'name' => '',
            'price' => 120,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 12000,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => -1,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 'いち',
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 120,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 12000,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => '',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());
    }

    public function test_register_request(): void
    {
        $request = new RegisterRequest;
        $rules = $request->rules();

        $validData = [
            'name' => 'test',
            'price' => 120,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $validator = Validator::make($validData, $request->rules(), method_exists($request, 'messages') ? $request->messages() : []);
        $this->assertTrue($validator->passes());

        $invalidData = [
            'name' => '',
            'price' => 120,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 12000,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => -1,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 'いち',
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 120,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [],
            'description' => 'test',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());

        $invalidData = [
            'name' => 'test',
            'price' => 12000,
            'image' => UploadedFile::fake()->image('test.png'),
            'season_ids' => [1, 3],
            'description' => '',
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(),
            method_exists($request, 'messages') ? $request->messages() : [], );
        $this->assertFalse($invalidValidator->passes());
    }
}
