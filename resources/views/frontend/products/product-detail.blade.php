@extends('frontend.app')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row product-detail">
                    <div class="col-md-6 ">
                        <div class=" p-3">
                            <div class="text-center p-5 "> <img id="main-image" src="{{asset('storage/'.$product->thumbnail)}}"
                                alt="Hình ảnh sản phẩm"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class=" p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ url()->previous() }}" class="font-weight-bold">
                                    <i class="fa fa-long-arrow-left"> </i> <span class="ml-1">Quay lại</span>
                                </a>
                            </div>
                            <div class="mt-4 mb-3">
                                <h5 class="text-uppercase">{{$product->name}}</h5>
                                <div class="price d-flex flex-row align-items-center">
                                            @if ($product->discount > 0 && $product->discount < $product->price)
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
                            <p class="product-description">{{$product->description}}</p>
                            <form action="{{route('add-cart',$product->id)}}" method="POST">
                                @csrf
                               <div class="form-input-number my-5" >
                                   <div class="input-group">
                                       <span class="input-group-btn">
                                           <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="product_qty">
                                               <i class="fa-solid fa-minus"></i>
                                           </button>
                                       </span>
                                       <input type="text" id="product_qty" name="product_qty" class="form-control input-number" value="1"  min="1" max="100">
                                       <span class="input-group-btn">
                                           <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="product_qty">
                                               <i class="fa-solid fa-plus"></i>
                                           </button>
                                       </span>

                                   </div>
                               </div>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="d-flex my-4 align-items-center">
                                     <button name="action" type="submit" value="buy_now" class="btn btn-danger text-uppercase mr-3 px-4">Mua ngay</button>
                                     <button name="action" value="add_to_cart" type="submit" class="btn btn-danger text-uppercase  px-4"> <i class="fa-solid fa-cart-plus"></i></button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
