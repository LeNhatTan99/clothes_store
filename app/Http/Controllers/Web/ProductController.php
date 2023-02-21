<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        $viewData = [
            'products'=>$products,
        ];
        return view('frontend.products.product',$viewData);
    }

    public function productDetail($slug,Request $request)
    {
        $product = Product::where('slug',$slug)->first();

        $viewData = [
            'product'=>$product,
        ];
        return view('frontend.products.product-detail',$viewData);
    }


    public function getListProduct($slug)
    {
        $col = ['products.*',DB::raw('categories.slug as category_slug, categories.name as category_name')];
        $products = Product::join('category_product','products.id','=','product_id')
                    ->join('categories','category_product.category_id','=','categories.id')
                    ->where('categories.slug', $slug)
                    ->orderBy('created_at', 'desc')
                    ->get($col);
         $viewable = Category::VIEWABLE;
         $viewData =  [
            'products' => $products->groupBy('category_name')
            ];
        return view("frontend.products.{$viewable[$slug]}",$viewData);
    }

    public function productSearch(Request $request) {
        $searchWord = $request->searchWord;
        $products = Product::where('name','like','%'.$searchWord .'%')
                ->orderBy('created_at','desc')
                ->get();
        return view('frontend.products.search',['products'=>$products, 'searchWord'=> $searchWord]);
    }

}
