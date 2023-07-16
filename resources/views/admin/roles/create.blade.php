@extends('admin.app')
@section('title', 'Tạo vai trò' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý vai trò', 'url' =>route('roles.index') ],
                    ['title' => 'Tạo mới vai trò', 'url' =>"#" ],
                ]
            ])
@stop
@section('content')
    <div class="m-3">
        <hr>
        <div class="create px-3">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
                <div class=" py-2 px-3">
                    <div class="py-2">
                        <label for="name">Tên vai trò</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    </div>
                  <div class="py-2">
                    <label for="description">Mô tả</label>
                    <textarea type="text" class=" form-control create-textarea" name="description" cols="30" rows="20">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                  </div>
                    <div class="my-3">
                        <p>Cấp quyền</p>
                    </div>
                    @if ($permissions->count())
                        <div class="form-group">
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input id="flexCheckCheckedPermission{{ $permission->id }}" class="form-check-input"
                                        type="checkbox" value="{{ $permission->id }}" name="permissionIds[]">
                                    <label class="form-check-label" for="flexCheckCheckedPermission{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <button type="submit" class="btn-create">Tạo mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection
