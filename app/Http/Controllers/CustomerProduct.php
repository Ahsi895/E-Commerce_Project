<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class CustomerProduct extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = Category::all();
        $products = Product::all();
        // print_r($category->toArray());exit;
        return view('dashboard', compact(array('category', 'products')));
    }
    public function viewProduct($id)
    {
        $product = Product::find($id);
        // print_r($product->toArray());die;
        return view('CustomerPanel.viewProduct', compact('product'));
    }
    public function search(Request $request)
    {
        $data = Product::where('pro_name', 'like', '%' . $request->input('query') . '%')
            ->orWhere('details', 'like', '%' . $request->input('query') . '%')
            ->get();
        return view('CustomerPanel.search', ['data' => $data]);
    }
    public function addToCart(Request $request)
    {
        $id = $request->input('product_id');
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity');
        $userId = auth()->user()->user_id;

        $userKey = 'user_cart_' . $userId;

        $cart = Cache::get($userKey, []);

        if (isset($cart[$id])) {
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

        Cache::put($userKey, $cart, now()->addHours(1));

        

        $success = 'Product added to the cart successfully!';
        return response()->json(['message' => $success]);
    }
    public function count()
    {
        $userId = auth()->user()->user_id;   
        $userKey = 'user_cart_' . $userId;
        $cart = Cache::get($userKey, []);
        $cartCount = count($cart);
        // dd($cartCount);
        return view('layouts.app', compact('cartCount'));
    }

    public function getCartProducts()
    {
        $userKey = 'user_cart_' . auth()->user()->user_id;
        $cart = Cache::get($userKey);

        if (empty($cart)) {
            $cart = [];
        }

        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('pro_id', $productIds)->get();

            foreach ($products as $product) {
                $product->quantity = $cart[$product->pro_id]['quantity'];
            }
        } else {
            $products = [];
        }

        return $products;
    }

    public function CartList()
    {
        $products = $this->getCartProducts();
        // dd($products);
        return view('CustomerPanel.CartList', compact('products'));
    }




    public function show($cat_id)
    {
        $category = Category::find($cat_id);

        if (!$category) {
            return redirect('/');
        }
        $products = Product::where('cat_id', $cat_id)->get();

        return view('CustomerPanel.category', compact('category', 'products'));
    }
    public function removeFromCart(Request $request)
    {
        if ($request->pro_id) {
            $userId = auth()->user()->user_id;

            $userKey = 'user_cart_' . $userId;

            $cart = Cache::get($userKey, []);

            if (isset($cart[$request->pro_id])) {
                unset($cart[$request->pro_id]);

                Cache::put($userKey, $cart, now()->addHours(1));

                session()->flash('success', 'Product removed successfully');
                return redirect('/CartList');
            }
        }
    }


    public function proceedToPayment()
    {
        $user = Auth::user();
        $products = $this->getCartProducts();
        return view('CustomerPanel.proceedToPayment', compact('user', 'products'));
    }



}