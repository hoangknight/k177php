<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
    	$categories = Category::all();
        return view('backend.categories.category', compact('categories'));
	}
	
	public function detail($id){
		$category = Category::find($id);
		$product_id = [1,5,6];
		$category->products()->sync($product_id);
	}


    public function store(AddCategoryRequest $request){
    		$category = new Category;
    		$category->name = $request->name;
    		$category->parent = $request->parent;
			$category->slug = Str::slug($request->name,'-');
			$category->save();
		return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công');
    }
    public function edit($id){
    	$data['categories'] = Category::all();
    	$data['category'] = Category::find($id);
        return view('backend.categories.editcategory', $data);
    }
    public function update(EditCategoryRequest $request, $id){
    		$category = Category::find($id);
    		$category->name = $request->name;
    		$category->parent = $request->parent;
			$category->slug = Str::slug($request->name,'-');
			$category->save();
		return redirect()->route('category.index')->with('success', 'Sửa danh mục thành công');
    }

    public function delete($id){
    	$category = Category::find($id);
    	$category->delete();
		return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }
}
