<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbandonedCart extends Model
{
    protected $table = "abandoned_carts";
    protected $primaryKey = "id";
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'pro_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    

}
