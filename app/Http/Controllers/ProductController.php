<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Requests\ProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->with('category')->get();

        return view('admin', [
            "products" => $products,
        ]);
    }

    public function store(ProductRequest $request)
    {

        Product::create($request->validated());

        return back()->with('success', 'Product created successfully');
    }

    public function search(Request $request)
    {
//        dd($request->categories);

//        dd($request->all());

        $products = Product::when($request->search, function ($query, $searchText) {
            return $query->where(function ($query)use($searchText){
                $query->where('name', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchText . '%');
            });
        })->when($request->categories, function ($query, $categories) {

           return $query->whereIn('category_id',$categories);

        })->when($request->minPrice, function ($query, $minPrice) {
            return $query->where('price', '>=', $minPrice);
        })->when($request->maxPrice, function ($query, $maxPrice) {
            return $query->where('price', '<=', $maxPrice);
        })
            ->get();

        return view('search', compact('products'));
    }
}

