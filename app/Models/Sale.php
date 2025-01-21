<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = "sales";

    public function saleItem()
    {
        return $this->hasMany(SaleItem::class, 'sale_id', 'id');
    }
}
