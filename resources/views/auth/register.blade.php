@extends('layouts.front.front_main_layout')
@section('content')
    {!! RecaptchaV3::initJs() !!}
    <style>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css");
        .container {
            padding: 50px 0;
        }
        #regstarBox {
            width: 920px;
            margin: 0 auto;
            padding: 50px 30px;
            background-color: #ffffff;
        }
        .pageTitle {
            margin-bottom: 40px;
            font-size: 40px;
            font-weight: bold;
            text-align: center;
        }
        .text-title{
            margin-left: 15px;
        }
        .registerTable {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 40px;
        }
        .registerTable th {
            position: relative;
            width: 260px;
            padding: 10px 20px;
            background-color: #f0faff;
            font-weight: bold;
            border: 1px solid #dddddd;
        }
        .registerTable td {
            width: calc(100% - 260px);
            padding: 10px 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }
        .registerTable th .must {
            position: absolute;
            right: 20px;
            top:50%;
            width: 3em;
            padding: 4px 0;
            color: #ffffff;
            font-size: 0.8em;
            font-weight:normal;
            text-align: center;
            line-height: 1;
            background-color:#ee2233;
            border-radius: 3px;
            transform: translate(0, -50%);
        }
        .registerTable td .fBox {
            display: flex;
            gap: 1em;
            align-items: center;
        }
        .registerTable td .fBox.col {
            flex-direction: column;
        }
        .registerTable td .tit {
            display: blosk;
            padding: 0 0.5em;
        }
        .registerTable td .text-title {
            display: flex;
            gap: 0.5em;
            align-items: center;
        }
        .registerTable td .button {
            height: 45px;
            white-space: nowrap;
            cursor: pointer;
        }
        .buttonArea {
            padding: 20px;
        }
        .action-button {
            position: relative;
            display: block;
            width: fit-content;
            padding: 5px 15px 7px 15px;
            margin: 0px 10px 10px 0px;
            color: #ffffff;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold !important;
            line-height: 1.6;
            text-align: center;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 -2px 1px 0 rgba(0, 0, 0, 0.2) inset !important;
            float: left;
        }
        .action-button.button-type_blue {
            background: linear-gradient(45deg, #0099ff, #0074c1);
        }
        .action-button.button-type_blue:hover {
            background: linear-gradient(-45deg, #0099ff, #0074c1);
        }
        @media only screen and (max-width: 640px) {
            #regstarBox {
                width: 100%;
                padding: 30px 20px;
            }
            .pageTitle {
                margin-bottom: 20px;
                font-size: 30px;
            }
            .registerTable th {
                display: block;
                width: 100%;
                font-size: 15px;
            }
            .registerTable td {
                display: block;
                width: 100%;
                font-size: 15px;
            }
        }
    </style>
<div class="container">
    <div id="regstarBox">
        <h2 class="pageTitle">無料会員登録</h2>
        @foreach(['danger','warning', 'success','info'] as $msg)
            @if(Session::has('alert-'.$msg))
            <p class="alert alert-{{$msg}}">{!! Session::get('alert-'.$msg) !!}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">
                    <i class="fa fa-times"></i>
                </a>
            </p>
            @endif
        @endforeach
        <form method="POST" action="{{ route('register') }}">
            @csrf

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ユーザー名') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メール') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワードの確認') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('新規登録する') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

            <table class="registerTable">
                <tbody>
                    <!--tr>
                        <th>経験の有無</th>
                        <td>
                            <div class="fBox">
                                <label class="v text-title"><input type="radio" name="experience" value="1" checked>あり</label>
                                <label class="text-title"><input type="radio" name="experience" value="2">なし</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>車の所有</th>
                        <td>
                            <div class="fBox">
                                <label class="text-title"><input type="radio" name="car" value="1" checked>あり</label>
                                <label class="text-title"><input type="radio" name="car" value="2">なし</label>
                            </div>
                        </td>
                    </tr-->
                    <tr>
                        <th>氏名(フルネーム)<span class="must">必須</span></th>
                        <td>
                            <div class="fBox">
                                    <input type="text" name="last_name" class="form-control" placeholder="性" required>
                                    <input type="text" name="first_name" class="form-control" placeholder="名" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ふりがな<span class="must">必須</span></th>
                        <td>
                            <div class="fBox">
                                <input type="text" name="sei" class="form-control" placeholder="せい" required>
                                <input type="text" name="mei" class="form-control" placeholder="めい" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td>
                            <div class="fBox">
                                <label class="text-title"><input type="radio" name="sex" value="1" checked>男性</label>
                                <label class="text-title"><input type="radio" name="sex" value="2">女性</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>生年月日<span class="must">必須</span></th>
                        <td>
                            <div class="fBox">
                                <select name="birth_year" tabindex="1" class="form-control">
                                    <?php for($i=1930; $i<=2020;$i++){ ?>
                                    <option>{{ $i }}</option>
                                    <?php } ?>
                                </select><span class="tit">年</span>
                                <select  name="birth_month" tabindex="1" class="form-control">
                                    <?php for($i=1; $i<=12;$i++){
                                        if($i < 10 ){
                                        ?>
                                        <option>0{{ $i }}</option>
                                    <?php }else{?>
                                        <option>{{ $i }}</option>
                                    <?php }}?>
                                </select><span class="tit">月</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>郵便番号<span class="must">必須</span></th>
                        <td>
                            <div class="fBox">
                                <input type="text" name="zip" id="zip" class="form-control" placeholder="郵便番号" pattern="^[0-9]{7}$" required>
                                <button type="button" id="zipSerchButton" class="button">郵便番号から入力</button>
                            </div>
                            ※ハイフンなし半角数字7桁で入力してください。
                        </td>
                    <tr>
                    <tr>
                        <th>都道府県<span class="must">必須</span></th>
                        <td>
                            <select name="ken_id" id="ken" class="ken_id form-control" tabindex="6" required>
                                <option value="">選択してください</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>市区町村<span class="must">必須</span></th>
                        <td>
                            <select name="city_id" id="city" class="city form-control" tabindex="6" required>
                                <option value="">選択してください</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>携帯番号<span class="must">必須</span></th>
                        <td>
                            <input type="text" name="phone" class="form-control" placeholder="携帯番号" required>
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス<span class="must">必須</span></th>
                        <td>
                            <div class="fBox col">
                                <input type="text" name="email" class="form-control" placeholder="メールアドレス" required>
                                <input type="text" name="email_confirmation" class="form-control" placeholder="メールアドレス (確認用)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>パスワード<span class="must">必須</span></th>
                        <td>
                            <div class="fBox col">
                                <input type="password" name="password" class="form-control" placeholder="パスワード" required>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="パスワード (確認用)" required>
                            </div>
                            ※8文字以上入力してください。
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="text-title"><input type="checkbox" name="email_receive">メールマガジンの配信を許可する</label>
                            <label class="text-title"><input type="checkbox" name="auto_login" required>次回から自動ログインする</label>
                            <div class="text-title"><input type="checkbox" name="agree" required>
                                <a href="/privacy" style="color:#0074c1;text-decoration: underline;" target="_blank">プライバシーポリシー</a>と
                                <a href="/terms_and_service"  style="color:#0074c1;text-decoration: underline;" target="_blank">利用規約</a>
                                に同意した上で、お申込みください。
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="buttonArea">
                <button type="submit" class="btn-submit action-button button-type_blue"><i class="fa-regular fa-circle-check" style="color: #ffffff;"></i>&nbsp;新規登録する</button>
            </div>
        </form>
    </div>
