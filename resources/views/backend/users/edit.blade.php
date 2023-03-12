@extends('backend.app')
@section('content')
<div class="m-3">
    <div class="heading-section text-center">
        Cập nhật tài khoản người dùng
    </div>
    <hr>
    <div class="update px-3">
        <form id="form" action="{{route('users.update',['user'=>$user->id])}}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-6 py-2 px-3">
                    <label for="name">Tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name',$user->name)}}">
                    @if ($errors->first('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="col-6 py-2 px-3">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  id="email"  value="{{old('email',$user->email)}}">
                    @if ($errors->first('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="col-6 py-2 px-3">
                    <label for="phone_number">Số điện thoại</label>
                    <input class="form-control" type="text" name="phone_number"  id="phone_number"  value="{{old('phone_number',$user->phone_number)}}">
                    @if ($errors->first('phone_number'))
                    <span class="text-danger">{{$errors->first('phone_number')}}</span>
                    @endif
                </div>
                <div class="col-6 py-2 px-3">
                    <label for="address">Địa chỉ</label>
                    <input class="form-control" type="text" name="address"  id="address"  value="{{old('address',$user->address)}}">
                    @if ($errors->first('address'))
                    <span class="text-danger">{{$errors->first('address')}}</span>
                    @endif
                </div>
                <div class="col-6 py-2 px-3">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password"  id="password"  value="{{old('password',$user->password)}}">
                    @if ($errors->first('password'))
                    <span class="text-danger">{{$errors->first('password')}}</span>
                    @endif
                </div>
            </div>

            <div class="my-3">
                <p>Chọn vai trò</p>
            </div>
            @if ($roles->count())
                <div class="form-group">
                    <select class="form-control" id="roleId" name="roleId" >
                        <option value="">----</option>
                        @foreach($roles as $role)
                            <option
                                value={{ $role->id }} {{ in_array( $role->id, $user->roles->pluck('id')->toArray() ) ? 'selected':'' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('roleId'))
                    <span class="text-danger">{{$errors->first('roleId')}}</span>
                     @endif
                </div>
            @endif
            <button type="submit" class="btn-create">Cập nhật</button>
        </form>
    </div>
</div>
@include('backend.users.script')
@endsection
