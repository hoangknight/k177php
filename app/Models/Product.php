<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
    
    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    // }
    
}
