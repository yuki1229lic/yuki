@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>新規企業追加</h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container">
                <div class="card">
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
                                <form action="{{ route('admin.enterprise_add_db') }}" method="post" id="company_form">
                                    @csrf
                                    <div class="form-group">
                                        <label>企業名</label>
                                        <input type="text" class="form-control @error('store_name') is-invalid @enderror" name="store_name">
                                        @error('store_name')
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
