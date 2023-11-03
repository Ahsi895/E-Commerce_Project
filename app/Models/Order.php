<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'products_id',
        'user_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'pro_id', 'products_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }




}
