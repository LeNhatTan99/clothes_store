@extends('frontend.app')
@section('content')

{{-- slider --}}
<section id="home-section" class="home-section">
    <div class="slider">
    <div class="slider-item ">
      <div class="container-fluid p-0">
        <div class="row d-md-flex no-gutters slider-content  align-items-center justify-content-end">
            <div class="slider-img order-md-last" >
            </div>
            <div class="slider-text d-flex  align-items-center ">
                <div class="text">
                    <span class="subheading">Tshop Clothes</span>
                    <div class="horizontal-text">
                        <h3 class="vr" >Stablished Since 2000</h3>
                      <h1 class="mb-4 mt-3">Phong cách thời trang hiện đại</h1>
                      <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country.</p>
                      <p><a href="#" class="btn btn-slider px-5 py-3 mt-3">Khám phá ngay</a></p>
                    </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>


<section class=" bg-light py-3">
    <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ">
        <h2 class="mb-4">Sản phẩm nổi bật</h2>
      </div>
    </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($products->take(8) as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
        <div class="more-product">
            <a href="{{route('products')}}">Xem thêm sản phẩm <i class="fa fa-long-arrow-right"> </i></a>
        </div>
    </div>
</section>

{{-- news --}}
<hr>
<section class="news bg-light py-3">
    <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ">
        <h2 class="mb-4">Tin tức</h2>
      </div>
    </div>
    </div>
    <div class="container">
        <div class="row">

            @foreach ($news->take(3) as $item )
            <div class="col-sm  col-lg-4 ">
                <div class="news-home">
                 <div class="news-img">
                     <img class="img-fluid" src="{{asset('storage/'.$item->thumbnail)}}" alt="Hình ảnh">
                 </div>

                 <div class="news-content py-3 px-3">
                     <p class="news-date">
                         <i class="fa-regular fa-clock"></i> {{ date('jS M Y', strtotime($item->created_at)) }}
                     </p>
                     <h3 class="news-title"><a href="{{route('news-detail',$item->slug)}}" >{{$item->title}}</a></h3>
                            <div class="pb-3">
                              <p class="news-description">{{$item->content}}</p>
                            </div>
                 </div>
                </div>
         </div>
            @endforeach

        </div>
    </div>
</section>


    {{-- subscribe email --}}
    <section class="subscribe">
      <div class="container">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-7 text-center  ">
            <h2>Đăng ký nhận tin</h2>
            <div class="row d-flex justify-content-center mt-5">
              <div class="col-md-8">
                <form action="#" class="subscribe-form">
                  <div class="form-group d-flex ">
                    <input type="text" class="form-control" placeholder="Nhập email nhận tin">
                    <button  type="submit"  class="form-submit px-3 p-2 ">Đăng ký</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

@endsection
