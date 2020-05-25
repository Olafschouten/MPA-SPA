<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Products;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // Show welcome page
    public function getIndex()
    {
        return view('/welcome');
    }
}
