
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="{{route('index')}}">TShop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> <i class="fa-solid fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="{{route('index')}}" class="nav-link">Trang chủ</a></li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('products')}}" >Sản phẩm</a>
          <div class="dropdown-menu" >
            @foreach ($categories as $category)
            <a class="dropdown-item" href="{{route('get-list-product',$category->slug)}}"> {{$category->name}} </a>
            @endforeach
          </div>
        </li>

          <li class="nav-item"><a href="about.html" class="nav-link">Giới thiệu</a></li>
          <li class="nav-item"><a href="{{route('news')}}" class="nav-link">Tin tức</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link">Liên hệ</a></li>
            <li class="nav-item dropdown">
                <p href="" class="nav-link"> <i class="fa-solid fa-magnifying-glass"></i></p>
                <div class="dropdown-menu">
                    <div class=" nav-search">
                        <form action="{{route('product-search')}}" method="GET" class="search-form">
                            @csrf
                            <div class="form-group my-2">
                                <input name="searchWord" type="search" class="form-control input-search" placeholder="Tìm kiếm sản phẩm">
                                <button type="submit" class="btn-search"><i class=" fas fa-search"></i></button>
                            </div>
                        </form>
                      </div>
                </div>

            </li>
          <li class="nav-item cta cta-colored"><a href="{{route('cart-list')}}" class="nav-link">
            <i class="fa-sharp fa-solid fa-bag-shopping"></i>
            <sup>
                 @if(isset(Session::get('cart')->totalQty))
                <strong id="count">{{Session::get('cart')->totalQty}}</strong>
                @endif
            </sup>
        </a> </li>

          <li class="nav-item dropdown ">
            <p class="nav-link " ><i class="fa-solid fa-user"></i></p>
            <div class="dropdown-menu ">
              @guest
              @if (Route::has('login'))
                      <a class="dropdown-item " href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
              @endif
              @if (Route::has('register'))
                      <a class="dropdown-item " href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
              @endif
            @else
                <a class=" dropdown-item " href="#" >
                      {{ Auth::user()->name }}
                </a>
               <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                   {{ __('Đăng xuất') }}
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                   @csrf
              </form>


          @endguest
            </div>


          </li>
        </ul>
      </div>
    </div>
  </nav>




