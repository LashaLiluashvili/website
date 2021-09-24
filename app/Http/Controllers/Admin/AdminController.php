<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Purchase;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin', ["products" => $products,

            'purchases' => Purchase::with("product", "user")->latest()->get()]);
    }

    public function store(ProductRequest $request)
    {

        Product::create($request->validated());

        return back()->with('success', 'Product created successfully');
    }


    public function edit(int $id)
    {
        $product=Product::findOrFail($id);

        return view('products.edit',["product" => $product]);
    }

    public function update(ProductRequest $request, int $id)
    {
        $product=Product::findOrFail($id);

        $product->update($request->validated());

        return redirect('/admins');
    }

    public function confirm(Purchase $purchase)
    {
        if ($purchase->status!="Confirmed") {
            $purchase->update([
                "confirmed" => 1,
                "status" => 'Confirmed'
            ]);
            $purchase->user->decrement("balance", $purchase->sold_price);
        }else{
            return back()->with("Its already confirmed");
        }

        return back()->with("Success");
    }

    public function destroy(int $id)
    {
        $product=Product::findOrFail($id);

        $product->delete();

        return back();
    }
}
