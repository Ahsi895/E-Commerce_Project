<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        // print_r($category->toArray());exit;
        return view('dashboard', compact('category'));
    }
}

