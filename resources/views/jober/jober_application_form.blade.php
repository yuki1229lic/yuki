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

        .text-title {
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
            top: 50%;
            width: 3em;
            padding: 4px 0;
            color: #ffffff;
            font-size: 0.8em;
            font-weight: normal;
            text-align: center;
            line-height: 1;
            background-color: #ee2233;
            border-radius: 3px;
            transform: translate(0, -50%);
        }

        .registerTable td .fBox {
            display: flex;
            gap: 1em;
            align-items: center;
        }

        .registerTable td .fBox_1 {
            display: flex;
            gap: 1em;            
        }

        .width-80 {
            width: 80%;
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
            color: white;
            border: none;
            background: linear-gradient(45deg, #0099ff, #0074c1);
            border-radius: 5px;
        }

        .registerTable td .button:hover {
            background: linear-gradient(45deg, #0074c1, #0099ff);
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

            .time_checkbox {
                gap: 4px !important;
            }

            .p-step-bar-container {
                display: block !important;
            }
        }

        .remove-extend-field:hover {
            cursor: pointer;
            text-decoration: none;
        }

        .remove-extend-field {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #949494;
            color: white;
            font-size: 28px;
        }

        #extend-field {
            padding: 15px;
        }

        #extend {
            text-align: center;
            font-size: 16px;
            line-height: 1;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid #0099ff;
            background-color: #fff;
            color: #0099ff;
            font-weight: bold;
            height: 48px;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }

        .w-35 {
            width: 40%;
            margin-bottom: 15px;
        }

        .m-15 {
            margin-bottom: 15px;
        }

        .w-30 {
            width: 30px !important;
            height: 30px !important;
        }

        .time_checkbox {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding-bottom: 40px;
            background-color: #F9F9F9;
            padding: 10px;
            padding-top: 0px;
        }

        .option {
            border: 1px solid #a3a3a3;
            background: #a3a3a3;
            color: #fff;
            position: absolute;
            right: 20px;
            top: 50%;
            width: 3em;
            padding: 4px 0;
            font-size: 0.8em;
            font-weight: normal;
            text-align: center;
            line-height: 1;
            border-radius: 3px;
            transform: translate(0, -50%);
        }

        .p-step-bar-container {
            position: sticky;
            width: 100%;
            top: 0;
            background-color: #fff;
            box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.1);
            /* z-index: 100; */
            display: none;
        }

        .p-step-bar {
            display: flex;
            padding: 14px 0 8px;
        }

        ul {
            list-style: none;
        }

        .is-current {
            color: #000;
            margin-top: -4px;
        }

        .p-step-bar__item {
            position: relative;
            flex-basis: 33.3333%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            color: #999;
            text-align: center;
            line-height: 1;
        }

        .is-current {
            border-color: #fd7085 !important;
            margin: 0px !important;
        }

        .p-step-bar__num {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 2em;
            height: 2em;
            font-size: 12px;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 50%;
            margin-bottom: 0.25em;
        }

        .both__show:before {
            content: "";
            position: absolute;
            top: calc(1em - 1px);
            width: 50%;
            height: 2px;
            background-color: #ccc;
            z-index: -1;
            left: 0;
        }

        .both__show:after {
            content: "";
            position: absolute;
            top: calc(1em - 1px);
            width: 50%;
            height: 2px;
            background-color: #ccc;
            z-index: -1;
            right: 0;
        }

        .before__none:before {
            content: "";
            position: absolute;
            top: calc(1em - 1px);
            width: 50%;
            height: 2px;
            background-color: #ccc;
            z-index: -1;
            right: 0;
        }

        .after__none:after {
            content: "";
            position: absolute;
            top: calc(1em - 1px);
            width: 50%;
            height: 2px;
            background-color: #ccc;
            z-index: -1;
            left: 0;
        }

        @media only screen and (max-width: 425px) {
            .sp_hidden {
                display: none;
            }

            .sp_show {
                display: block !important;
            }

            .sp_btn_hidden {
                display: none;
            }
        }

        .btn_primary,
        .btn_primary2 {
            padding: 15px;
            width: 100%;
            font-weight: bold !important;
            line-height: 1.6;
            box-shadow: none;
            background: linear-gradient(45deg, #0099ff, #0074c1);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn_primary:hover,
        .btn_primary2:hover {
            background: linear-gradient(45deg, #0074c1, #0099ff);
        }

        .sp_show {
            display: none;
        }

        .is-current.before__none.custom-before {
            position: relative;
        }

        .is-current.before__none.custom-before::before {
            background-color: #fd7085 !important;
        }

        .color_white {
            color: white !important;
        }

        .bg_pink {
            background-color: #fd7085 !important;
        }

        .d_none {
            display: none !important;
        }

        .required-message {
            color: white;
            font-size: 12px;
            background-color: #ee2233;
            padding: 5px;
            border-radius: 3px;
            right: 0;
            bottom: 9px;
            display: none;
        }

        td {
            position: relative;
        }

        .job_post_title {
            background-color: #FAFAFA;
            padding: 10px 15px;
        }

        .job_company_name {
            padding: 10px 15px;
        }

        .table-header {
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .d-flex {
            display: flex;
            width: 100%;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .gap-5 {
            gap: 5px;
            display: flex;
            align-items: center;
        }

        .gap-5 label {
            margin-bottom: 0px;
        }

        .pb-10 {
            padding: 10px;
            background-color: #F9F9F9;
        }

        .error {
            color: red;
        }

        .relative {
            display: block !important
        }

        .duplication {
            background-color: red;
            border-radius: 5px;
            padding: 2px 5px;
            color: white;
            width: fit-content;
            display: none
        }
        .w-100 {
            width: 100%;
        }
        .pb-15 {
            padding-bottom: 15px;
        }
    </style>
    <nav class="p-step-bar-container">
        <ul class="p-step-bar js-step-bar">
            <li class="p-step-bar__item js-step-bar__item before__none">
                <span class="p-step-bar__num span_first js-step-bar__num is-current">1</span>
                <span>経験<span id="js-step-bar__credential-text">・資格</span></span>
            </li>
            <li class="p-step-bar__item js-step-bar__item both__show">
                <span class="p-step-bar__num span_second js-step-bar__num">2</span>基本情報
            </li>
            <li class="p-step-bar__item js-step-bar__item after__none">
                <span class="p-step-bar__num span_third js-step-bar__num">3</span>完了
            </li>
        </ul>
    </nav>
    <div class="container">
        <div id="regstarBox">
            <h2 class="pageTitle">求人への応募</h2>
            @if (!Auth::check())
                <div class="d-flex justify-end">
                    <a href="{{ route('home.jobAppForm_auth', $job->id) }}"
                        class="action-button shadow animate green">ログイン</a>
                </div>
            @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                            <i class="fa fa-times"></i>
                        </a>
                    </p>
                @endif
            @endforeach
            <form method="POST" id="myform"
                action="{{ Auth::check() ? route('user.bid_post') : route('bid_post_unauth') }}">
                @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">
                <input type="hidden" name="jober_id" value="{{ $job->jober_id }}">
                <table class="registerTable">
                    <tbody>
                        <tr>
                            <th>求人タイトル</th>
                            <td>
                                <div class="table-header">
                                    <p class="job_post_title">{{ $job->post_title }}</p>
                                    <p class="job_company_name">{{ $jober->company_name }}</p>
                                </div>
                            </td>
                        </tr>
                        @if (!Auth::check())
                            <tr>
                                <th>軽貨物運送業の経験<span class="must">必須</span></th>
                                <td>
                                    <div class="fBox first_step1">
                                        <label class="text-title"><input type="radio" name="ligt_cargo_experience"
                                                value="1">有り</label>
                                        <label class="text-title"><input type="radio" name="ligt_cargo_experience"
                                                value="2" checked>無し</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>持ち込み車両の有無<span class="must">必須</span></th>
                                <td>
                                    <div class="fBox first_step2">
                                        <label class="text-title"><input type="radio" name="vehicle"
                                                value="1">有り</label>
                                        <label class="text-title"><input type="radio" name="vehicle" value="2"
                                                checked>無し</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>氏名(フルネーム)<span class="must">必須</span></th>
                                <td>
                                    <!-- <div class="fBox"> -->
                                        <input type="text" name="full_name" id="full_name" class="form-control"
                                            placeholder="山田 太郎" required />
                                        <span class="required-message">必須です。</span>
                                    <!-- </div> -->
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>ふりがな<span class="must">必須</span></th>
                                <td>
                                    <!-- <div class="fBox"> -->
                                        <input type="text" name="sei_mei" id="sei_mei" class="form-control"
                                            placeholder="やまだ たろう" required />
                                        <span class="required-message">必須です。</span>
                                    <!-- </div> -->
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>性別</th>
                                <td>
                                    <div class="fBox">
                                        <label class="text-title"><input type="radio" name="sex" value="1"
                                                checked>男性</label>
                                        <label class="text-title"><input type="radio" name="sex"
                                                value="2">女性</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>生年月日<span class="must">必須</span></th>
                                <td>
                                    <div class="fBox">
                                        <select name="birth_year" tabindex="1" class="form-control">
                                            <?php for($i=1930; $i<=2020;$i++){ ?>
                                            <option>{{ $i }}</option>
                                            <?php } ?>
                                        </select><span class="tit">年</span>
                                        <select name="birth_month" tabindex="1" class="form-control">
                                            <?php for($i=1; $i<=12;$i++){
                                        if($i < 10 ){
                                        ?>
                                            <option>0{{ $i }}</option>
                                            <?php }else{?>
                                            <option>{{ $i }}</option>
                                            <?php }}?>
                                        </select><span class="tit">月</span>
                                        <select name="birth_day" tabindex="1" class="form-control">
                                            <?php for($i=1; $i<=31; $i++){
                                        if($i < 10 ){
                                        ?>
                                            <option>0{{ $i }}</option>
                                            <?php }else{?>
                                            <option>{{ $i }}</option>
                                            <?php }}?>
                                        </select><span class="tit">日</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>郵便番号<span class="must">必須</span></th>
                                <td>
                                    <div class="fBox_1">
                                        <div class="width-80">
                                            <input type="text" name="zip" id="zip" class="form-control" placeholder="郵便番号" pattern="^[0-9]{7}$" required />
                                            <span class="required-message">必須です。</span>
                                        </div>
                                        <button type="button" id="zipSerchButton" class="button">郵便番号から入力</button>
                                    </div>
                                    ※ハイフンなし半角数字7桁で入力してください。
                                </td>
                            <tr>
                            <tr class="sp_hidden">
                                <th>都道府県<span class="must">必須</span></th>
                                <td>
                                    <select name="ken_id" id="ken" class="ken_id form-control" tabindex="6"
                                        required>
                                        <option value="">選択してください</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>市区町村<span class="must">必須</span></th>
                                <td>
                                    <select name="city_id" id="city" class="city form-control" tabindex="6"
                                        required>
                                        <option value="">選択してください</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>携帯番号<span class="must">必須</span></th>
                                <td>
                                    <input type="text" name="phone" class="form-control" placeholder="携帯番号"
                                        required />
                                    <span class="required-message">必須です。</span>
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>メールアドレス<span class="must">必須</span></th>
                                <td>
                                    <div class="fBox col relative">
                                        <input type="text" name="email" class="form-control" placeholder="メールアドレス"
                                            required>
                                        @if ($errors->has('email'))
                                            <span class="duplication">{{ $errors->first('email') }}</span>
                                        @endif
                                        <p class="duplication">メールアドレスはすでに登録されています。</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sp_hidden">
                                <th>パスワード<span class="must">必須</span></th>
                                <td>
                                    <div class="fBox col pb-15">
                                        <div class="w-100">
                                            <input type="password" name="password" class="form-control" placeholder="パスワード"
                                                required>
                                            <span class="required-message">必須です。</span>
                                        </div>
                                        <div class="w-100">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="パスワード (確認用)" required>
                                            <span class="required-message">必須です。</span>
                                        </div>
                                    </div>
                                    ※8文字以上使用
                                </td>
                            </tr>
                        @endif
                        <tr class="sp_hidden">
                            <th class="interview">面接可能日時<span class="option">任意</span></th>
                            <td>
                                <p class="m-15">※可能日時を入力いただく欄ですので、確定日時ではありません。</p>
                                <div id="extend-field">
                                    <div class="flex pb-10">
                                        <input type="date" name="date[]" class="w-35" />                                        
                                    </div>
                                    <div class="time_checkbox">
                                        <div class="flex gap-5">
                                            <input type="hidden" name="time1[]" value="0">
                                            <input type="checkbox" class="w-20"><label>午前中</label>
                                        </div>
                                        <div class="flex gap-5">
                                            <input type="hidden" name="time2[]" value="0">
                                            <input type="checkbox" class="w-20"><label>12時〜14時</label>
                                        </div>
                                        <div class="flex gap-5">
                                            <input type="hidden" name="time3[]" value="0">
                                            <input type="checkbox" class="w-20"><label>14時〜16時</label>
                                        </div>
                                        <div class="flex gap-5">
                                            <input type="hidden" name="time4[]" value="0">
                                            <input type="checkbox" class="w-20"><label>16時〜18時</label>
                                        </div>
                                        <div class="flex gap-5">
                                            <input type="hidden" name="time5[]" value="0">
                                            <input type="checkbox" class="w-20"><label>18時〜20時</label>
                                        </div>
                                        <div class="flex gap-5">
                                            <input type="hidden" name="time6[]" value="0">
                                            <input type="checkbox" class="w-20"><label>終日可</label>
                                        </div>
                                    </div>
                                </div>
                                <button id="extend">+ 日時を追加する</button>
                            </td>
                        </tr>
                        <tr class="sp_hidden">
                            <td colspan="2">
                                <h3 class="mt-4">備考・PR（任意） : </h3>
                                <textarea name="bid_content" class="form-control mt-1" rows="10" placeholder="連絡希望の時間帯やその他伝えたい内容を記入します。"></textarea>
                            </td>
                        </tr>
                        <tr class="sp_hidden">
                            <td colspan="2">
                                <label class="text-title"><input type="checkbox"
                                        name="email_receive">メールマガジンの配信を許可する</label>
                                <label class="text-title"><input type="checkbox" name="auto_login"
                                        required>次回から自動ログインする</label>
                                <div class="text-title"><input type="checkbox" name="agree" required>
                                    <a href="/privacy" style="color:#0074c1;text-decoration: underline;"
                                        target="_blank">プライバシーポリシー</a>と
                                    <a href="/terms_and_service" style="color:#0074c1;text-decoration: underline;"
                                        target="_blank">利用規約</a>
                                    に同意した上で、お申込みください。
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button type="button" class="btn_primary sp_show">次へ</button>
                </div>
                <div>
                    <button type="button" class="btn_primary2 sp_show d_none">同意して応募を完了する</button>
                </div>
                <div class="buttonArea sp_btn_hidden">
                    <button type="button" class="btn-submit action-button button-type_blue"><i
                            class="fa-regular fa-circle-check" style="color: #ffffff;"></i>&nbsp;同意して応募を完了する</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $.getJSON('/api/prefectureList/', function(data) {
            $.each(data, function(index, data2) {
                $('#ken').append($('<option>').text(data2.ken_name).val(data2.ken_id));
            });
        });
        $('#ken').change(function() {
            if (this.value) {
                let ken_id = this.value;
                $('#city' + ' option').remove();
                $('#city').append($('<option>').text('選択してください').val(''));
                $.getJSON('/api/getCityList/' + ken_id, function(data) {
                    $.each(data, function(index, data2) {
                        $('#city').append($('<option>').text(data2.city_name).val(data2.city_id));
                    });
                });
            }
        });
        $(document).ready(function() {
            $.fn.autoKana("input[name='full_name']", "input[name='sei_mei']", {
                katakana: false
            });
        });


        $(document).ready(function() {
            $('#zipSerchButton').on('click', function() {
                var zip = $('#zip').val();
                if (zip.length === 7 || zip.length === 8) {
                    $.ajax({
                        url: '/api/getKenCityByPost/' + zip,
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            zip: zip
                        }
                    }).done(function(serchData) {
                        if (serchData) {
                            $('#ken').val(serchData[0].ken_id);
                            $('#city' + ' option').remove();
                            $('#city').append($('<option>').text('選択してください').val(''));

                            $.getJSON('/api/getCityList/' + serchData[0].ken_id, function(data) {
                                $.each(data, function(index, data2) {
                                    $('#city').append($('<option>').text(data2
                                        .city_name).val(data2.city_id));
                                });
                                $('#city').val(serchData[0].city_id);
                            });
                        } else {
                            $("#ken").val('');
                            $("#city").val('');
                            alert("正しい郵便番号を入力してください。");
                        }
                    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("通信に失敗しました。");
                    });
                }
            });

            $("#extend").click(function(e) {
                e.preventDefault();
                
                $("#extend-field").append(
                    `<div class="flex pb-10">
                        <input type="date" name="date[]" class="w-35" />
                        <a class="remove-extend-field">&times;</a>
                    </div>
                    <div class="time_checkbox">
                        <div class="flex gap-5">
                            <input type="hidden" name="time1[]" value="0">
                            <input type="checkbox" class="w-20"><label>午前中</label>
                        </div>
                        <div class="flex gap-5">
                            <input type="hidden" name="time2[]" value="0">
                            <input type="checkbox" class="w-20"><label>12時〜14時</label>
                        </div>
                        <div class="flex gap-5">
                            <input type="hidden" name="time3[]" value="0">
                            <input type="checkbox" class="w-20"><label>14時〜16時</label>
                        </div>
                        <div class="flex gap-5">
                            <input type="hidden" name="time4[]" value="0">
                            <input type="checkbox" class="w-20"><label>16時〜18時</label>
                        </div>
                        <div class="flex gap-5">
                            <input type="hidden" name="time5[]" value="0">
                            <input type="checkbox" class="w-20"><label>18時〜20時</label>
                        </div>
                        <div class="flex gap-5">
                            <input type="hidden" name="time6[]" value="0">
                            <input type="checkbox" class="w-20"><label>終日可</label>
                        </div>
                    </div>`
                );
                checkDivCount();
                timeCheck();
            });

            const timeCheck = () => {
                $(".time_checkbox input[type='checkbox']").change(function(e) {
                    console.log("this is here");
                    if ($(this).is(':checked')) {
                        $(this).prev('input[type="hidden"]').val(1);
                    } else {
                        $(this).prev('input[type="hidden"]').val(0);
                    }
                });
            }

            $('input[name="email"]').on('blur', function(e) {
                const data = {
                    email: $('input[name="email"]').val()
                };
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const options = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                };

                fetch('/email-check', options)
                    .then(response => response.json())
                    .then((data) => {
                        data ? $('.duplication').css('display', 'block') : $('.duplication').css(
                            'display', 'none')
                        data ? $('.btn-submit').attr('disabled', true) : $('.btn-submit').attr(
                            'disabled', false)
                    })
                    .catch(error => console.error('Error:', error));
            });

            $("#extend-field").on("click", ".add-text-field", function(e) {
                e.preventDefault();
                $("#extend-field").append(
                    '<div><input type="text"><a class="remove-extend-field"><button>&times;</button></a></div>'
                );
            });

            $("#extend-field").on("click", ".remove-extend-field", function(e) {
                e.preventDefault();
                var parentDiv = $(this).closest('.flex');
                parentDiv.next('.time_checkbox').remove();
                parentDiv.remove();
                checkDivCount();
            });            

            $('.btn_primary').on('click', function() {
                $('input[type="radio"]').change(checkRadios);
                checkRadios();
            });
            $('.btn_primary2').on('click', function() {
                checkInputs();
            });

            function checkDivCount() {
                var count = $("#extend-field .pb-10").length;
                if (count >= 3) {
                    $("#extend").prop("disabled", true);
                } else {
                    $("#extend").prop("disabled", false);
                }
            }

            function checkRadios() {
                var isChecked1 = $('.first_step1 input[type="radio"]:checked').length > 0;
                var isChecked2 = $('.first_step2 input[type="radio"]:checked').length > 0;

                if (isChecked1 && isChecked2) {
                    $('.btn_primary').prop('disabled', false);

                    $('.sp_hidden').removeClass('sp_hidden');
                    $('.span_second').addClass('is-current');
                    $('.is-current .before__none').addClass('custom-before');
                    $('.span_first').text('✔');
                    $('.span_first').addClass('color_white bg_pink');
                    $('.btn_primary2').removeClass('d_none');
                    $('.btn_primary').addClass('d_none');
                    console.log('un-disabled----->');
                } else {
                    $('.btn_primary').prop('disabled', true);
                    console.log("disabled------->");
                }
            }

            function checkInputs() {
                var allFilled = true;

                $('table input').each(function() {
                    if ($(this).val() === '') {
                        allFilled = false;
                        return false;
                    }
                });

                if (allFilled) {
                    $('.btn_primary2').remove();

                    $('.sp_btn_hidden').removeClass('sp_btn_hidden');
                    $('.span_third').addClass('is-current');
                    $('.span_second').text('✔');
                    $('.span_second').addClass('color_white bg_pink');
                    $('.btn_primary2').addClass('d_none');
                } else {
                    $('.btn_primary2').prop('disabled', true);
                }
            }

            $('.btn-submit, .btn_primary2').on('click', function(e) {
                let isValid = true;
                $('input[required]').each(function() {
                    if (!$(this).val()) {
                        $(this).next('.required-message').show();
                        isValid = false;
                    } else {
                        $(this).next('.required-message').hide();
                    }
                });
                $('input[type="radio"][required]').each(function() {
                    var name = $(this).attr('name');
                    if ($('input[name="' + name + '"]:checked').length === 0) {
                        if ($(this).parent().next('.required-message').length === 0) {
                            $(this).parent().after('<span class="required-message">必須です</span>');
                        }
                    } else {
                        $(this).parent().next('.required-message').remove();
                    }
                });
                if (isValid) {
                    $('#myform').submit();
                }
                e.preventDefault();
            });
        });
    </script>

@endsection
