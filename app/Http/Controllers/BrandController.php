<?php

namespace App\Http\Controllers;
use App\brands;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
    	return view('admin.brand.add-brand');
    }
    protected function brandInfoValidate($request)
    {
        $this->validate($request,[
            'brand_name' => 'required'
        ]);
    }
    protected function savebrandinfo($request)
    {
        $brand = new brands();
        $brand-> brand_name = $request -> brand_name;
        $brand-> brand_description = $request -> brand_description;
        $brand-> publication_status = $request -> publication_status;
        $brand->save();
    }

    public function saveBrand(Request $request)
    {
         $this->brandInfoValidate($request);
         $this->savebrandinfo($request);
    	
    	//Category2::create($request->all());
        

    	return redirect('/brand/add')->with('message','Brand info saved');
    }
    public function manageBrand()
	{
		$brands = brands::all();
		return view('admin.brand.manage-brand',['brands'=>$brands]);
    }
    public function unpublishedBrand($id)
    {
    	$brand = brands::find($id);
    	$category->publication_status = 0;
    	$brand->save();
    	return redirect('/brand/manage')->with('message','brand info unpublished');
    }
     public function publishedBrand($id)
    {
    	$brand = brands::find($id);
    	$brand->publication_status = 1;
    	$brand->save();
    	return redirect('/brand/manage')->with('message','brand info published');
    }
    public function editBrand($id)
    {
    	$brand = brands::find($id);
    	return view('admin.brand.edit-brand',['brand'=>$brand]);
    }

    public function updateBrand(Request $request)
    {
    	$brand = brands::find($request->brand_id);
    	$brand-> brand_name = $request -> brand_name;
    	$brand-> brand_description = $request -> brand_description;
    	$brand-> publication_status = $request -> publication_status;
    	$brand->save();

    	return redirect('/brand/manage')->with('message','brand info updated');

    }

    public function deleteBrand($id)
    {
    	$brand = brands::find($id);
    	$brand->delete();
    	return redirect('/brand/manage')->with('message','brand info updated');
    }

}
