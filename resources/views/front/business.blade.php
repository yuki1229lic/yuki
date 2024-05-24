@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>企業のご担当者様</li>
            </ul>
        </div>
    </div>

    <article id="business">
        <section class="sec01">
            <div class="inner">
            </div>
        </section>
    </article>

    <article id="service">
        <section class="sec02">
            <div class="inner">
                <center><h3>こんな課題はありませんか？</h3></center>
                <div class="row ">
                    <div class="col-md-12 mt-4">
                        <div class="col-md-4">
                            <div class="problem-box">
                                ドライバーの採用ができていない。
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="problem-box">
                                フリーランスドライバーと直接契約して、柔軟な依頼をしたい。
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="problem-box">
                               配送業務を依頼したいけど、どこに依頼したらいいかわからない。
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <div class="col-md-12 down-arrow">
                    </div>
                    <div class="col-md-12">
                        <div class="down-content">
                            <p class="fz-25 b_font">ハコボウズは、<span class="red-font b_font">完全成果報酬型</span>
                                で即戦力フリーランスの軽貨物ドライバーを採用できるマッチングサービスです。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sec02">
            <div class="inner">
                <h3>ハコボウズが選ばれる６つの理由</h3>
                <h4>成果報酬型の料金体系のため、コストリスクなし</h4>
                <div class="block">
                    <div>
                        ハコボウズのサービス料金体系は、完全成果報酬型です。<br>採用が決定し、稼働を開始した段階で初めて料金が発生いたします。<br>
                        そのため、「コストをかけたにも関わらず、一人も採用できなかった」ということはありません。
                    </div>
                </div>
                <h4>案件ごとの採用も可能</h4>
                <div class="block">
                    {{--                    <figure><img src="{{ asset('front/img/service/img_introduction02.png')}}" alt="有料職業紹介"></figure>--}}
                    <div>
                        「一つの現場は充足したが、新規案件に対応できるドライバーが採用できていない」などというときもあるのではないでしょうか。<br>
                        ハコボウズでは条件を絞って募集をかけることができ、一度出した求人情報を状況に応じて編集することも可能です。
                    </div>
                </div>
                <h4>軽貨物運送に特化した専門サイト</h4>
                <div class="block">
                    {{--                    <figure><img src="{{ asset('front/img/service/img_introduction02.png')}}" alt="有料職業紹介"></figure>--}}
                    <div>
                        運送業全般を扱う他サイトと比べ、ハコボウズは軽貨物ドライバー専門求人マッチングサイトのため、求職者に対して的確にリーチすることができます。
                    </div>
                </div>
                <h4>ドライバーとのマッチング工数が削減できる</h4>
                <div class="block">
                    {{--                    <figure><img src="{{ asset('front/img/service/img_introduction02.png')}}" alt="有料職業紹介"></figure>--}}
                    <div>
                        採用要件を詳しく伝えることで、自社の求める人材をあらかじめスクリーニングした上でマッチングを行います。
                    </div>
                </div>
                <h4>国内最大級の軽貨物運送メディアも運営</h4>
                <div class="block">
                    {{--                    <figure><img src="{{ asset('front/img/service/img_introduction02.png')}}" alt="有料職業紹介"></figure>--}}
                    <div>
                        軽貨物運送専門メディア「軽貨物ドライバーJP」では、業界に関わる様々なSEOキーワードで上位を獲得しています。そのため、web検索から全国各地のドライバーへ求人情報を届けることができます。
                    </div>
                </div>
                <h4>google仕事検索・indeed・求人ボックスのサイトにも自動掲載</h4>
                <div class="block last">
                    ハコボウズに求人情報を掲載すると、自動的に大手求人検索エンジン「google for jobs・indeed・求人ボックス」にも求人情報が掲載されます。<br>
                    求人広告の運用はハコボウズにまかせて、自社での営業等に専念することができます。
                </div>
            </div>
        </section>
    </article>

    <article id="business">
        <section class="sec04">
            <div class="inner">
                <h3>サービス提供までの流れ</h3>
                <div class="step">
                    <div>
                        <div class="circle">1</div>
                    </div>
                    <div>
                        <div class="title">お問い合わせ</div>
                        <div class="caption">
                            <p>下記「相談フォーム」よりお問い合わせください。</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div>
                        <div class="circle">2</div>
                    </div>
                    <div>
                        <div class="title">サービスのご提案</div>
                        <div class="caption">
                            <p>自動返信メールにてハコボウズの料金体系・利用契約書を添付いたします。</p>
                            <p>内容を確認し、サービス利用契約書のご捺印対応をお願いいたします。</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div>
                        <div class="circle">3</div>
                    </div>
                    <div>
                        <div class="title">掲載開始</div>
                        <div class="caption">
                            <p>サービス利用契約書にご捺印いただけましたら、貴社専用の管理画面を作成いたします。</p>
                            <p>企業情報・求人情報を入力し、募集を開始してください。</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div>
                        <div class="circle">4</div>
                    </div>
                    <div>
                        <div class="title">面接</div>
                        <div class="caption">
                            <p>貴社に興味を持ったドライバーと面接し、合否を決定してください。</p>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div>
                        <div class="circle-last">5</div>
                    </div>
                    <div>
                        <div class="title">採用</div>
                        <div class="caption">
                            求職者と業務委託契約を締結してください。また、管理画面上で採用通知をお願いします。<br>
                            実際に業務を開始した時点で初めて料金が発生いたします。</div>
                    </div>
                </div>
                <div class="row mt-4">
                    <a href="{{ route('home.oubo') }}" class="action-button shadow animate red-btn col-md-push-4 col-md-4">
                        求人掲載を希望される方はこちら
                    </a>
                </div>
            </div>

        </section>
    </article>
@endsection
