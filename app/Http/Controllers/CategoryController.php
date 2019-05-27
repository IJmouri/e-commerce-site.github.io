<?php

namespace App\Http\Controllers;
use App\Category2;
use Illuminate\Http\Request;
use DB;
use Image;
class CategoryController extends Controller
{
    public function index()
    {
    	return view('admin.category.add-category');
    }

    protected function productInfoValidate($request)
    {
        $this->validate($request,[
            'category_name' => 'required'
        ]);
    }

    
    protected function savecategoryinfo($request)
    {
        $category = new Category2();
        $category-> category_name = $request -> category_name;
        $category-> category_description = $request -> category_description;
    //    $category-> product_image = $ImageUrl;
        $category-> publication_status = $request -> publication_status;
        $category->save();
    }

    public function saveCategory(Request $request)
    {
         $this->productInfoValidate($request);
           //  $ImageUrl= $this->productimageUpload($request);
         $this->savecategoryinfo($request);
    	//Category2::create($request->all());
        //   $category->id=$request->id;
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
    	return redirect('/category/manage')->with('message','Category info published');
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
