<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;



class OrderController extends Controller
{
    public function saveOrder(Request $request)
    {
        // $pro = $request->input('pro_id');
        // return $pro;
        // die;

        $user = auth()->user()->user_id;
        $cartProducts = Cart::where('user_id', $user)->pluck('pro_id')->all();


        $order = new Order();
        $order->user_id = auth()->user()->user_id;
        // $order->pro_id = auth()->user()->user_id;
        $order->products_id = json_encode($cartProducts);
        $order->address = $request->input('address');
        Cart::where('user_id', $user)->delete();
        $order->amount = $request->input('total');


        $order->save();
        return view('CustomerPanel.success');
    }
    public function orderHistory()
    {
        $user = auth()->user();
        $orderIds = Order::where('user_id', $user->user_id)->pluck('products_id');

        $orderedProducts = collect();

        foreach ($orderIds as $ids) {
            $productIds = json_decode($ids);
            echo $productIds;
            if (!empty($productIds)) {
                $products = Product::whereIn('pro_id', $productIds)->get();
                $orderedProducts = $orderedProducts->concat($products);
            }
        }

        return view('CustomerPanel.history', ['orderedProducts' => $orderedProducts]);
    }
    public function dashboard()
    {
        $totalOrders = Order::count(); 
        // dd($totalOrders);
        
        return view('products.dashboard', ['totalOrders' => $totalOrders]);
    }

}
