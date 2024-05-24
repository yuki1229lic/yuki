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
                                    <p class="nav-title nav-active">4. 実務スキル</p>
                                    @if($main->user_skill_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_aspect') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">5. 経験分野</p>
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
                        <form action="{{ route('user.web_history_skill_db') }}" method="post">
                            @csrf
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>実務スキル</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>1. 月間・週間工程表の作成が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_1" value="2" @if($main->user_skill_1 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_1" value="1" @if($main->user_skill_1 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_1" value="0" @if($main->user_skill_1 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>2. 写真管理が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_2" value="2" @if($main->user_skill_2 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_2" value="1" @if($main->user_skill_2 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_2" value="0" @if($main->user_skill_2 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>3. 出来形管理が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_3" value="2" @if($main->user_skill_3 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_3" value="1" @if($main->user_skill_3 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_3" value="0" @if($main->user_skill_3 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>4. 品質管理が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_4" value="2" @if($main->user_skill_4 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_4" value="1" @if($main->user_skill_4 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_4" value="0" @if($main->user_skill_4 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>5. 墨出しが出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_5" value="2" @if($main->user_skill_5 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_5" value="1" @if($main->user_skill_5 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_5" value="0" @if($main->user_skill_5 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>6. 検査立会い及び記録</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_6" value="2" @if($main->user_skill_6 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_6" value="1" @if($main->user_skill_6 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_6" value="0" @if($main->user_skill_6 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>7. 積算業務が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_7" value="2" @if($main->user_skill_7 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_7" value="1" @if($main->user_skill_7 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_7" value="0" @if($main->user_skill_7 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>8. 施主、設計事務所等の折衝が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_8" value="2" @if($main->user_skill_8 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_8" value="1" @if($main->user_skill_8 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_8" value="0" @if($main->user_skill_8 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>9. 測量業務が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_9" value="2" @if($main->user_skill_9 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_9" value="1" @if($main->user_skill_9 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_9" value="0" @if($main->user_skill_9 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>10. 安全管理が出来る</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_10" value="2" @if($main->user_skill_10 == 2) {{'checked'}} @endif>できる</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_10" value="1" @if($main->user_skill_10 == 1) {{'checked'}} @endif>自信がない</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_skill_10" value="0" @if($main->user_skill_10 == 0) {{'checked'}} @endif>できない</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>実務スキル（プラント）</h4>
                                </div>
                                <?php
                                    $skill_capable = json_decode($main->user_skill_capable, true);
                                ?>
                                <div class="box-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>経験したことのある項目にチェックを入れてください（複数チェック可）</p>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="新設工事"> 新設工事</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="メンテナンス工事"> メンテナンス工事</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="塔"> 塔</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="点検・検査"> 点検・検査</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="熱交換器"> 熱交換器</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="配管"> 配管</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="貯槽タンク"> 貯槽タンク</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="回転機"> 回転機</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="弁類（数物）"> 弁類（数物）</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="据え付け"> 据え付け</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="設計"> 設計</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="元方安全"> 元方安全</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="統括"> 統括</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="安全担当"> 安全担当</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="資材管理"> 資材管理</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="建築"> 建築</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="土木"> 土木</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox"  class="skill_capable" name="user_skill_capable[]" value="電気"> 電気</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="skill_capable" name="user_skill_capable[]" value="計装"> 計装</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>客先での対応スキル</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>1. 客先での対応</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_business_capable" value="2" @if($main->user_business_capable == 2) {{'checked'}} @endif>全体の調整含め可能</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_business_capable" value="1" @if($main->user_business_capable == 1) {{'checked'}} @endif>担当として協議可能</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_business_capable" value="0" @if($main->user_business_capable == 0) {{'checked'}} @endif>その他</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
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
        var checked =  @json($skill_capable, JSON_UNESCAPED_UNICODE);
        for(i=0; i<checked.length; i++){
            $('.skill_capable').each( function (){
                var result = $(this).val()
                if( checked[i] == result){
                    $(this).prop("checked",true);
                }
            })
        }
    </script>
@endsection

