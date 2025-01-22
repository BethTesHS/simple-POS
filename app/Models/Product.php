<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    // public function saleItem()
    // {
    //     return $this->hasMany(SaleItem::class, 'product_id', 'id');
    // }
}