</div>
<script>
    $.getJSON('/api/prefectureList/', function(data) {
        $.each(data, function (index, data2) {
            $('#ken').append($('<option>').text(data2.ken_name).val(data2.ken_id));
        });
    });
    $('#ken').change(function () {
        if (this.value) {
            let ken_id = this.value;
            $('#city' + ' option').remove();
            $('#city').append($('<option>').text('選択してください').val(''));
            $.getJSON('/api/getCityList/' + ken_id, function(data) {
                $.each(data, function (index, data2) {
                    $('#city').append($('<option>').text(data2.city_name).val(data2.city_id));
                });
            });
        }
    });

    $(document).ready(function(){
        $('#zipSerchButton').on('click', function(){
            var zip = $('#zip').val();
            if(zip.length === 7 || zip.length === 8){
                $.ajax({
                    url: '/api/getKenCityByPost/' +  zip,
                    type: 'GET',
                    dataType: 'json',
                    data:{
                        zip: zip
                    }
                }).done(function(serchData){
                    if(serchData){
                        $('#ken').val(serchData[0].ken_id);
                        $('#city' + ' option').remove();
                        $('#city').append($('<option>').text('選択してください').val(''));

                        $.getJSON('/api/getCityList/' + serchData[0].ken_id, function(data) {
                            $.each(data, function (index, data2) {
                                $('#city').append($('<option>').text(data2.city_name).val(data2.city_id));
                            });
                            $('#city').val(serchData[0].city_id);
                        });
                    } else {
                        $("#ken").val('');
                        $("#city").val('');
                        alert("正しい郵便番号を入力してください。");
                    }
                }).fail(function(XMLHttpRequest, textStatus, errorThrown){
                    alert("通信に失敗しました。");
                });
            }
        });
    });
</script>
@endsection
