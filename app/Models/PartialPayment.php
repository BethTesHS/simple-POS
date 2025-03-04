<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartialPayment extends Model
{
    use HasFactory;

    protected $table = "partialPayments";

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
