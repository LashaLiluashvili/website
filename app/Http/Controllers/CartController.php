<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        $cart = Cart::get();

        return view("cart", [
            "products" => $products,
            'purchases' => Auth::user()->purchases()->with("product.category")->latest()->get(),
            "categories"=>Category::all(["id","name"]),
            "carts"=>$cart
        ]);
    }
    public function store(Request $request, Product $product)
    {
        if(Auth::user()->balance>=$product["price"]) {

            //data save in database the best way.

            Auth::user()->carts()->create([
                "product_id" => $product["id"],
                "sold_price" => $product["price"],
            ]);


            return back()->with('success','Waiting Admin approve');

        }else{
            return "Faild, There is no enough Money";
        }

    }
}
