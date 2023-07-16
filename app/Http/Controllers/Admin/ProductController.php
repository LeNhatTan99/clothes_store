<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\ProductStoreRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class);
    }

    public function index(Request $request)
    {
        $conditions = Product::query();
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $conditions->where('products.name', 'like', '%' . $keyword . '%');
        }
        $products = $conditions->paginate(8);
        return view('admin.products.index', ['products' => $products, 'request' => $request]);
    }


    public function create()
    {
        $categories = Category::get();
        return view('admin.products.create',['categories'=>$categories]);
    }

    protected function storeImage(Request $request) {
            $path = $request->file('thumbnail')->storeAs('public/product_images',Str::slug($request->name).'.'.'jpg');
            return substr($path, strlen('public/'));
      }
    public function store(ProductStoreRequest $request)
    {
        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'description'=>$request->description,
            'inventory'=>$request->inventory,
        ];
        if($request->hasFile('thumbnail')) {
            $imgUrl = $this->storeImage($request);
            $data['thumbnail'] = $imgUrl;
        }
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
        return view('admin.products.show',$viewData);
    }

    public function edit(Product $product)
    {
        $categories = Category::get();
        $viewData = [
            'product'=>$product,
            'categories'=>$categories,
        ];
        return view('admin.products.edit',$viewData);
    }

    public function update(ProductStoreRequest $request, Product $product)
    {    
        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'description'=>$request->description,
            'inventory'=>$request->inventory,
        ];
        if($request->hasFile('thumbnail')) {
            $imgUrl = $this->storeImage($request);
            $data['thumbnail'] = $imgUrl;
        }
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