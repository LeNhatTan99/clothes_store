<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $viewData = [
            'products'=>$products,
            'categories'=>$categories,
        ];
        return view('frontend.products.product',$viewData);
    }

    // public function productDetail($slug,Request $request)
    // {
    //     $product = Product::where('slug',$slug)->first();
    //     return view('frontend.products.product-detail',['product'=>$product]);
    // }

}
