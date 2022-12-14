@extends('frontend.app')
@section('content')
    <h3 class="heading-section text-center py-3">Thanh toán giỏ hàng</h3>
    <form action="{{route('order')}}" method="post">
        @csrf
        <div class="container">
            <div class="row px-5 mb-5">
                <div class="col-6 ">
                    <h5 class="text-center pb-2">Thông tin giao hàng</h5>
                    <div class="form-group ">
                        <label for="name">Họ và tên </label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="number" name="phone_number" class="form-control"
                                    value="{{ old('phone_number') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Ghi chú</label>
                        <textarea name="note" placeholder="Ghi chú đơn hàng" class="form-control form-note" rows="10" class="form-text">
                        {{ old('note') }}</textarea>
                    </div>

                    <div class=" payment-row" >
                        <h5 class="text-center pb-2">Chọn phương thức thanh toán</h5>
                        <div>
                            <input type="radio" id="radio-order" name="payment" value="offline" onclick="validate()">
                            <label for="radio">
                                <p>Thanh toán tiền mặt khi nhận hàng (COD)</p>
                            </label>
                        </div>
                        <div>
                            <input type="radio" id='radio-payment' name="payment" value="online" onclick="validate()">
                            <label for="radio2">
                                <p>Thanh toán qua ví điện tử VN Pay</p>
                            </label>
                        </div>

                    </div>

                </div>
                <div class="col-6 p-4">
                @if (!is_null(Session::get('cart')))
                    <h5 class="text-center pb-2">Thông tin giỏ hàng</h5>
                    <div class="cart-checkout-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Session::get('cart')->products as $product)
                                    <div>
                                        <tr>
                                            <td>
                                                {{ $product['productInfo']->name }}
                                            </td>
                                            <td class="cart-product-img"><img
                                                    src="{{ asset('storage/' . $product['productInfo']->thumbnail) }}"
                                                    alt=""></td>
                                            <td>{{ number_format($product['price']) }} &#8363;</td>
                                            <td>
                                                {{ $product['qty'] }}
                                            </td>
                                        </tr>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="py-3">
                        <div class="cart-total pb-3 text-lg-right">Tổng tiền thanh toán:
                            <span>{{ number_format(Session::get('cart')->totalPayment) }} &#8363;</span>
                        </div>
                        <div class="text-lg-right" >
                            <button type="submit" class="btn-checkout" id="order"> Đặt hàng</button>
                           <form action="{{route('vnpay-payment')}}" method="post">
                            @csrf
                            <button type="submit"  class="text-center btn-checkout" name='redirect' id="payment">
                                Thanh toán bằng VN Pay
                            </button>
                           </form>
                        </div>
                        </div>
                    <input type="hidden" name="total_payment" value="{{ Session::get('cart')->totalPayment}}">
                    @else
                    <span class="text-danger">Hiện giỏ hàng đang trống</span>
                    @endif
                </div>

            </div>
    </form>
    <form action="{{route('vnpay-payment')}}" method="post">
        @csrf
        <button type="submit"  class="text-center " name='redirect' id="payment">
            Thanh toán bằng VN Pay
        </button>
       </form>
    </section>
    </div>

@endsection
