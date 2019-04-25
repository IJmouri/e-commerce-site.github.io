<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function saveProduct(Request $request)
    {
    	$productImage = $request->file('product-image');
    	$imageName = $productImage->getClientOriginalName();
    	$directory = 'product-image/';
    	// $ImageUrl = $directory.$imageName;
    	$productImage->move($directory,$imageName);
    	return '';
    }
}
