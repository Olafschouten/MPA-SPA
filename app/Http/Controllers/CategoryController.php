<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    // Gets all categories
    public function show()
    {
        return view('categories', [
            'categories' => Category::getCategories()
        ]);
    }

    // Gets category with products
    public function showItems($id)
    {
        return view('showItem', [
            'category' => Category::getCategory($id),
            'products' => Product::getSpecificProduct($id),
        ]);
    }
}
