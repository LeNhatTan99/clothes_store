<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class CartService
{
    public $products = null;
    public $totalPayment = 0;
    public $totalQty = 0;

    public function __construct($cart){
        if($cart){
            $this->products = $cart->products;
            $this->totalPayment = $cart->totalPayment;
            $this->totalQty = $cart->totalQty;
        }
    }

    public function addCart( $product,$qty,$id){
        $totalPrice = 0;
        if($product->discount > 0 && $product->discount < $product->price ){
            $price = $product->discount;
        } else {
            $price = $product->price;
        }
        $newProduct = ['qty'=> $qty,'price'=>$price,'totalPrice'=>$totalPrice,'productInfo'=> $product];
        if($this->products){
            if(array_key_exists($id, $this->products)){
                $newProduct = $this->products[$id] ;
                return back()->with('error','Sản phẩm đã có trong giỏ hàng');
            };
        }
        $newProduct['qty']+$qty;
        $newProduct['totalPrice'] =$newProduct['qty']*$price;
        $this->products[$id] = $newProduct;
        $this->totalPayment += $price*$qty;
        $this->totalQty += $qty;
      
    }
    public function deleteItemCart($id){
            $this->totalQty -= $this->products[$id]['qty'];
            $this->totalPayment -= $this->products[$id]['totalPrice'];
            unset($this->products[$id]);
    }

    public function updateItemCart($id,$qty){

        $product = $this->products[$id]['productInfo'];

        if($product->discount > 0){
            $price = $product->discount;
        } else $price = $product->price;
        $this->totalQty -= $this->products[$id]['qty'];
        $this->totalPayment -= $this->products[$id]['totalPrice'];

        $this->products[$id]['qty'] = $qty;
        $this->products[$id]['totalPrice'] =$qty* $price;

        $this->totalQty += $this->products[$id]['qty'];
        $this->totalPayment += $this->products[$id]['totalPrice'];
    }
}
