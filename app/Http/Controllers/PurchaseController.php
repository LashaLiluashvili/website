<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{

    public function index()
    {

    }

    public function store(Request $request)
    {
        $carts = Auth::user()->carts;

        $totalPrice = $carts->sum('sold_price');

        DB::transaction(function () use ($totalPrice, $carts) {
            if (Auth::user()->balance >= $totalPrice) {

                // create user purchase
                $purchase = Auth::user()->purchases()->create([
                    "total_price" => $totalPrice,
                    "status" => "In Progress"
                ]);

                $carts->each(function ($cart) use ($purchase) {
                    $purchase->purchaseProducts()->create([
                        'product_id' => $cart->product_id,
                        'sold_price' => $cart->sold_price
                    ]);
                });

                Auth::user()->carts()->delete();

            } else {
                return "Faild, There is no enough Money";
            }
        });
        return redirect('/guest')->with('success', 'Waiting Admin approve');
    }
}

