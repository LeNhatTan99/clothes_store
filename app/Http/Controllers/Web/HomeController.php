<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\News;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $products = Product:: orderBy('discount', 'desc')->get();
        $categories = Category::get();
        $news = News::orderBy('created_at','desc')->get();
        $viewData = [
            'products'=>$products,
            'categories'=>$categories,
            'news'=>$news,
        ];
        return view('frontend.index',$viewData);
    }
}
