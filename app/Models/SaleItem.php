<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sale_items';

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sales()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }
}
