@extends('frontend.app')
@section('content')
<section class="news-detail">
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-8 ftco-animate">
                      <h2 class="mb-3 ">{{$post->title}}</h2>
          <p>
            <img src="{{asset('storage/'.$post->thumbnail)}}" alt="Hình ảnh" class="news-img">
          </p>
          <p>{{$post->content}}</p>

{{-- comment --}}
          <div class="pt-5 mt-5">
            <h3 class="mb-5">Bình luận</h3>
            <div class="avatar ">
                <i class="fa-solid fa-user"></i>
               </div>
                <form action="{{route('binh-luan',$post->id)}}" class="comment-form" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="content" type="text" class="form-control input-comment" placeholder="Viết bình luận...">
                        <button type="submit" class="btn-comment"><i class="fa-sharp fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>


            <ul class="news-comment-list">
            @foreach ($comments as $comment)
            @if ($comment->news->id == $post->id)

            <li class="news-comment">
                <div class="avatar ">
                 <i class="fa-solid fa-user"></i>
                </div>
                <div class="news-comment-content">
                  <h4 class="news-comment-name">{{$comment->user->name}}</h4>
                  <p class="news-comment-time">{{ $comment->created_at }}</p>
                  <p>{{$comment->content}} </p>
                </div>
              </li>
            @endif
            @endforeach
            </ul>
            <!-- END comment-list -->
          </div>
        </div> <!-- .col-md-8 -->
        <div class="col-lg-4 sidebar ">

            {{-- Form search --}}
          <div class="sidebar-box">
            <form action="{{route('news-search')}}" class="search-form" method="GET">
                @csrf
                <div class="form-group">
                    <input name="searchWord" type="search" class="form-control input-search" placeholder="Nhập từ khoá cần tìm">
                    <button type="submit" class="btn-search"><i class=" fas fa-search"></i></button>
                </div>
            </form>
          </div>
          <div class="sidebar-box ">
            <h3 CLASS="heading-section">Danh mục</h3>
            <ul class="news-categories">
                <li><a href="#">Túi xách <span>(12)</span></a></li>
                <li><a href="#">Giày <span>(22)</span></a></li>
                <li><a href="#">Váy <span>(37)</span></a></li>
                <li><a href="#">Phụ kiện <span>(42)</span></a></li>
                <li><a href="#">Makeup <span>(14)</span></a></li>
                <li><a href="#">Làm đẹp <span>(140)</span></a></li>
            </ul>
        </div>

          <div class="sidebar-box ">
            <h3 class="heading-section mb-3">Tin tức nổi bật</h3>
       @foreach ($news->take(5) as $item)
       <div class="news-propose mb-4 d-flex">
        <a class="news-img mr-4" >
          <img src="{{asset('storage/'.$item->thumbnail)}}" alt="">
        </a>
        <div class="news-propose-text">
          <h3 class="news-propose-title"><a href="{{route('news-detail',$item->slug)}}">{{$item->title}}</a></h3>
          <div class="news-propose-meta">
            <div ><i class="fa-regular fa-calendar-days"></i>{{ date('jS M Y', strtotime($item->created_at)) }}</div>
            <div > <i class="fa-solid fa-user"></i> {{$item->user->name}}</div>
          </div>
        </div>
      </div>
       @endforeach
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
