<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show()
    {
        $categories = \DB::table('categories')->get();

        return view('categories', [
            'categories' => $categories
        ]);
    }

    public function showItems($id)
    {
        $category = \DB::table('categories')->where('id', $id)->get();
        $products = \DB::table('products')->where('category_id', $id)->get();

        return view('showItem', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
