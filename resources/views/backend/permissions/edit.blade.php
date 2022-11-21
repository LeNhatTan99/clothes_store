
@extends('backend.app')
@section('content')
<div class="m-3">
    <div class="heading-section text-center">
       Chỉnh sửa quyền
    </div>
    <hr>
    <div class="update px-3">
        <form action="{{route('permissions.update',['permission'=>$permission->id])}}" method="post">
            @csrf
            @method('put')
            <div class=" py-2 px-3">
                <label for="name">Tên quyền</label>
                <input class="form-control" type="text" name="name" id="name" value="{{old('name',$permission->name)}}">
                @if ($errors->has('name'))
                <span class="text-danger">{{$errors->first('name')}}</span>
                @endif

                <label for="description">Mô tả</label>
                <textarea  type="text" class=" form-control create-textarea" name="description" >
                    {{old('description',$permission->description)}}
                </textarea>
                @if ($errors->has('description'))
                <span class="text-danger">{{$errors->first('description')}}</span>
                @endif

        <button type="submit" class="btn-create">Cập nhật</button>
        </div>

        </form>

    </div>

</div>
@endsection
