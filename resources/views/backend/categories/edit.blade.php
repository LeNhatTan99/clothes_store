
@extends('backend.app')
@section('content')
<div class="m-3">
    <div class="heading-section text-center">
       Chỉnh sửa danh mục sản phẩm
    </div>
    <hr>
    <div class="update px-3">
        <form action="{{route('categories.update',['category'=>$category->id])}}" method="post">
            @csrf
            @method('put')
            <div class=" py-2 px-3">
                <div class="py-2">
                    <label for="name">Tên danh mục sản phẩm</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name',$category->name)}}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="py-2">
                    <label for="description">Mô tả</label>
                    <textarea  type="text" class=" form-control create-textarea" name="description" >
                        {{old('description',$category->description)}}
                    </textarea>
                    @if ($errors->has('description'))
                    <span class="text-danger">{{$errors->first('description')}}</span>
                    @endif
                </div>
            <button type="submit" class="btn-create">Cập nhật</button>
        </div>
        </form>
    </div>
</div>
@endsection
