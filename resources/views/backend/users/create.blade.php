
@extends('backend.app')
@section('content')
<div class="m-3">
    <div class="heading-section text-center">
        Tạo tài khoản người dùng
    </div>
    <hr>
    <div class="create px-3">
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-6 py-2 px-3">
                    <label for="name">Tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="col-sm-6 py-2 px-3">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  id="email"  value="{{old('email')}}">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="col-sm-6 py-2 px-3">
                    <label for="phone_number">Số điện thoại</label>
                    <input class="form-control" type="text" name="phone_number"  id="phone_number"  value="{{old('phone_number')}}">
                    @if ($errors->has('phone_number'))
                    <span class="text-danger">{{$errors->first('phone_number')}}</span>
                    @endif
                </div>
                <div class="col-sm-6 py-2 px-3">
                    <label for="address">Địa chỉ</label>
                    <input class="form-control" type="text" name="address"  id="address"  value="{{old('address')}}">
                    @if ($errors->has('address'))
                    <span class="text-danger">{{$errors->first('address')}}</span>
                    @endif
                </div>
                <div class="col-sm-6 py-2 px-3">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password"  id="password"  value="{{old('password')}}">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{$errors->first('password')}}</span>
                    @endif
                </div>
            </div>

            <div class="my-3">
                <p>Cấp quyền</p>
            </div>
            @if ($roles->count())
                <div class="form-group">
                    @foreach ($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="{{ $role->id }}"
                                name="roleId" >
                            <label class="form-check-label">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            <button type="submit" class="btn-create">Tạo mới</button>
        </form>

    </div>

</div>
@endsection
