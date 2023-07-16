@extends('admin.app')
@section('title', 'Xem đơn hàng' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý đơn hàng', 'url' =>route('orders.index') ],
                    ['title' => 'Chi tiết đơn hàng', 'url' =>"#" ],
                ]
            ])
@stop
@section('content')
<div class="p-4">
    <div class="row">
        <div class="col-6">
            <h4 class="text-center">Thông tin khách hàng</h4>
           <p>Tên KH:  {{$order->name}}</p>
           <p>Số điện thoại:  {{$order->phone_number}}</p>
           <p>Email:  {{$order->email}}</p>
           <p>Địa chỉ:  {{$order->address}}</p>
        </div>
        <div class="col-6">
            <h4 class="text-center">Thông tin đơn hàng</h4>
            <p>Trạng thái đơn hàng: {{$order->status}}</p>
            @foreach ($products as $product )
            <div class="border">
                <p>Tên sản phẩm: {{$product->product_name}}</p>
            <p>Giá tiền: {{$product->price}}</p>
            <p>Số lượng: {{$product->qty}}</p>
            </div>
            @endforeach
            <p>Ghi chú của khách hàng: {{$order->note}}</p>
            <p>Tổng tiền: {{number_format($order->total_payment)}}&#8363;</p>
        </div>
    </div>
</div>
@endsection
