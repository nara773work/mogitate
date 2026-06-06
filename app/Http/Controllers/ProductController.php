<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\RegisterRequest;

class ProductController extends Controller
{
    public function index()
    {
        $seasons= Season::all();
        $products = Product::with('seasons')->paginate(6);

        return view('/products/index', compact('products'));
    }

    public function search(Request $request)
    {
        $name = $request->input('name', '');
        $sort = $request->input('sort', '');

        if($sort === 'clear'){
            $sort = "";
        }

        $query = Product::query();

        if (! empty($name)) {
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if (! empty($sort)) {
            $query->orderBy('price', $sort);
        }
        
        $products = $query->paginate(6);

        return view('/products/index', compact('products'));
    }

    public function show(Request $request,$id)
    {
        $seasons = Season::all();
        $product = Product::with('seasons')->find($id);
        return view('products/detail',compact('product','seasons'));
    }
    public function register(){
        $seasons = Season::all();
        return view('products/register',compact('seasons'));
    }

    public function store(RegisterRequest $request){
        $seasons = Season::all();
        $image = $request->file('image')->store('strang','public');
        $imageUrl = \Storage::url($image);
        $product = Product::create([
            "name"=>$request->name,
            "price"=>$request->price,
            "image"=>$imageUrl,
            "description"=>$request->description
        ]);
        if ($request->has('season_ids')) {
        $product->seasons()->attach($request->season_ids);
    }
        return redirect('/products');
    }

    public function update(ProductRequest $request,$id){
        $product = Product::findOrFail($id);
        $image = $request->file('image')->store('strang','public');
        $imageUrl = $request->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('strang','public');
            $imageUrl = \Storage::url($image);
        }
        $product->update([
        'name'        => $request->input('name'),
        'price'       => $request->input('price'),
        'image'       => $imageUrl,
        'description' => $request->input('description'),
    ]);
        if ($request->has('season_ids')) {
        $product->seasons()->sync((array)$request->input('season_ids'));
    } 
        return redirect('/products');
    }

    public function delete(Request $request,$id){
        $product = Product::findOrFail($id);
        $product->delete($request->id);
        return redirect('/products');
    }
}
