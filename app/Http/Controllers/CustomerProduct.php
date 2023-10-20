<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\DB;
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
        $ids = explode('_', request('ids'));
        $cart = new Cart;
        $cart->pro_id = $ids[0];
        $cart->user_id = $ids[1];
        $cart->save();
        return redirect('/');
    }
    public function CartList()
    {
        $user_id = Session::get('user')['user_id'];
        $products = DB::table('cart')
            ->join('products', 'cart.pro_id', '=', 'products.pro_id')
            ->select('products.*')
            ->where('cart.user_id', $user_id)
            ->get();
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
        $product_id = $request->input('pro_id');

        Cart::where('pro_id', $product_id)->delete();

        return redirect()->back()->with('success', 'Product removed from the cart.');
    }
    public function proceedToPayment()
    {
        $user = Auth::user(); 
        $cartProducts = Cart::with('product')->where('user_id', $user->user_id)->get();

        // return dd($user);
        return view('CustomerPanel.proceedToPayment', compact('user', 'cartProducts'));
    }



}