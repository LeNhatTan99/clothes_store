<?php

namespace App\Http\Controllers\Web;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::get();
        return view('frontend.news.index',['news'=>$news]);
    }

    public function newsDetail(Request $request,$slug)
    {
        $comments = Comment::get();
        $news = News::orderBy('created_at','Desc')->get();
        $post = News::where('slug',$slug)->first();
        $viewData = [
            'post'=>$post,
            'news'=>$news,
            'comments'=>$comments
        ];
        return view('frontend.news.detail',$viewData);
    }

    public function newsSearch(Request $request) {
        $searchWord = $request->searchWord;
        $news = News::where('title','like','%'.$searchWord .'%')
                ->orderBy('created_at','desc')
                ->get();
        return view('frontend.news.search',['news'=>$news, 'searchWord'=> $searchWord]);
    }

}
