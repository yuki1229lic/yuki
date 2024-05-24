@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        th{
            width: 30%;
            vertical-align: middle!important;
            padding-left: 10%;
        }
        th,td{
            padding:20px 10px 20px 20px!important;
        }
        table{
            margin-bottom: 0px!important;
        }
        @media (max-width: 640px){
            .table {
                width: 100%!important;
                min-width: 0px!important;
            }
        }
        button{
            border:none;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    @foreach(['danger','warning', 'success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                    <i class="fa fa-times"></i>
                                </a>
                            </p>
                        @endif
                    @endforeach
                    <form action="{{ route('user.user_password_update_db') }}" method="post">
                        @csrf
                        <section class="frame mt-3">
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>パスワード変更</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>新規パスワード（※8文字以上）</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" name="new_password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>新規パスワードの確認</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" name="new_confirm_password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <button type="submit" class="action-button shadow animate orange col-md-push-4 col-md-4">変更する</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

