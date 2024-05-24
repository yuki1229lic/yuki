@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>メール転送完了</li>
            </ul>
        </div>
    </div>

    <article id="contact">
        <section class="sec01">
            <div class="inner">
                <div class="row text-center">
                    @if($result = 'ok')
                        <p style="padding: 20px 5%; font-size:1.1em; line-height:1.8; letter-spacing: 0.2em;">お問い合わせありがとうございます。<br><br>
                        ご記入いただいた内容は正常に送信されました。<br>
                        担当者より、折り返しご連絡させていただきます。<br><br>
                        今後とも、当社をよろしくお願いいたします。</p>
                    @else
                        <h3 style="color:#e10e34;">メールの送信に失敗しました。</h3>
                        <p>ご不便をおかけして大変申し訳ございませんが、再送信お願いします。</p>
                    @endif
                </div>
            </div>
        </section>
    </article>
@endsection
