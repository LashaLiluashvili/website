<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purchase::all()->each(function ($purchase) {

            $purchase->purchaseProducts()->create([
                'product_id' => $purchase->product_id,
                'sold_price' => $purchase->sold_price,
            ]);
        });
    }


}
