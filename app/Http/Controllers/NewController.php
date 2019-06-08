<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category2;
use App\products;
class NewController extends Controller
{
    public function index(){
        $categories = category2::where('publication_status',1)->get();
        $newproducts = products::where('publication_status',1)
                                ->orderBy('id','DESC')
                                ->take(4)  
                                ->get();
       // return $newcategory;
    	return view('front-end.home.home',[
            'categories'=>$categories,
            'newproducts'=>$newproducts
            ]);
    }
    public function categoryproduct($id){
        
        $categoryProducts = products::where('category_id',$id)
                                 ->   where('publication_status',1)->get();
    	return view('front-end.category.category-content',[
            'categoryProducts'=>$categoryProducts
        ]);
    }
    public function productDetails($id){
        $productDetails = products::find($id);
        return view('front-end.product.product-details',[
            'productDetails' => $productDetails
        ]);
    } 
}
