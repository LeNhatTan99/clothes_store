<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\NewsStoreRequest;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(News::class);
    }

    public function index()
    {
        $news = News::paginate(8);
        return view('backend.news.index',['news'=>$news]);
    }


    public function create()
    {
        return view('backend.news.create');
    }

    protected function storeImage(Request $request) {
        $path = $request->file('thumbnail')->storeAs('public/news_images',Str::slug($request->title).'.'.'jpg');
        return substr($path, strlen('public/'));
      }

    public function store(NewsStoreRequest $request)
    {
        $data = [
            'user_id'=>auth()->user()->id,
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'content'=>$request->content,
        ];
        if($request->hasFile('thumbnail')) {
            $imgUrl = $this->storeImage($request);
            $data['thumbnail'] = $imgUrl;
        }
        DB::beginTransaction();
        try {
            $news = News::create($data);
            DB::commit();
            return redirect()->route('news.index')->with('success','Tạo tin tức thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Tạo tin tức thất bại');
        }
    }


    public function show(News $news)
    {
        return view('backend.news.show',['news'=>$news]);
    }

    public function edit(News $news)
    {
        return view('backend.news.edit',['news'=>$news]);
    }


    public function update(NewsStoreRequest $request, News $news)
    {
        $data = [
            'user_id'=>auth()->user()->id,
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'content'=>$request->content,
        ];
        if($request->hasFile('thumbnail')) {
            $imgUrl = $this->storeImage($request);
            $data['thumbnail'] = $imgUrl;
        }
        DB::beginTransaction();
        try{
            $news->update($data);
            // $news->categories()->sync($request->categoryIds);
            DB::commit();
            return redirect()->route('news.index')->with('success','Cập nhật tin tức thành công');
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
            DB::rollBack();
            return back()->with('error','Cập nhật tin tức thất bại');
        }
    }

    public function destroy(News $news)
    {
        DB::beginTransaction();
        try {
            $news->delete();
            DB::commit();
            return redirect()->route('news.index')->with('success','Xoá tin tức thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Xoá tin tức thất bại');
        }
    }
}
