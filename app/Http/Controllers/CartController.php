<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Cart;
class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
       // return $request->all();
        $product = Products::find($request->id);
        Cart::add([
            'id' => $request->id,
            'name' => $product->product_name,
            'price' => $product->product_price,
            'qty' => $request->qty,
            'options' => [
                'image' => $product-> product_Image
            ]
        ]);
        return redirect('/cart/show');
    }
    public function showcart()
    {
        $cartProducts = Cart::content();
      //  return $cartProducts;
        return view('front-end.cart.show-cart',['cartProducts' => $cartProducts]);
    }
    public function deleteCart($id)
    {
        Cart::remove($id);
        return redirect('cart/show');
    }
}
