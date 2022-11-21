@extends('auth.app')

@section('content')
                <div class="container-form">
                    <form method="POST" action="{{ route('register') }}" class="form" id="form">
                        @csrf
                        <h3 class="form-heading">Đăng ký tài khoản</h3>
                        <div class="spacer"></div>

                        <div class="form-group">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" id="name"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="form-label">Nhập lại mật khẩu</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="form-submit">
                            {{ __('Đăng ký') }}
                        </button>
                        <div class="pt-2">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Quay lại đăng nhập') }}
                            </a>
                        </div>
                        </form>
                </div>


@endsection

