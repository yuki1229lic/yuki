@extends('layouts.front.front_main_layout')
@section('content')
    {!! RecaptchaV3::initJs() !!}
    <style>
        select{
            width: 738px!important;
        }
        @media (max-width: 640px) {
            select{
                width: 100%!important;
            }
        }
    </style>
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>お問い合わせ</li>
            </ul>
        </div>
    </div>

    <article id="oubo">
{{--        <section class="sec01">--}}
{{--            <div class="inner">--}}
{{--                <h3>お電話でのお問い合わせ</h3>--}}
{{--                <p class="tel">0120-1034-67</p>--}}
{{--                <p class="txt">お電話の受付時間：00:00～99:99（土日祝定休）</p>--}}
{{--            </div>--}}
{{--        </section>--}}
        <div class="container">
            @foreach(['danger','warning', 'success','info'] as $msg)
                @if(Session::has('alert-'.$msg))
                    <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">

                        </a>
                    </p>
                @endif
            @endforeach
        </div>
        <section class="sec02" style="margin-top: 30px">
            <div class="inner">
                <ul class="content3">
                    <li>
                        <h3>お問い合わせ</h3>
                        <form action="{{ route('home.send_contact_mail') }}" method="post">
                            @csrf
                            <table class="table_contact">
                                <tr>
                                    <th>会社名</th>
                                    <td>
                                        <input type="text" name="company_name" class="text05">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="required">名前</th>
                                    <td>
                                        <span class="txt1">姓</span>
                                        <input type="text" name="last_name" class="text01 @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
{{--                                        @error('last_name')--}}
{{--                                        <p class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </p>--}}
{{--                                        @enderror--}}
                                        <span class="txt2">名</span>
                                        <input type="text" name="first_name" class="text01 @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
{{--                                        @error('first_name')--}}
{{--                                        <p class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </p>--}}
{{--                                        @enderror--}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="required">名前(かな)</th>
                                    <td class="fri">
                                        <span class="txt1">せい</span>
                                        <input type="text" name="kana_last_name" class="text01 @error('kana_last_name') is-invalid @enderror" value="{{ old('kana_last_name') }}">
{{--                                        @error('last_name')--}}
{{--                                        <p class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </p>--}}
{{--                                        @enderror--}}
                                        <span class="txt2">めい</span>
                                        <input type="text" name="kana_first_name" class="text01 @error('kana_first_name') is-invalid @enderror" value="{{ old('kana_first_name') }}">
{{--                                        @error('first_name')--}}
{{--                                        <p class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </p>--}}
{{--                                        @enderror--}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="required">メールアドレス</th>
                                    <td>
                                        <input type="text" name="email" class="text05 @error('email') is-invalid @enderror">
{{--                                        @error('email')--}}
{{--                                            <p class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </p>--}}
{{--                                        @enderror--}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="required">電話番号</th>
                                    <td>
                                        <dl class="tel">
                                            <input type="text" name="phone1" class="text02 @error('phone1') is-invalid @enderror">
                                            <span class="txt3">ー</span>
                                            <input type="text" name="phone2" class="text02 @error('phone2') is-invalid @enderror">
                                            <span class="txt3">ー</span>
                                            <input type="text" name="phone3" class="text02 @error('phone3') is-invalid @enderror">
                                        </dl>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="required">お問い合わせの種類</th>
                                    <td>
                                        <select name="subject" class="@error('subject') is-invalid @enderror">
                                            <option value="" disabled selected>選択してください。
                                            <option value="エンジニアサーチについて">ハコボウズについて</option>
                                            <option value="個人情報・案件情報について">個人情報・案件情報について</option>
                                            <option value="トラブル・違反報告等">トラブル・違反報告等</option>
                                            <option value="振込・入金について">振込・入金について</option>
                                            <option value="会員登録・ログインについて">会員登録・ログインについて</option>
                                            <option value="メディア掲載・取材・協業等の依頼">メディア掲載・取材・協業等の依頼</option>
                                            <option value="ご意見・ご要望">ご意見・ご要望</option>
                                            <option value="その他">その他</option>
                                        </select>
{{--                                        @error('subject')--}}
{{--                                            <p class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </p>--}}
{{--                                        @enderror--}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="required">お問い合わせの内容</th>
                                    <td>
                                        <textarea name="mail_content" class="@error('mail_content') is-invalid @enderror"></textarea>
{{--                                        @error('mail_content')--}}
{{--                                            <p class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </p>--}}
{{--                                        @enderror--}}
                                        {!! RecaptchaV3::field('contact_us') !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <strong>{{ 'ボットで疑われますので、もう一度お試しください。' }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <button id="submit_button01" type="submit">送 信</button>
                        </form>
                    </li>
                </ul>
            </div>
        </section>
    </article>
@endsection
