<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbandonedCart;
use App\Models\Product;
use App\Models\User;

use Illuminate\Support\Facades\Cache;


class AbandonedCartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (auth()->check()) {
            $user_id = auth()->user()->user_id;
            // $quantity = $request->input('quantity');

            $userKey = 'user_cart_' . auth()->user()->user_id;
            $product_ids = Cache::get($userKey);

            if (count($product_ids) == 0) {
                return redirect()->route('/')->with('error', 'No products selected.');
            }
            // dd($product_ids);

            foreach ($product_ids as $product_id) {

                $cartItem = AbandonedCart::where('user_id', $user_id)
                    ->where('product_id', $product_id['id'])
                    ->first();
                // dd($cartItem);
                $quantity = $product_id['quantity'];
                if (!empty($cartItem)) {
                    $cartItem->quantity = $cartItem->quantity + $quantity;
                    $cartItem->save();
                } else {

                    $cartItem1 = new AbandonedCart();
                    $cartItem1->user_id = $user_id;
                    $cartItem1->product_id = $product_id['id'];
                    $cartItem1->quantity = $quantity;
                    $cartItem1->save();
                }
            }

            return 'success';
        } else {
            return 'unsuccess';
        }
    }


    public function showAbandonedCart()
    {
        if (auth()->check()) {
            $user_id = auth()->user()->user_id;
            $abandonedCarts = AbandonedCart::with('product')
                ->get();
            // dd($abandonedCarts);
            return view('abandoned_cart', compact('abandonedCarts'));
        } else {
            return 'unsuccess';
        }
    }
    public function viewAbandonedCart(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        // dd($user);
        $productId = $request->input('product_id');

        $abandonedCart = AbandonedCart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        // dd($abandonedCart);
        $product = Product::find($abandonedCart->product_id);
        // dd($product);

        return view('viewAbandoned_cart', compact('user', 'product', 'abandonedCart'));
    }
    public function totalAbandonedCart()
    {
        $totalAbandonedCart = AbandonedCart::count();
        // dd($totalOrders);
        return view('products.dashboard', ['totalAbandonedCart' => $totalAbandonedCart]);
    }



    public function cartshownToCustomer(Request $request)
    {
        if (auth()->check()) {
            $user_id = auth()->user()->user_id;

            $carts = AbandonedCart::where('user_id', $user_id)->get();
            $abandonedCartProducts = [];

            foreach ($carts as $cart) {
                $product = Product::find($cart->product_id);
                if ($product) {
                    $abandonedCartProducts[] = [
                        'product' => $product,
                        'quantity' => $cart->quantity
                    ];
                }
            }
            foreach($abandonedCartProducts as $abandonedCartProduct){
            $id[] = $abandonedCartProduct['product']->pro_id;
            $quantity = $abandonedCartProduct['quantity'];
            }
            // dd($id);
            $userKey = 'user_cart_' . $user_id;
            $cart = Cache::get($userKey, []);
            foreach($id as $id){
            if (isset($abandonedCartProducts[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    "id" => $id,
                    "name" => $product->pro_name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "details" => $product->details,
                    "image" => $product->image
                ];
            }
        }

        Cache::put($userKey, $cart, now()->addHours(1));
        // Cache::put("user_cart_" . auth()->user()->user_id, $abandonedCartProducts, 1000);
            $cachedData = Cache::get("user_cart_" . auth()->user()->user_id);
            // dd($cachedData);
            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['status' => false], 403);
        }
    }

    public function removeFromAbandonedCart(Request $request)
    {
        $user_id = Auth()->User()->user_id;
        $productId = $request->input('pro_id');
        // dd($productId);
        $removeProduct = AbandonedCart::where([['user_id', $user_id], ['product_id', $productId]])->delete();
        if ($removeProduct) {
            return back()->with('success', 'Item removed from Cart successfully!');
        } else {
            return back()->with('error', 'Error occurred while removing the item, please try again later!');
        }
    }





    public function updateCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        $quantity = $request->input('quantity');

        $cartItem = AbandonedCart::find($cartItemId);

        if ($cartItem) {
            // Update the quantity
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return redirect()->route('cart.view')->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = AbandonedCart::find($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }

}
