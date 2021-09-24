<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;

    protected $fillable=['purchase_id','product_id','sold_price'];

    public function purchaseProduct()
    {
        return $this->hasMany(Purchase::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
