<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = "products";
    protected $primaryKey = "pro_id";

    use SoftDeletes;
    protected $fillable = [
        'pro_name',
        'price',
        'stock',
        'details',
        'cat_id',
        'image'
    ];
    function setProNameAttribute($value)
    {
        $this->attributes['pro_name'] = ucwords($value);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'pro_id', 'pro_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
