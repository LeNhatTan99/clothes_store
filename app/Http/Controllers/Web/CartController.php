<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Services\CartService;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Category;


class CartController extends Controller
{

    public function addCart(Request $request,$id){
        $categories= Category::get();
         $product = DB::table('products')->where('id',$id)->first();
         $qty = $request->product_qty;
        if($product != null ){
            $cart = Session('cart') ? Session('cart') : null;
            $newCart = new CartService($cart);
            $newCart->addCart($product,$qty,$id);
            if($qty> $product->inventory) {
                return redirect()->back()->with('error', 'Hiện tại sản phẩm này chỉ còn '.$product->inventory.' sản phẩm');
            }
            $request->session()->put('cart',$newCart);
        }

        $viewData = [
            'newCart'=> $newCart,
            'categories'=> $categories,
        ];
        switch ($request->input('action')) {
            case 'buy_now':
                return redirect()->route('cart-checkout');
            case 'add_to_cart':
                 return redirect()->back()->with('success', 'Đã thêm '. $product->name .' vào giỏ hàng thành công');
        }
    }


    public function   deleteItemCart(Request $request,$id){

            $cart = Session('cart') ? Session('cart') : null;
            $newCart = new CartService($cart);
            $newCart->deleteItemCart($id);
           if(Count($newCart->products)>0){
            $request->session()->put('cart',$newCart);
           }else {
            $request->session()->forget('cart');
           }
           $viewData = [
            'newCart'=> $newCart,
        ];
        return redirect()->route('cart-list')->with('success','Đã xoá sản phẩm thành công');
    }

public function   updateItemCart(Request $request,$id,$qty){
    $cart = Session('cart') ? Session('cart') : null;
    if($qty <=  $cart->products[$id]['productInfo']->inventory)
   {
    $newCart = new CartService($cart);
    $newCart->updateItemCart($id,$qty);
    $request->session()->put('cart',$newCart);
     return redirect()->route('cart-list')->with('success', 'cập nhật số lượng sản phẩm thành công');
   }
   else return back()->with('error', 'Hiện tại sản phẩm này chỉ còn '.$cart->products[$id]['productInfo']->inventory.' sản phẩm');
}

public function showListCart(){
    $categories = Category::get();
    $viewData = [
        'categories'=>$categories,
    ];
    return view('frontend.carts.cart-list',$viewData);
}
public function cartCheckout() {
    $categories = Category::get();
    $viewData = [
        'categories'=>$categories,
    ];
    return view('frontend.carts.cart-checkout',$viewData);
}

}
