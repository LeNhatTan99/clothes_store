@extends('admin.app')
@section('title', 'Quản lý đơn hàng' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý đơn hàng', 'url' =>"#" ],
                ]
            ])
@stop
@section('content')
    <div class="m-3 main-content">
        <div class="heading-section text-center">    
            <!-- Search form -->
            <form class="d-none d-md-flex input-group w-auto my-auto">
                <input autocomplete="off" name="keyword" type="search" class="form-control rounded" placeholder='Nhập từ khoá tìm kiếm: tên KH, số điện thoại'
                    @if($request->has('keyword')) value="{{ $request->keyword}}" @endif
                    style="min-width: 225px; max-width: 480px" />
                <button type="submit" class="input-group-text border-0"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <hr>
        <div class=" read">
            @if ($orders->count())
                <table>
                    <thead>
                        <td>#</td>
                        <td>Tên KH</td>
                        <td>SĐT</td>
                        <td>Địa chỉ</td>
                        <td>Tổng tiền</td>
                        <td>Ghi chú</td>
                        <td>Trạng thái</td>
                        <td>Thao tác</td>
                    </thead>
                    <tbody>
                        @foreach ($orders as $k => $order)
                            <tr>
                                <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $k + 1 }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->phone_number }}</td>
                                <td>{{ $order->address }}</td>
                                <td> {{number_format($order->total_payment)}}&#8363; </td>
                                <td>{{ $order->note }}</td>
                                <td>
                                  <form action="{{route('orders.update',['order'=>$order])}}" method="post">
                                    @csrf
                                    @method('put')
                                    <select name="status" onchange="this.form.submit()" class="border-0">
                                        <option value="{{ $order->status }}"> {{ $order->status }}</option>
                                        <option value="Đang xử lý">Đang xử lý</option>
                                        <option value="Đang giao hàng">Đang giao hàng</option>
                                        <option value="Đã xử lý">Đã xử lý</option>
                                      </select>
                                  </form>
                                </td>
                                <td class="actions">
                                    <a href="{{route('orders.show',['order'=>$order->id])}}" class="show-action p-2"><i class="fa-solid fa-eye fa-xs"></i></a>
                             <form action="{{ route('orders.destroy', ['order' => $order->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                    <button class="delete-action p-2" type="button" data-bs-toggle="modal"
                                        data-bs-target="#item{{$order->id}}">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                    <div class="modal" id="item{{$order->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xoá đơn hàng</h4>
                                                    <button type="button" class="btn " data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xoá đơn hàng {{ $order->id }} không?
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">

                                                        <button type="submit" class="btn btn-danger p-2">Xoá</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-2">
                    {{ $orders->appends(['keyword' => request()->input('keyword')])->links()}}
                </div> 
            @else
                <p>Chưa có đơn hàng nào được tạo!</p>
            @endif
        </div>
        {{ $orders->links() }}
    </div>
@endsection
