@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>初めてご利用の方へ</li>
            </ul>
        </div>
    </div>

    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>ハコボウズが選ばれる理由</h3>
                        </div>
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-4 col-12 text-center">
                                    <p class="icon">
                                        <img src="{{ asset('front/img/service/icon_no1.png')}}" alt="1">
                                    </p>
                                    <h4 class="mt-3 mb-3 b_font">軽貨物運送の求人に特化</h4>
                                    <img src="{{ asset('front/img/service/img_merit03.png')}}" alt="時給が高め">
                                    <p class="txt mt-3">軽貨物運送に特化した専門サイトだから、希望にあった仕事を見つけることができます。</p>
                                </div>
                                <div class="col-md-4 col-12 text-center">
                                    <p class="icon">
                                        <img src="{{ asset('front/img/service/icon_no2.png')}}" alt="2">
                                    </p>
                                    <h4 class="mt-3 mb-3 b_font">メッセージ機能</h4>

                                    <img src="{{ asset('front/img/service/img_merit02.png')}}" alt="派遣会社に相談ができる">

                                    <p class="txt mt-3">応募の前に企業にメッセージを送り、ご質問や相談をすることも可能です。直接やりとりができるからこそ、案件探しがスムーズに進みます。</p>
                                </div>
                                <div class="col-md-4 col-12 text-center">
                                    <p class="icon">
                                        <img src="{{ asset('front/img/service/icon_no3.png')}}" alt="3">
                                    </p>
                                    <h4 class="mt-3 mb-3 b_font">好条件の非公開求人も多数掲載</h4>
                                    <img src="{{ asset('front/img/service/img_merit01.png')}}" alt="ライフスタイルに合わせて仕事を選べる">
                                    <p class="txt mt-3">クライアントと直接つながる直請案件や、ハコボウズでしか掲載されていない案件もございます。</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>お仕事開始までの流れ</h3>
                        </div>
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('front/img/service/1.png')}}" alt="">
                                </div>
                                <div class="col-md-8 text-center">
                                    <p class="icon"><img src="{{ asset('front/img/service/icon_step1.png')}}" alt="step1"></p>
                                    <h2 class="mt-3 b_font">会員登録</h2>
                                    <p class="mt-2">ハコボウズへの登録は、Web上のフォームからお手続きが可能です。</p>
                                    <p>まずはお名前・メールアドレス・電話番号をご入力ください。</p>
                                    <p>その後、入力したアドレス宛に自動返信メールが届きますので、メール認証をしてください。</p>
                                    <p>なお、ハコボウズのサービスは、全て無料でご利用いただけます。</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <img src="{{ asset('front/img/service/2.png')}}" alt="">
                                </div>
                                <div class="col-md-8 text-center">
                                    <p class="icon"><img src="{{ asset('front/img/service/icon_step2.png')}}" alt="step2"></p>
                                    <h2 class="mt-3 b_font">求人申し込み</h2>
                                    <p class="mt-2">気になる求人案件が見つかりましたら、フォームより応募をしてください。</p>                                    
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <img src="{{ asset('front/img/service/3.png')}}" alt="">
                                </div>
                                <div class="col-md-8 text-center">
                                    <p class="icon"><img src="{{ asset('front/img/service/icon_step3.png')}}" alt="step2"></p>
                                    <h2 class="mt-3 b_font">面接</h2>
                                    <p class="mt-2">企業の担当者と直接やりとりをして面接日を確定させてください。</p>
                                    <p>日程が決まりましたら企業のご担当者様と面接に進みます。</p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-4">
                                <div class="col-md-4">
                                    <img src="{{ asset('front/img/service/4.png')}}" alt="">
                                </div>
                                <div class="col-md-8 text-center">
                                    <p class="icon"><img src="{{ asset('front/img/service/icon_step4.png')}}" alt="step2"></p>
                                    <h2 class="mt-3 b_font">ご就業</h2>
                                    <p class="mt-2">報酬、勤務地、稼働日数など条件面で企業側との合意に至れば、実際のご就業となります。</p>
                                    <p>企業との業務委託契約を締結してください。</p>
                                    <p>万が一、ご就業後に職場の雰囲気や仕事内容などで疑問に思うことがあった場合は、<br>お気軽に
                                        <a href="{{ route('home.contact') }}" class="text-tag">お問い合わせフォーム</a>へご連絡ください。</p>
                                    <p>引き続き心地よく就業いただけるよう、親身な対応をさせていただきます。</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
