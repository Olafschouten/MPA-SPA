<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Products;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function getIndex()
    {
        echo 'Products' . '<br>';

        $products = Products::all();

        foreach ($products as $product) {
            foreach ($product->categories as $category) {
                echo $category->title . '<br>';
            }
        }

        echo '<br>' . 'Categories' . '<br>';

        $category = Categories::find(1);

        foreach ($category->products as $product1) {
            echo $product1->title . '<br>';
        }

//        return view('/welcome');
    }
}
