@extends('layouts.jober.jober_main_layout')
@section('content')
    <section class="user-panel">
        <div class="container">
            @foreach(['danger','warning', 'success','info'] as $msg)
                @if(Session::has('alert-'.$msg))
                    <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                            <i class="fa fa-times"></i>
                        </a>
                    </p>
                @endif
            @endforeach
            <form action="{{ route('jober.jober_password_update_db') }}" method="post">
                @csrf
                <section class="frame mt-3">
                    <section class="content-box">
                        <div class="box-title">
                            <h4>パスワード変更</h4>
                        </div>
                        <div class="table-content">
                            <div class="passwordBox">
                                <h5>新規パスワード<span>（※8文字以上）</span></h5>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="new_password" required>
                                </div>
                                <h5>新規パスワードの確認</h5>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="new_confirm_password" required>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="action-button submitButton">変更する</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </form>
        </div>
    </section>
@endsection

