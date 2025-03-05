<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $guarded = [];

    // Default query ordering (Latest first)
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('latestFirst', function ($query) {
            $query->latest(); // Orders by `created_at DESC`
        });
    }

    public function salesDetail()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
