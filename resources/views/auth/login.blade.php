@extends('layouts.auth')

@section('content')
<div class="login-content">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-userset">
            <div class="login-logo logo-normal">
                <img src="{{ asset('/admin/assets/img/logo-white.png') }}" alt="INNOWEEK">
            </div>
            <a href="index.html" class="login-logo logo-white">
                <img src="{{ asset('/admin/assets/img/logo-white.png') }}" alt="INNOWEEK">
            </a>
            <div class="login-userheading">
                <h3>Tizimga kirish</h3>
                <h4>InnoWeek innovatsion g'oyalar haftaligi platformasi.</h4>
                @foreach ($errors->all() as $i => $error) {{ $i+1 }}. {{ $error }} @endforeach
            </div>
            <div class="form-login">
                <label>Elektron pochta *</label>
                <div class="form-addons">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <img src="{{ asset('/admin/assets/img/icons/mail.svg') }}" alt="img">
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-login">
                <label>Parol</label>
                <div class="pass-group">
                    <input id="password" type="password" class="pass-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <span class="fas toggle-password fa-eye-slash"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-login authentication-check">
                <div class="row">
                    <div class="col-6">
                        <div class="custom-control custom-checkbox">
                            <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmarks"></span>Tizimda eslab qol
                            </label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <a class="forgot-link" href="">Parolni unitdingizmi?</a>
                    </div>
                </div>
            </div>
            <div class="form-login">
                <button type="submit" class="btn btn-login">Tizimga kirish</button>
            </div>
            <div class="signinform">
                <h4>Tizimda ro'yxatdan o'tmaganmisiz?<a href="#" class="hover-a"> Ro'yxatdan o'tish</a></h4>
            </div>
            <div class="form-setlogin or-text">
                <h4>Yoki</h4>
            </div>
            <div class="form-sociallink">
                <ul class="d-flex justify-content-center">
                    <li>
                        <a href="javascript:void(0);" class="facebook-logo">
                            <img src="{{ asset('/admin/assets/img/icons/facebook-logo.svg') }}" alt="One ID">
                        </a>
                    </li>

                </ul>
                <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                    <p>&copy; 2024 INNOWEEK.UZ. Barcha huquqlar himoyalangan</p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
