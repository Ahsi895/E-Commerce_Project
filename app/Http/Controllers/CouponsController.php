<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponsController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            return redirect()->route('/proceedToPayment')->withErrors(['Invalid coupon code.']);
        }

        $totalAmount = $request->input('totalAmount');
        // $coupon = $this->findByCode(session()->get('coupon')['name']);

        
        
        $discount = ($coupon->percent_off / 100) * $totalAmount;
        
        $newTotal = $totalAmount - $discount;
        // dd($newTotal);
        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $discount,
            'newTotal' => $newTotal
        ]);

         
        // session()->put('coupon', [
        //     'newTotal' => $newTotal
        // ]);
        // dd($newTotal);
        return view('CustomerPanel.proceedToPayment', compact('newTotal'));
    }








    public function destroy()
    {
        return 'hello';
    }
}
