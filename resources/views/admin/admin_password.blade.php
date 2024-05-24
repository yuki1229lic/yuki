@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                @foreach(['danger','warning', 'success','info'] as $msg)
                                    @if(Session::has('alert-'.$msg))
                                        <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                                <fa class="fa fa-times"></fa>
                                            </a>
                                        </p>
                                    @endif
                                @endforeach
                                <form method="post" action="{{ route('admin.password_update') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>新規パスワード</label>
                                        <input name="password" class="form-control" type="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>パスワードの確認</label>
                                        <input name="confirm_password" class="form-control" type="password" required>
                                    </div>

                                    <div class="com-md-12 text-center">
                                        <button class="btn btn-primary" type="submit">変更する</button>
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

