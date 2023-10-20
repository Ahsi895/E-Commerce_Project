<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $primaryKey = "id";
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id', 'pro_id');
    }
}

