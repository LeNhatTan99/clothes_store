@extends('auth.app')
@section('content')
<div class="container-form">
    <form method="POST" action="{{ route('login') }}" class="form" id="form">
        @csrf
        <h3 class="form-heading">Đăng nhập</h3>
        <div class="spacer"></div>


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
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

              <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Lưu đăng nhập') }}
                    </label>
                </div>
              </div>
        <button type="submit" class="form-submit">
            {{ __('Đăng nhập') }}
        </button>

       <div class="pt-2">
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Quên mật khẩu?') }}
        </a>
    @endif
    <a class="btn btn-link" href="{{ route('register') }}">
        {{ __('Tạo tài khoản') }}
    </a>
       </div>
        </form>
</div>
@endsection