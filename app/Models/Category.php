<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = "category";
    protected $primaryKey = "cat_id";

    public function product()
    {
        return $this->hasOne(Product::class, 'cat_id', 'cat_id');
    }
}

