<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pro_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'details' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:category,cat_id',
        ]);


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $name);
            $imagePath = $destinationPath . "/" . $name;
        } else {
            $imagePath = null;
        }
        Product::create([
            'pro_name' => $request->input('pro_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'details' => $request->input('details'),
            'cat_id' => $request->input('category'),
            'image' => $imagePath,
        ]);
        

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'pro_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'details' => 'required',
            'category' => 'required|exists:category,cat_id',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $name);
            $imagePath = $destinationPath . "/" . $name;
        } else {
            $imagePath = null;
        }
        $product->update([
            'pro_name' => $request->input('pro_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'details' => $request->input('details'),
            'cat_id' => $request->input('category'),
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}