@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .text-tag{
            text-align:center;
            color:#0074c1!important;
            text-decoration: underline!important;
        }
        button{ border:none;}
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
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="first-box mt-5">
                        <p class="text-left"><a href="{{ route('user.history_resume') }}" class="text-tag">既に職務経歴書をお持ちの方はこちらから送付してください。</a></p>
                    </section>
                    <section class="content-box mt-5">
                        <div class="row">
                            <a href=" {{ route('user.web_history_main') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">1. 基本情報</p>
                                    @if($main->user_basic_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_experience') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">2. 職務・工事経歴</p>
                                    @if($main->user_experience_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_qualification') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">3. 保有資格</p>
                                    @if($main->user_qualification_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_skill') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title ">4. 実務スキル</p>
                                    @if($main->user_skill_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_aspect') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title nav-active">5. 経験分野</p>
                                    @if($main->user_history_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </section>
                    <section class="frame mt-3">
                        @foreach(['danger','warning', 'success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                                <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </p>
                            @endif
                        @endforeach
                        <form action="{{ route('user.web_history_aspect_db') }}" method="post">
                            @csrf
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>経験分野・プラント</h4>
                                </div>
                                <?php
                                    $user_history_1 = json_decode($main->user_history_1, true);
                                ?>
                                <div class="box-content">
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="原子力発電所"> 原子力発電所</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="地熱発電所"> 地熱発電所</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="廃棄物処理プラント"> 廃棄物処理プラント</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="火力発電所"> 火力発電所</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="石油プラント"> 石油プラント</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="電力"> 電力</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="水力発電所"> 水力発電所</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="ケミカルプラント"> ケミカルプラント</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="ガス"> ガス</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="風力発電所"> 風力発電所</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="水処理プラント"> 水処理プラント</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="薬品"> 薬品</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="住宅"> 住宅</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="店舗"> 店舗</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="資材管理"> 資材管理</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="user_history_1" name="user_history_1[]" value="建築"> 建築</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="table-content" style="padding:30px 0;">
                                    <div class="row">
                                        <button type="submit" class="action-button shadow animate orange col-md-push-4 col-md-4">登録する</button>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <script>
        var checked =  @json($user_history_1 , JSON_UNESCAPED_UNICODE);
        for(i=0; i<checked.length; i++){
            $('.user_history_1').each( function (){
                var result = $(this).val()
                if( checked[i] == result){
                    $(this).prop("checked",true);
                }
            })
        }
    </script>
@endsection

