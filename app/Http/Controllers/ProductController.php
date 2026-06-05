<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

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
        $id = $request->input('id');
        $seasons = Season::all();
        $product = Product::with('seasons')->find($id);
        return view('products/detail',compact('product','seasons'));
    }

    public function update(ProductRequest $request,$id){
        $product = Product::findOrFail($id);
        $image = $request->file('image')->store('public/strage');
        $imageUrl = \Storage::url($image);
        $product->update([
        'name'        => $request->input('name'),
        'price'       => $request->input('price'),
        'image'       => $imageUrl,
        'description' => $request->input('description'),
    ]);
        if ($request->has('season_id')) {
        $product->seasons()->sync((array)$request->input('season_id'));
    }
 
        return redirect('/products');
    }

    public function create(ProductRequest $request,$id){
        $products = Product::create([
            "name"=>$request->name,
            "price"=>$request->price,
            "image"=>$request->image,
            "description"=>$request->description
        ]);
        if ($request->has('season_id')) {
        $product->seasons()->attach($request->seasons);
    }
        return redirect('products/index', compact('products'));
    }

    public function delete(Request $request,$id){
        $product = Product::findOrFail($id);
        $product->delete($request->id);
        return redirect('/products');
    }
}
