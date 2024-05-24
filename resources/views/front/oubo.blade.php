@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="index.html">ホーム</a></li>
                <li>採用担当者様用ご相談フォーム</li>
            </ul>
        </div>
    </div>

    <article id="oubo">
        <section class="sec01">
            <div class="inner">
                <p class="txt">
                    求人情報の掲載は無料となり、「成果報酬型」でフリーランスドライバーを採用することが可能です。<br>
                    サービス利用をご希望の方は、下記フォームからご連絡をお願いします
                    また、「ハコボウズ」はフリーランスドライバーを中心とした求人サービスで、独自の審査基準がございます。予めご了承ください。<br>
                    ご不明点がございましたら、<a href="{{ route('home.contact') }}" class="text-tag b_font">お問い合わせフォーム</a>よりご連絡ください。
                </p>
            </div>
        </section>
        <section class="sec02">
            <div class="inner">
                <h3>基本情報</h3>
                <form action="{{  route('home.oubo_confirm') }}" method="post">
                    @csrf
                    <table  class="table_contact">
                        <tr>
                            <th class="required">ご担当者名</th>
                            <td>
                                <span class="txt1 b_font">姓</span><input type="text" name="last_name" class="text01 @error('name') is-invalid @enderror" value="{{ old('last_name') }}">
                                @error('last_name')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                                <span class="txt2 b_font">名</span><input type="text" name="first_name" class="text01 @error('name') is-invalid @enderror" value="{{ old('first_name') }}">
                                @error('first_name')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th class="required">会社名</th>
                            <td>
                                <input type="text" name="company_name"  class="text01 @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}">
                                @error('company_name')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th class="required">住所</th>
                            <td>
                                <ul class="add">
                                    <li>
                                        <span class="txt1 b_font">〒</span><input type="text" name="zip_code" class="text02 @error('zip_code') is-invalid @enderror" value="{{ old('zip_code') }}">
                                        @error('zip_code')
                                        <p class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                        @enderror
                                    </li>
                                    <li><span class="txt1 b_font">都道府県</span>
                                        <select name="province" class="select01">
                                            <option value="北海道">北海道</option>
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
                                    </li>
                                    <li>
                                        <span class="txt1 b_font">住所</span><input type="text" name="address" class="text04 @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                        @error('address')
                                        <p class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                        @enderror
                                    </li>
                                </ul>
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th class="required">最寄り駅</th>--}}
{{--                            <td>--}}
{{--                                <input type="text" name="station" class="text05 @error('station') is-invalid @enderror" value="{{ old('station') }}">--}}
{{--                                @error('address')--}}
{{--                                <p class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </p>--}}
{{--                                @enderror--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th class="required">電話番号</th>
                            <td>
                                <input type="text" name="phone" class="text04 @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th class="required">メールアドレス</th>
                            <td>
                                <input type="text" name="email" class="text05 @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>備考</th>
                            <td>
                                <textarea name="message_content" class="@error('message_content') is-invalid @enderror">{{ old('message_content') }}</textarea>
                            </td>
                        </tr>
                    </table>
                    <input id="submit_button01" type="submit" name="submit" value="入力内容を確認する">
                </form>
            </div>
        </section>
    </article>
@endsection
