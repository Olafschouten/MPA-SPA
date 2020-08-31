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

    // Decrement quantity by product
    public static function decrementQuantity($id, $qty)
    {
        return \DB::table('products')
            ->where('id', $id)
            ->decrement('quantity', $qty);
    }

    // Increment quantity by product
    public static function incrementQuantity($id, $qty)
    {
        return \DB::table('products')
            ->where('id', $id)
            ->increment('quantity', $qty);
    }

    // Check if there are enough items left in de db
    public static function checkQuantity($id)
    {
        return \DB::table('products')
            ->where('id', $id)
            ->get();
    }
}
