<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class,
            'category_product',
            'category_id',
            'product_id')->withTimestamps();
    }

    public static function getCategories()
    {
        return Category::all();
    }

    public static function getCategory($id)
    {
        return Category::find($id);
    }

    public static function getSpecificCategories($id)
    {
        return \DB::table('categories AS c')
            ->join('category_product', 'category_id', '=', 'c.id')
            ->select('c.id', 'c.title')
            ->where('category_product.product_id', $id)
            ->get();
    }
}
