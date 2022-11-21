@extends('frontend.app')

@section('content')



    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-12">
                    @if (Session::has('cart') != null)
                    <h4 class="">Giỏ hàng của bạn</h4>
                        <div class="cart-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="p-name">Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá bán</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Xoá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Session::get('cart')->products as $product)
                                        <div id="change-item-cart">
                                            <tr>
                                                <td class="cart-product-name">
                                                    {{ $product['productInfo']->name }}
                                                </td>
                                                <td class="cart-product-img"><img
                                                        src="{{ asset('storage/' . $product['productInfo']->thumbnail) }}"
                                                        alt=""></td>
                                                <td class="total-price">{{ number_format($product['price']) }} &#8363;</td>
                                                <td class="cart-product-qty">
                                                        <input class="input-qty" type="number" min="1" value="{{ $product['qty'] }}"
                                                            onchange="updateItemCart(this)"
                                                            name="qty[{{ $product['productInfo']->id }}][]"
                                                            id="{{ $product['productInfo']->id }}">
                                                </td>

                                                <td class="total-price">{{ number_format($product['totalPrice']) }} &#8363;</td>
                                                <td class="close-td"><a
                                                    href="{{ route('delete.cart', $product['productInfo']->id) }}"
                                                    class="btn btn-danger">X</a></td>
                                            </tr>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row py-3">
                            <div class="col-lg-4 offset-lg-8">
                                        <div class="cart-total pb-3 text-lg-right">Tổng tiền thanh toán:
                                            <span>{{ number_format(Session::get('cart')->totalPayment) }} &#8363;</span>
                                        </div>
                                   <div class="text-lg-right"> <a href="{{ route('cart-checkout') }}" class="btn-checkout">Tiến hành đặt hàng</a></div>

                            </div>
                        </div>
                    @else
                        <h4>Giỏ hàng của bạn đang trống</h4>
                    @endif
                </div>
            </div>
        @endsection
