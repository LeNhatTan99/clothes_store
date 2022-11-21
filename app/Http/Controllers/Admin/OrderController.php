<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::paginate(8);
        return view('backend.orders.index',['orders'=>$orders]);
    }

    public function show($id) {
        $col = ['order_product.*','orders.*',DB::raw('products.name as product_name,products.price as product_price')];
        $products = Order::join('order_product','orders.id','=','order_product.order_id')
                        ->join('products','products.id','=','order_product.product_id')
                        ->where('orders.id',$id)
                        ->get($col);
        $order = Order::get()->find($id);
        $viewData = [
            'products'=>$products,
            'order'=>$order,
        ];
        return view('backend.orders.show',$viewData);
    }

    public function update(Request $request, Order $order)
    {

     DB::beginTransaction();
        try {
            $order ->update(['status' => $request->status]);
            DB::commit();
            return redirect()->route('orders.index')->with('success','Cập nhật trạng thái đơn hàng thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Cập nhật trạng thái đơn hàng thất bại');
        }
    }
    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->delete();
            DB::commit();
            return redirect()->route('orders.index')->with('success','Xoá đơn hàng thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Xoá đơn hàng thất bại');
        }
    }
}
