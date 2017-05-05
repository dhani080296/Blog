<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests;
use App\Post;
class CategoriesController extends BackendController
{
    

    public function index(){
    	$categories=Category::with('posts')->orderBy('title')->paginate($this->limit);
    	$categoriesCount=Category::count();
    	return view("backend.categories.index",compact('categories','categoriesCount'));
    }
    public function create(){
    	$category= new Category();
    	return view("backend.categories.create",compact('category'));
    }
    public function store(Requests\categoryStoreRequest $request){
    Category::create($request->all());
    return redirect("/backend/categories")->with("message","New category was created successfully!");
    }
    public function edit($id){
    $category= category::findOrFail($id);
    return view("backend.categories.edit",compact('category'));	
    }
    public function update(Requests\categoryUpdateRequest $request,$id){
    Category::findOrFail($id)->update($request->all());
    return redirect("/backend/categories")->with("message","Category was Updated successfully!");
    }
   public function destroy(Requests\categoryDestroyRequest $request,$id){
    Post::withTrashed()->where('category_id',$id)->update(['category_id'=>config('cms.default_category_id')]);
    $category =Category::findOrFail($id);

    $category->delete();
    return redirect("/backend/categories")->with("message","Category was Deleted Successfully!");
    }
}
