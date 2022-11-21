
@extends('backend.app')
@section('content')
<div class="m-3">
    <div class="heading-section text-center">
       Chỉnh sửa tin tức
    </div>
    <hr>
    <div class="update px-3">
        <form action="{{route('news.update',['news'=>$news->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class=" py-2 px-3">
                <div class="form-group">
                    <label >Tiêu đề</label>
                    <input class="form-control" type="text" name="title" value="{{old('title',$news->title)}}">
                    @if ($errors->has('title'))
                    <span class="text-danger">{{$errors->first('title')}}</span>
                    @endif
                   </div>

                  <div class="form-group">
                    <label >Hình ảnh</label>
                    <input class="form-control" type="file" name="thumbnail" >
                    @if ($errors->has('thumbnail'))
                    <span class="text-danger">{{$errors->first('thumbnail')}}</span>
                    @endif
                  </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                    <textarea  type="text" class=" form-control create-textarea" name="content"  cols="30" rows="20">
                        {{old('content',$news->content)}}
                    </textarea>
                    @if ($errors->has('content'))
                    <span class="text-danger">{{$errors->first('content')}}</span>
                    @endif
                    </div>
                    {{-- <div class="my-3">
                        <p >Danh mục </p>
                    </div>
                        @if ($categories->count())
                            <div class="form-group">
                              @foreach ($categories as $category)
                                <div class="form-check">
                                  <input id="flexCheckCheckedCategory{{$category->id}}" class="form-check-input" type="radio"
                                   value="{{ $category->id }}" name="categoryId" >
                                  <label class="form-check-label" for="flexCheckCheckedCategory{{$category->id}}">
                                    {{ $category->name }}
                                    </label>
                                </div>
                              @endforeach
                            </div>
                        @endif --}}

            <button type="submit" class="btn-create">Cập nhật</button>
            </div>

        </form>

    </div>

</div>
@endsection
