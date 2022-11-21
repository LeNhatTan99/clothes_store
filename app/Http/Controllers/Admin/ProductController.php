<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class);
    }

    public function index()
    {
        $products = Product::paginate(8);
        return view('backend.products.index',['products'=>$products]);
    }


    public function create()
    {
        $categories = Category::get();
        return view('backend.products.create',['categories'=>$categories]);
    }

    protected function storeImage(Request $request) {
        $path = $request->file('thumbnail')->storeAs('public/product_images',Str::slug($request->name).'.'.'jpg');
        return substr($path, strlen('public/'));
      }
    public function store(Request $request)
    {

        $imgUrl = $this->storeImage($request);
        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'thumbnail'=>$imgUrl,
            'description'=>$request->description,
            'inventory'=>$request->inventory,
        ];
        DB::beginTransaction();
        try {
            $product = Product::create($data);
            $product->categories()->sync($request->categoryId);
            DB::commit();
            return redirect()->route('products.index')->with('success','Tạo sản phẩm thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Tạo sản phẩm thất bại');
        }
    }


    public function show(Product $product)
    {
        $categories = Category::get();
        $viewData = [
            'product'=>$product,
            'categories'=>$categories,
        ];
        return view('backend.products.show',$viewData);
    }

    public function edit(Product $product)
    {
        $categories = Category::get();
        $viewData = [
            'product'=>$product,
            'categories'=>$categories,
        ];
        return view('backend.products.edit',$viewData);
    }

    public function update(Request $request, Product $product)
    {
        $imgUrl = $this->storeImage($request);
        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'thumbnail'=>$imgUrl,
            'description'=>$request->description,
            'inventory'=>$request->inventory,
        ];
        DB::beginTransaction();
        try {
            $product ->update($data);
            $product->categories()->sync($request->categoryId);
            DB::commit();
            return redirect()->route('products.index')->with('success','Chỉnh sửa sản phẩm thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Chỉnh sửa sản phẩm thất bại');
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            return redirect()->route('products.index')->with('success','Xoá sản phẩm thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Xoá sản phẩm thất bại');
        }
    }
}
