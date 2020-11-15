<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(3);
        return view('backend.products.listproduct', compact('products'));
    }
    public function create(){
        $categories = Category::all();
        return view('backend.products.addproduct', compact('categories'));
    }
    public function store(AddProductRequest $request){
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->slug = Str::slug($request->name,'-');
        $product->price = $request->price;
        $product->featured = $request->featured;
        $product->state = $request->state;
        $product->categories_id = $request->category;
        $product->info = $request->info;
        $product->describer = $request->describe;

        if($request->hasFile('img')){
            $file = $request->img;
            $file_name = Str::slug($request->name,'-').'.'.$file->getClientOriginalExtension();
            $path = public_path().'/uploads';
            // Upload ảnh lên server
            $file->move($path, $file_name);
            // Lưu tên ảnh vào CSDL
            $product->image = $file_name;
        }
        $product->save();
        return redirect()->route('product.index')->with('success','Thêm sản phẩm thành công');
    }
    public function edit($id){
        $categories = Category::all();
        $product = Product::find($id);
        return view('backend.products.editproduct', compact('categories','product'));
    }
    public function update(EditProductRequest $request, $id){
        $product = Product::find($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->slug = Str::slug($request->name,'-');
        $product->price = $request->price;
        $product->featured = $request->featured;
        $product->state = $request->state;
        $product->categories_id = $request->category;
        $product->info = $request->info;
        $product->describer = $request->describe;

        if($request->hasFile('img')){
            $file = $request->img;
            $file_name = Str::slug($request->name,'-').'.'.$file->getClientOriginalExtension();
            $path = public_path().'/uploads';
            // Upload ảnh lên server
            $file->move($path, $file_name);
            // Xóa ảnh cũ
            unlink($path.'/'.$product->image);
            // Lưu tên ảnh vào CSDL
            $product->image = $file_name;
            // Khi thay đổi ảnh, thì phải xóa ảnh cũ trong thư mục uploads
        }else{
            $product->image = $product->image;
        }
        $product->save();
        return redirect()->route('product.index')->with('success','Sửa sản phẩm thành công');
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success','Xóa sản phẩm thành công');
    }
}
