<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }
    public function index(Request $request)
    {
        $conditions = Category::query();
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $conditions->where('categories.name', 'like', '%' . $keyword . '%');
        }
        $categories = $conditions->paginate(8);
        return view('admin.categories.index',['categories'=>$categories, 'request'=>$request]);
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(CategoryStoreRequest $request)
    {
        $data = [
            'name'=>$request->name,
            'slug' => Str::slug($request->name),
            'description'=>$request->description,
        ];
        DB::beginTransaction();
        try {
            $category = Category::create($data);
            DB::commit();
            return redirect()->route('categories.index')->with('success','Tạo danh mục sản phẩm thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Tạo danh mục sản phẩm thất bại');
        }
    }


    public function show(Category $category)
    {
        return view('admin.categories.show',['category'=>$category]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',['category'=>$category]);
    }


    public function update(CategoryStoreRequest $request, Category $category)
    {
        $data = [
            'name'=>$request->name,
            'slug' => Str::slug($request->name),
            'description'=>$request->description,
        ];
        DB::beginTransaction();
        try {
            $category ->update($data);
            DB::commit();
            return redirect()->route('categories.index')->with('success','Chỉnh sửa danh mục sản phẩm thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Chỉnh sửa danh mục sản phẩm thất bại');
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete();
            DB::commit();
            return redirect()->route('categories.index')->with('success','Xoá danh mục sản phẩm thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Xoá danh mục sản phẩm thất bại');
        }
    }
}
