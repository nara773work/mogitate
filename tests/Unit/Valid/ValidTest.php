<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Season;
use App\Models\Product;

class ValidTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;
    protected $seed = true;

    public function test_UpdateRequest(): void
    {
        $request = new ProductRequest();
        $rules = $request->rules(); 

        $validData=[
            "name" => "test",
            "price"=> 120,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $validator = Validator::make($validData, $request->rules(),method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertTrue($validator->passes());

        $invalidData=[
            "name" => "",
            "price"=> 120,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

         $invalidData=[
            "name" => "test",
            "price"=> 12000,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> -1,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> "いち",
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> 120,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> 12000,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>""
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());
    }



    public function test_RegisterRequest(): void{
        $request = new RegisterRequest();
        $rules = $request->rules(); 
        
        $validData=[
            "name" => "test",
            "price"=> 120,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $validator = Validator::make($validData, $request->rules(),method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertTrue($validator->passes());

        $invalidData=[
            "name" => "",
            "price"=> 120,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

         $invalidData=[
            "name" => "test",
            "price"=> 12000,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> -1,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> "いち",
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> 120,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[],
            "description"=>"test"
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());

        $invalidData=[
            "name" => "test",
            "price"=> 12000,
            "image" => UploadedFile::fake()->image('test.png'),
            "season_ids"=>[1,3],
            "description"=>""
        ];
        $invalidValidator = Validator::make($invalidData, $request->rules(), 
            method_exists($request, 'messages') ? $request->messages() : [],);
        $this->assertFalse($invalidValidator->passes());
    }  

}
