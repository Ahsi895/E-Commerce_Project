<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderItem;
use App\Http\Controllers\CustomerProduct;




class OrderController extends Controller
{
    public $customerProduct;

    public function __construct(CustomerProduct $customerProduct)
    {
        $this->customerProduct = $customerProduct;
    }
    public function saveOrder(Request $request)
    {
        $totalAmount = $request->input('totalAmount');
        $address = $request->input('address');
        $user_id = auth()->user()->user_id;

        $order = new Order();
        $order->user_id = $user_id;
        $order->address = $address;
        $order->amount = $totalAmount;
        $order->save();

        $cart = $this->customerProduct->getCartProducts();

        foreach ($cart as $product) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->order_id;
            $orderItem->pro_id = $product->pro_id;
            $orderItem->quantity = $product->quantity;
            $orderItem->save();
        }
        // dd($order->order_id);
        return redirect()->route('orderConfirmation', ['order_id' => $order->order_id]);
    }

    public function orderConfirmation()
    {
        $user_id =  auth()->user()->user_id;
        $order = Order::with('orderItems.product')->where('user_id', $user_id)->get();
        // dd($order);
        return view('CustomerPanel.orderConfirmation', compact('order'));
    }



    public function totalOrders()
    {
        $totalOrders = Order::count();
        // dd($totalOrders);
        return view('products.dashboard', ['totalOrders' => $totalOrders]);
    }
    public function totalRevenue()
    {
        $orders = Order::all();
        $totalRevenue = $orders->sum('amount');
        // dd($totalRevenue);
        return view('products.dashboard', compact('totalRevenue'));
    }

    public function viewOrders()
    {
        $orders = Order::all();
        return view('viewOrders', compact('orders'));
    }
    public function orderStatus(Request $request)
    {
        $orderID = $request->input('orderID');
        $status = $request->input('status');
        // dd($status);
        $order = Order::find($orderID);

        if (!$order) {
            return "Order not found";
        }

        $order->status = $status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }


}
