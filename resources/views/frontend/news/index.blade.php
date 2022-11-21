@extends('frontend.app')
@section('content')
    <section class="bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 ">
                    <div class="row">
                       @foreach ($news as $post)
                       <div class="col-md-12 d-flex ">
                        <div class="news-container  d-md-flex">
                            <a href="{{route('news-detail',$post->slug)}}" class="news-img">
                                <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="Hình ảnh">
                            </a>
                            <div class="news-text d-block pl-md-4">
                                <p class="mb-3 news-date">{{ date('jS M Y', strtotime($post->created_at)) }} </p>
                                <h3 class="news-title"><a href="{{route('news-detail',$post->slug)}}"> {{$post->title}}</a></h3>
                                <p class="news-description">{{$post->content}}</p>
                                <p><a href="{{route('news-detail',$post->slug)}}" class="btn btn-news py-2 px-3">Xem thêm</a></p>
                            </div>
                        </div>
                    </div>
                       @endforeach

                    </div>
                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ">
                    {{-- search --}}
                    <form action="{{route('news-search')}}" class="search-form" method="get">
                        @csrf
                        <div class="form-group">
                            <input name="searchWord" type="search" class="form-control input-comment" placeholder="Nhập từ khoá cần tìm">
                            <button class="btn-search"><i class=" fas fa-search"></i></button>
                        </div>
                    </form>
                    <div class="sidebar-box ">
                        <h3 CLASS="heading-section">Categories</h3>
                        <ul class="news-categories">
                           @foreach ($categories as $category)
                           <li><a href="#">{{$category->name}} </a></li>
                           @endforeach
                        </ul>
                    </div>



                </div>

            </div>
        </div>
    </section>
@endsection
