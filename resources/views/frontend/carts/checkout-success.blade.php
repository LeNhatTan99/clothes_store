@extends('frontend.app')
@section('content')

    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 text-success"> <i class="material-icons fa-solid fa-check"></i> Đã đặt hàng </h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Bạn đã tạo đơn hàng thành công. <br> Kiểm tra email để biết thêm chi tiết.</p>
            </div>
            <div class="modal-footer">
                <a href="{{route('index')}}" class="btn btn-success btn-block">Trang chủ</a>
            </div>
        </div>
</div>
@endsection
