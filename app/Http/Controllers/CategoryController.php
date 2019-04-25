<?php

namespace App\Http\Controllers;
use App\Category2;
use Illuminate\Http\Request;
use DB;
class CategoryController extends Controller
{
    public function index()
    {
    	return view('admin.category.add-category');
    }

    public function saveCategory(Request $request)
    {

        $category = new Category2();
    	
    	//Category2::create($request->all());
        $productImage = $request->file('product_image');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'product-image/';
       $ImageUrl = $directory.$imageName;
        $productImage->move($directory,$imageName);
        
     //   $category->id=$request->id;
        
        $category-> category_name = $request -> category_name;
        $category-> category_description = $request -> category_description;
        $category-> product_image = $ImageUrl;
        $category-> publication_status = $request -> publication_status;
        $category->save();
        //return $imageName;
    	return redirect('/category/add')->with('message','category info saved');
    }

    public function manageCategory()
    {
    	$categories = Category2::all();
    	
    	return view('admin.category.managecategory',['categories'=>$categories]);
    }

    public function unpublishedCategory($id)
    {
    	$category = Category2::find($id);
    	$category->publication_status = 0;
    	$category->save();
    	return redirect('/category/manage')->with('message','Category info unpublished');
    }
     public function publishedCategory($id)
    {
    	$category = Category2::find($id);
    	$category->publication_status = 1;
    	$category->save();
    	return redirect('/category/manage')->with('message','Category info unpublished');
    }
    public function editCategory($id)
    {
    	$category = Category2::find($id);
    	return view('admin.category.edit-category',['category'=>$category]);
    }

    public function updateCategory(Request $request)
    {
    	$category = Category2::find($request->category_id);
    	$category-> category_name = $request -> category_name;
    	$category-> category_description = $request -> category_description;
    	$category-> publication_status = $request -> publication_status;
    	$category->save();

    	return redirect('/category/manage')->with('message','Category info updated');

    }

    public function deleteCategory($id)
    {
    	$category = Category2::find($id);
    	$category->delete();
    	return redirect('/category/manage')->with('message','Category info updated');
    }


    
}
