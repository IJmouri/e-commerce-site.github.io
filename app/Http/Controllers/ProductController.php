<?php

namespace App\Http\Controllers;
use App\products;
use App\Category2;
use App\brands;
use Image;
use Illuminate\Http\Request;
use DB;
class ProductController extends Controller
{
	public function index()
    {
		$categories = Category2::where('publication_status', 1)->get();
        $brands = brands::where('publication_status', 1)->get();
        return view('admin.product.add-product',[
                       'categories' =>   $categories  ,
                       'brands' => $brands
        ]);

	}
	protected function productInfoValidate($request)
    {
        $this->validate($request,[
            'product_name' => 'required'
        ]);
    }

    protected function productImageUpload($request)
    {
        $productImage   = $request->file('product_image');
        //  $imageName      = $productImage->getClientOriginalName();     //original image name
        $filetype = $productImage->getClientOriginalExtension();
        $imageName = $request->product_name.'.'.$filetype;       //image name customize 
        $directory      = 'product-image/';       //image will be saved in this directory
        $ImageUrl       = $directory.$imageName;
        //  $productImage   ->move($directory,$ImageUrl);
        Image::make($productImage)->resize(200,200)->save($ImageUrl);            /*imageupload*/
        return $ImageUrl;
       
	}
	protected function saveproductinfo($request,$ImageUrl)
    {
		$product = new products();
		$product-> category_id = $request-> category_id;
        $product-> brand_id = $request-> brand_id;
        $product-> product_name = $request -> product_name;
		$product-> product_price = $request -> product_price;
		$product-> product_quantity = $request -> product_quantity;
		$product-> short_description = $request -> short_description;
		$product-> long_description = $request -> long_description;
        $product-> product_image = $ImageUrl;
        $product-> publication_status = $request -> publication_status;
        $product-> save();
    }
	public function saveProduct(Request $request){
		$this->productInfoValidate($request);
		$ImageUrl = $this->productImageUpload($request);
		$this->saveproductinfo($request, $ImageUrl);
		
		return redirect('/product/add')->with('message', 'Product  info saved successfully');
	 }
 
	 public function manageProduct(){
		// $categories = Category2::all();
		$products = DB::table('products')
					->join('category2s' , 'products.category_id' , '=' , 'category2s.id' )
					->join('brands' , 'products.brand_id' , '=' , 'brands.id' )
					->SELECT( 'products.*' , 'category2s.category_name' , 'brands.brand_name')
					->get();
		 // return $categories;          
		 return view('admin.product.manage-product',['products'=>$products]);
     }
     public function unpublishedProduct($id)
    {
    	$product = products::find($id);
    	$product->publication_status = 0;
    	$product->save();
    	return redirect('/product/manage')->with('message','Product info unpublished');
    }
     public function publishedProduct($id)
    {
    	$product = products::find($id);
    	$product->publication_status = 1;
    	$product->save();
    	return redirect('/product/manage')->with('message','product info published');
    }
    public function editProduct($id)
    {
        $product = products::find($id);
        $categories = Category2::where('publication_status', 1)->get();
        $brands = brands::where('publication_status', 1)->get();
        return view('admin.product.edit-product',[
                       'categories' =>   $categories  ,
                       'brands' => $brands ,
                       'product'=>$product
        ]);

    	//return view('admin.product.edit-product',['products'=>$products]);
    }

    protected function updateProductInfo($request,$ImageUrl)
    {
        $product = products::find($request->product_id);
        $product-> category_id = $request-> category_id;
        $product-> brand_id = $request-> brand_id;
        $product-> product_name = $request -> product_name;
		$product-> product_price = $request -> product_price;
		$product-> product_quantity = $request -> product_quantity;
		$product-> short_description = $request -> short_description;
		$product-> long_description = $request -> long_description;
        $product-> product_Image = $ImageUrl;
        $product-> publication_status = $request -> publication_status;
        $product->save();
    }
    public function updateProduct(Request $request)
    {
        
        $ImageUrl = $this->productImageUpload($request);
		$this->updateProductInfo($request, $ImageUrl);
		$products = DB::table('products')
					->join('category2s' , 'products.category_id' , '=' , 'category2s.id' )
					->join('brands' , 'products.brand_id' , '=' , 'brands.id' )
					->SELECT( 'products.*' , 'category2s.category_name' , 'brands.brand_name')
					->get();
		 // return $categories;          
		// return view('admin.product.manage-product',['products'=>$products]);
		
    
        
    	return redirect('/product/manage')->with('message','product info updated');

    }

    public function deleteProduct($id)
    {
    	$product = products::find($id);
    	$product->delete();
    	return redirect('/product/manage')->with('message','product info deleted');
    }

}
