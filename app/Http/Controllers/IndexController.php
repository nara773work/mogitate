<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);

        return view('products/index', compact('products'));
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

        return view('products/search', compact('products'));
    }
}
