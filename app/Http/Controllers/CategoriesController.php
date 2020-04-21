<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show()
    {
        $tests = \DB::table('categories')->get();

        return view('categories', [
            'tests' => $tests
        ]);
    }
}
