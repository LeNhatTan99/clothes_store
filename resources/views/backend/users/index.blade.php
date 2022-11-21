@extends('backend.app')
@section('content')
    <div class="m-3">
        <div class="heading-section text-center">
            Quản lý người dùng
        </div>
        <hr>
        <div class=" read">
            <a href="{{ route('users.create') }}" class="btn-create">Tạo tài khoản</a>
            @if ($users->count())
                <table>
                    <thead>
                        <td>#</td>
                        <td>Vai trò</td>
                        <td>Tên</td>
                        <td>Email</td>
                        <td>Số điện thoại</td>
                        <td>Địa chỉ</td>
                        <td>Mật Khẩu</td>
                        <td>Thao tác</td>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @foreach ($user->roles as $role )
                                    {{$role->name}}
                                    @endforeach
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->password }}</td>
                                <td class="actions">
                                    <a href="" class="show-action p-2"><i class="fa-solid fa-eye fa-xs"></i></a>
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="edit-action p-2"><i
                                            class="fas fa-pen fa-xs"></i></a>

                             <form action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                    <button class="delete-action p-2" type="button" data-bs-toggle="modal"
                                        data-bs-target="#item{{$user->id}}">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                    <div class="modal" id="item{{$user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xoá tài khoản</h4>
                                                    <button type="button" class="btn " data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xoá tài khoản {{ $user->email }} không?
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">

                                                        <button type="submit" class="btn btn-danger p-2">Xoá</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Chưa có người dùng nào được tạo!</p>
            @endif
        </div>

    </div>
@endsection
