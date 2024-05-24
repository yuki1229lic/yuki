@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .text-tag{
            text-align:center;
            color:#0074c1!important;
            text-decoration: underline!important;
        }
        button{border:none;}
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
                                    <p class="nav-title nav-active">1. 基本情報</p>
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
                                    <p class="nav-title">4. 実務スキル</p>
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
                    <section class="frame">
                        @foreach(['danger','warning', 'success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                                <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </p>
                            @endif
                        @endforeach
                        <form action="{{ route('user.web_history_main_db') }}" method="post">
                            @csrf
                            <section class="content-box mt-3">
                                <div class="box-title">
                                    <h4>個人情報</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>ご住所</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">郵便番号</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="user_postal_code" value="{{ $main->user_postal_code }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">都道府県</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select name="user_province" id="user_province" class="form-control">
                                                                <option value="北海道"> 北海道 </option>
                                                                <option value="青森県">青森県</option>
                                                                <option value="岩手県">岩手県</option>
                                                                <option value="宮城県">宮城県</option>
                                                                <option value="秋田県">秋田県</option>
                                                                <option value="山形県">山形県</option>
                                                                <option value="福島県">福島県</option>
                                                                <option value="茨城県">茨城県</option>
                                                                <option value="栃木県">栃木県</option>
                                                                <option value="群馬県">群馬県</option>
                                                                <option value="埼玉県">埼玉県</option>
                                                                <option value="千葉県">千葉県</option>
                                                                <option value="東京都">東京都</option>
                                                                <option value="神奈川県">神奈川県</option>
                                                                <option value="新潟県">新潟県</option>
                                                                <option value="富山県">富山県</option>
                                                                <option value="石川県">石川県</option>
                                                                <option value="福井県">福井県</option>
                                                                <option value="山梨県">山梨県</option>
                                                                <option value="長野県">長野県</option>
                                                                <option value="岐阜県">岐阜県</option>
                                                                <option value="静岡県">静岡県</option>
                                                                <option value="愛知県">愛知県</option>
                                                                <option value="三重県">三重県</option>
                                                                <option value="滋賀県">滋賀県</option>
                                                                <option value="京都府">京都府</option>
                                                                <option value="大阪府">大阪府</option>
                                                                <option value="兵庫県">兵庫県</option>
                                                                <option value="奈良県">奈良県</option>
                                                                <option value="和歌山県">和歌山県</option>
                                                                <option value="鳥取県">鳥取県</option>
                                                                <option value="島根県">島根県</option>
                                                                <option value="岡山県">岡山県</option>
                                                                <option value="広島県">広島県</option>
                                                                <option value="山口県">山口県</option>
                                                                <option value="徳島県">徳島県</option>
                                                                <option value="香川県">香川県</option>
                                                                <option value="愛媛県">愛媛県</option>
                                                                <option value="高知県">高知県</option>
                                                                <option value="福岡県">福岡県</option>
                                                                <option value="佐賀県">佐賀県</option>
                                                                <option value="長崎県">長崎県</option>
                                                                <option value="熊本県">熊本県</option>
                                                                <option value="大分県">大分県</option>
                                                                <option value="宮崎県">宮崎県</option>
                                                                <option value="鹿児島県">鹿児島県</option>
                                                                <option value="沖縄県">沖縄県</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">市区町村・町名</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="user_city" value="{{ $main->user_city }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">番地・建物名</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="user_address" value="{{ $main->user_address }}">
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>最寄駅</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="user_station" value="{{ $main->user_station }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>最終学歴 <br><span>※正式な学校名を入力してください</span></th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="user_education" value="{{ $main->user_education }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>運転免許証</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" value="1" name="user_drive_license" @if($main->user_drive_license == 1) {{'checked'}} @endif>あり</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" value="0" name="user_drive_license" @if($main->user_drive_license == 0) {{'checked'}} @endif>なし</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>希望給与(総支給月額)</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="user_salary" value="{{ $main->user_salary }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>健康状態など</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>腰痛・ヘルニア</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_back_pain" value="1" @if($main->user_back_pain == 1) {{'checked'}} @endif>あり</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_back_pain" value="0" @if($main->user_back_pain == 0) {{'checked'}} @endif>なし</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>てんかん</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_epilepsy" value="1" @if($main->user_epilepsy == 1) {{'checked'}} @endif>あり</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_epilepsy" value="0" @if($main->user_epilepsy == 0) {{'checked'}} @endif>なし</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>精神疾患</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_mental" value="1" @if($main->user_mental == 1) {{'checked'}} @endif>あり</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_mental" value="0" @if($main->user_mental == 0) {{'checked'}} @endif>なし</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>いれずみ・タトゥーの有無</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_tattoos" value="1" @if($main->user_tattoos == 1) {{'checked'}} @endif>あり</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_tattoos" value="0" @if($main->user_tattoos == 0) {{'checked'}} @endif>なし</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>過去に大きい怪我、
                                                病気、手術等の経験</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_hurt" value="1" @if($main->user_hurt == 1) {{'checked'}} @endif>あり</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_hurt" value="0" @if($main->user_hurt == 0) {{'checked'}} @endif>なし</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>自覚症状(不眠、めまい、 治療中の病気等)</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_insomnia" value="1" @if($main->user_isomnia == 1) {{'checked'}} @endif>あり</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" name="user_insomnia" value="0" @if($main->user_isomnia == 0) {{'checked'}} @endif>なし</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>備考</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>自己PR・希望条件等</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="user_condition" class="form-control" rows="5">{{ $main->user_condition }}</textarea>
                                                        </div>
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
        $(document).on('click', '#experience_plus' , function (){
            var html = $('.experience').html();
            $(".increment").after(html);
        })
    </script>
@endsection

