<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // Show welcome page
    public function getIndex()
    {
        return view('/welcome');
    }
}
