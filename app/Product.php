<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class,
            'category_product',
            'product_id',
            'category_id')->withTimestamps();
    }

    public static function getProducts()
    {
        return \DB::table('products')
            ->get();
    }

    public static function getProduct($id)
    {
        return \DB::table('products AS p')
            ->where('p.id', $id)
            ->select('p.id', 'p.title', 'p.description', 'p.price', 'p.quantity')
            ->get();
    }

    public static function getSpecificProduct($id)
    {
        return \DB::table('products AS p')
            ->join('category_product', 'category_id', '=', 'p.id')
            ->select('p.id', 'p.title', 'p.description', 'p.price')
            ->where('category_product.product_id', $id)
            ->get();
    }
}
