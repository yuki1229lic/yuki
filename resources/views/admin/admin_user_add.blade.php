@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>新規会員追加</h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <a href="{{ route('admin.user_list') }}" class="btn btn-outline-success float-lg-right"><i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach(['danger','warning', 'success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                                <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </p>
                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.user_add_db') }}" method="post" id="user_form">
                                    @csrf
                                    <div class="form-group">
                                        <label>ユーザー名</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>メールアドレス</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>パスワード</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>パスワードの確認</label>
                                        <input type="password" class="form-control" name="confirm_password">
                                    </div>

                                    <div class="form-group text-center">
                                        <button id="submit" class="btn btn-primary">追加する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
