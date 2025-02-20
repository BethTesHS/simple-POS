<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'productName', 'purchaseType', 'quantity'];
    protected $table = "stockHistory";

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope('latestFirst', function ($query) {
    //         $query->latest(); // Orders by `created_at DESC`
    //     });
    // }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
