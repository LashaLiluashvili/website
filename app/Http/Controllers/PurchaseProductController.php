<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseProductController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request, Product $product)
    {

        dd($product->all());


        if (Auth::user()->balance >= $product["price"]) {

            Auth::user()->purchases()->create([
                "product_id" => $cart->product_id,
                "sold_price" => $cart->sold_price,
                "status" => "In Progress"
            ]);

            return back()->with('success', 'Waiting Admin approve');

        } else {
            return "Faild, There is no enough Money";
        }
    }
}
