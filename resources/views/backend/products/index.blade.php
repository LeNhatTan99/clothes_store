@extends('backend.app')
@section('content')
    <div class="m-3">
        <div class="heading-section text-center">
            Quản lý sản phẩm
        </div>
        <hr>
        <div class=" read">
            <a href="{{ route('products.create') }}" class="btn-create">Tạo sản phẩm</a>
            @if ($products->count())
                <table>
                    <thead>
                        <td>#</td>
                        <td>Tên sản phẩm</td>
                        <td>Giá gốc</td>
                        <td>Giá khuyến mãi</td>
                        <td>Trạng thái</td>
                        <td>Hình ảnh</td>
                        <td>Mô tả</td>
                        <td>Số lượng</td>
                        <td>Thao tác</td>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td> {{number_format($product->price)}}&#8363; </td>
                                <td>{{number_format($product->discount)}}&#8363;</td>
                                <td>{{ $product->status }}</td>
                                <td><img src="{{ asset('storage/'.$product->thumbnail) }}" alt=""> </td>
                                <td class="read-description">{{ $product->description }}</td>
                                <td>{{ $product->inventory }}</td>
                                <td class="actions">
                                    <a href="" class="show-action p-2"><i class="fa-solid fa-eye fa-xs"></i></a>
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="edit-action p-2"><i
                                            class="fas fa-pen fa-xs"></i></a>

                             <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                    <button class="delete-action p-2" type="button" data-bs-toggle="modal"
                                        data-bs-target="#item{{$product->id}}">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                    <div class="modal" id="item{{$product->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xoá sản phẩm</h4>
                                                    <button type="button" class="btn " data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xoá sản phẩm {{ $product->name }} không?
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
            @else
                <p>Chưa có sản phẩm nào được tạo!</p>
            @endif
        </div>
        {{ $products->links() }}
    </div>
@endsection
