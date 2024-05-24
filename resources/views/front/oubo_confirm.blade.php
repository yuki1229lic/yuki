@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        button{
            border: none;
        }
        .blue-btn{
            padding: 15px 10px!important;
        }
        @media (max-width: 640px) {
            .action-button{
                width: 88%;
                margin-left: 25px;
                margin-top: 15px;
            }
        }
    </style>
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>かんたん応募</li>
            </ul>
        </div>
    </div>

    <article id="oubo">
        <section class="sec01">
        </section>
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
        <section class="sec02">
            <div class="inner">
                <h3>基本情報確認</h3>
                <form action="{{ route('home.send_company_mail') }}" method="post">
                    @csrf
                    <table class="table_contact">
                        <tr>
                            <th >名前</th>
                            <td>
                                <span class="txt1">{{ $data['last_name'].$data['first_name'] }}</span>
                                <input type="hidden" name="name" value="{{ $data['last_name'].$data['first_name'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th>会社名</th>
                            <td>
                                <span class="txt1">{{ $data['company_name'] }}</span>
                                <input type="hidden" name="company_name" value="{{ $data['company_name'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td>
                                <ul class="add">
                                    <li>
                                        <span class="txt1">〒 {{ $data['zip_code'] }}</span><input type="hidden" name="zip_code" value="{{ $data['zip_code'] }}">
                                    </li>
                                    <li>
                                        <span class="txt1">{{ $data['province'] }}{{ $data['address'] }}</span><input type="hidden" name="address" value="{{ $data['province'] }}{{ $data['address'] }}">
                                    </li>
                                </ul>
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th>最寄り駅</th>--}}
{{--                            <td>--}}
{{--                                <span class="txt1">{{ $data['station'] }}</span>--}}
{{--                                <input type="hidden" name="station" value="{{ $data['station'] }}">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th>電話番号</th>
                            <td>
                                <span class="txt1">{{ $data['phone'] }}</span>
                                <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>
                                <span class="txt1">{{ $data['email'] }}</span>
                                <input type="hidden" name="email" value="{{ $data['email'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th>備考</th>
                            <td>
                                <span class="txt1">{{ $data['message_content'] }}</span>
                                <input type="hidden" name="message_content" value="{{ $data['message_content'] }}">
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <a onclick="history.back()" class="blue-btn action-button shadow animate col-md-push-2 col-md-3 col-12">戻る</a>
                        <button type="submit" class="action-button shadow animate orange col-md-push-3 col-md-3 col-12">送信する</button>
                    </div>
                </form>
            </div>
        </section>

    </article>

@endsection
