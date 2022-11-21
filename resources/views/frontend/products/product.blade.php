@extends('frontend.app')
@section('content')

<div class="bg-light py-5">
    <div class="container">
        <div class="row">
           @include('frontend.sidebar')
            {{-- show products --}}
            <div class="col-md-8 col-lg-10 order-md-last">
                <h3 class="heading-section text-center pb-3">sản phẩm</h3>
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-6 col-lg-3 ">
                        <div class="product">
                            <div  class="img-product">
                                <a href="{{route('product-detail',[$product->slug])}}">
                                    <img class="img-fluid" src="{{asset('storage/'.$product->thumbnail)}}" alt="Hình ảnh">
                                    <div class="overlay"></div>
                                    <form action="{{route('add-cart',$product->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="product_qty" value="1">
                                        <p class="product-add-cart  px-3 ">
                                            <button name="action" value="add_to_cart" type="submit" class="add-to-cart text-center py-2 mr-1"> Thêm vào giỏ</button>
                                            <button name="action" type="submit" value="buy_now"  class="buy-now text-center py-2"><span>Mua ngay</span></button>
                                        </p>
                                    </form>

                                </a>
                            </div>
                            <div class="product-info py-3 px-3">
                                <p><a href="{{route('product-detail',[$product->slug])}}" class="product-name">{{$product->name}}</a></p>
                                <div class="pb-3">
                                    @if ($product->discount > 0 && $product->discount < $product->price)
                                    <span class="product-status">
                                        {{ceil(($product->price-$product->discount)/$product->price*100)}}%
                                    </span>
                                    <p class="product-price">
                                        <span class="mr-2 product-price-dc">{{number_format($product->price)}}&#8363;</span>
                                        <span class="product-price-sale">{{number_format($product->discount)}}&#8363;</span>
                                    </p>
                                    @else
                                    <p class="product-price">
                                        <span class="product-price-sale">{{number_format($product->price)}}&#8363;</span>
                                    </p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

