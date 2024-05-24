@extends('layouts.front.front_main_layout')
@section('content')
<div class="container mt-8">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                    <h2 style="padding:15px 10px;">ログイン</h2>
                </div>

                <div class="card-body">

                    @foreach(['danger','warning', 'success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">

                                </a>
                            </p>
                        @endif
                    @endforeach

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-right">{{ __('メール') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 col-md-push-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('ログイン状態を保持') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 col-md-push-4">
                                <a id="submit" class="action-button shadow animate blue-btn col-md-6">
                                    <i class="fa fa-sign-in" style="color:white;"></i>
                                    {{ __('ログインする') }}
                                </a>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <a id="submit" href="/register" style="color:#0074c1;">まだ会員登録がお済みでない方はこちら</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#submit').click(function(){
            $('#loginForm').submit();
        })
    })
</script>
@endsection
