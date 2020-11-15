<?php

namespace App\Http\Controllers\Site\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function shop(){
        $data['products'] = Product::orderBy('id','desc')->paginate(6);
        $data['categories'] = Category::all();
        return view('frontend.product.shop', $data);
    }
    public function filter(Request $request){
        $start = $request->start;
        $end = $request->end;
        $data['products'] = Product::whereBetween('price',[$start,$end])->orderBy('id','desc')->paginate(6);
        $data['categories'] = Category::all();
        $data['products']->appends(['start' => $start]);
        $data['products']->appends(['end' => $end]);
        return view('frontend.product.shop', $data);
    }
    public function detail($slug){
        $data['product'] = Product::where('slug',$slug)->first();
        $data['new_products'] = Product::orderBy('id','desc')->take(4)->get();
        return view('frontend.product.detail',$data);
    }
}
