@extends('admin.app')
@section('title', 'Tạo tin tức' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý tin tức', 'url' =>route('news.index') ],
                    ['title' => 'Tạo tin tức', 'url' =>"#" ],
                ]
            ])
@stop
@section('content')
<div class="m-3">
    <hr>
    <div class="create px-3">
        <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class=" py-2 px-3">
                   <div class="form-group">
                    <label >Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="title" value="{{old('title')}}">
                    @if ($errors->has('title'))
                    <span class="text-danger">{{$errors->first('title')}}</span>
                    @endif
                   </div>

                  <div class="form-group">
                    <label for="thumbnail">Hình ảnh</label>
                    <input class="form-control" type="file" name="thumbnail" value="{{old('thumbnail')}}">
                    @if ($errors->has('thumbnail'))
                    <span class="text-danger">{{$errors->first('thumbnail')}}</span>
                    @endif
                  </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                    <textarea  type="text" class=" form-control create-textarea" name="content"  cols="30" rows="20">{{old('content')}}</textarea>
                    @if ($errors->has('content'))
                    <span class="text-danger">{{$errors->first('content')}}</span>
                    @endif
                    </div>
                    {{-- <div class="my-3">
                        <p >Danh mục</p>
                       </div>
                        @if ($categories->count())
                            <div class="form-group">
                              @foreach ($categories as $category)
                                <div class="form-check">
                                  <input id="flexCheckCheckedCategory{{$category->id}}" class="form-check-input" type="radio" value="{{ $category->id }}" name="categoryId">
                                  <label class="form-check-label" for="flexCheckCheckedCategory{{$category->id}}">
                                    {{ $category->name }}
                                  </label>
                                </div>
                              @endforeach
                            </div>
                        @endif --}}
            <button type="submit" class="btn-create">Tạo</button>
            </div>

        </form>

    </div>

</div>
@endsection
