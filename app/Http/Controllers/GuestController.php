<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('guest', [
            "products" => $products,
            'purchases' => Auth::user()->purchases()->with("product.category")->latest()->get(),
            "categories"=>Category::all(["id","name"])
        ]);
    }

    public function cancel(Purchase $purchase)
    {

        if ($purchase->status != "Canceled") {
            $purchase->update([
                $purchase->status = 'Canceled',
            ]);

            $purchase->user->increment("balance", $purchase->sold_price);
        }

        return back()->withErrors("Failed");

    }
}
