@extends('backend.app')
@section('content')
    <div class="m-3">
        <div class="heading-section text-center">
            Chỉnh sửa vai trò
        </div>
        <hr>
        <div class="update px-3">
            <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="post">
                @csrf
                @method('put')

                <div class=" py-2 px-3">
                    <label for="name">Tên vai trò</label>
                    <input class="form-control" type="text" name="name" id="name"
                        value="{{ old('name', $role->name) }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif

                    <label for="description">Mô tả</label>
                    <textarea type="text" class=" form-control create-textarea" name="description">
                    {{ old('description', $role->description) }}
                </textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <div class="my-3">
                        <p>Cấp quyền</p>
                    </div>
                    @if ($permissions->count())
                        <div class="form-group">
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                        name="permissionIds[]"
                                        {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <button type="submit" class="btn-create">Cập nhật</button>
                </div>

            </form>

        </div>

    </div>
@endsection
