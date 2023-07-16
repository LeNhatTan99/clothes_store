@extends('admin.app')
@section('title', 'Tạo quyền' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý quyền', 'url' =>route('permissions.index') ],
                    ['title' => 'Tạo quyền', 'url' =>"#" ],
                ]
            ])
@stop
@section('content')
<div class="m-3">
    <hr>
    <div class="create px-3">
        <form action="{{route('permissions.store')}}" method="post">
            @csrf
            <div class=" py-2 px-3">
                <div class="py-2">
                    <label for="name">Tên quyền</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="py-2">
                    <label for="description">Mô tả</label>
                    <textarea  type="text" class=" form-control create-textarea" name="description"  cols="30" rows="20">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                    <span class="text-danger">{{$errors->first('description')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn-create">Tạo mới</button>
            </div>
        </form>
    </div>
</div>
@endsection
