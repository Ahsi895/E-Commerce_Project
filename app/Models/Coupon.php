<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $primaryKey = 'id';
    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }
    public function discount($total)
    {
        // Find the coupon by its code
        $coupon = $this->findByCode(session()->get('coupon')['name']);

        if (!$coupon) {
            return 0; // Or handle this case appropriately
        }

        if ($coupon->type == 'fixed') {
            return $coupon->value;
        } elseif ($coupon->type == 'percent') {
            return ($coupon->percent_off / 100) * $total;
        } else {
            return 0;
        }
    }

}
