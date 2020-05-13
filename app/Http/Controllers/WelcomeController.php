<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function getIndex()
    {
        $product = Products::find(1);
        $product->categories()->sync([1]);

        foreach ($product->categories as $category)
        {
            echo $category->title;
            echo $category->name;
        }

//        return view('/welcome');
    }
}
