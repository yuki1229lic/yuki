@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ダッシュボード</h1>
                    </div>

                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($jobs) }}<sup style="font-size: 20px">数</sup></h3>
                                <p>登録された案件</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.public_job_list') }}" class="small-box-footer">詳細を見る <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($jobers) }}<sup style="font-size: 20px">人</sup></h3>
                                <p>登録された企業</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.enterprise_list') }}" class="small-box-footer">詳細を見る <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ count($users) }}<sup style="font-size: 20px">人</sup></h3>
                                <p>登録されたユーザー</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.user_list') }}" class="small-box-footer">詳細を見る <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <div class="small-box bg-danger">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>65</h3>--}}
{{--                                <p>Unique Visitors</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-pie-graph"></i>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="small-box-footer">詳細を見る <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <form method="POST" action="{{ route('admin.impersonate') }}">
                    @csrf
                    <div class="form-group row userLogin">
                        <label for="user_id" class="col-md-4 col-form-label text-md-left">ユーザー・企業アカウントログイン</label>
                        <input id="user_id" type="text" class="form-control" name="user_id" placeholder="メールアドレスを入力してください">
                        <input type="submit" name="submit">
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
