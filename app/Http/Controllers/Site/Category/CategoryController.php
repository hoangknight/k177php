<?php

namespace App\Http\Controllers\Site\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
   public function index($cate_slug){
        $data['products'] = Category::where('slug',$cate_slug)->first()->products()->paginate(6);
        $data['categories'] = Category::all();
        return view('frontend.product.shop', $data);
   }
}
