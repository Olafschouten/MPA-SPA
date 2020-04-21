<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show()
    {
        $products = \DB::table('products')->get();

        return view('products', [
            'products' => $products
        ]);
    }

    public function showProducts($id)
    {
        $products = \DB::table('products')->where('id', $id)->get();

        return view('showProduct', [
            'products' => $products
        ]);
    }
}
