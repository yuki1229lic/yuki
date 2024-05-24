@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
	<div class="breadcrumb">
        <ul>
            <li><a href="/">ホーム</a></li>
            <li>ハコボウズの強み</li>
        </ul>
	</div>
  </div>

    <article id="tsuyomi">

        <section class="sec01">
            <div class="inner">
                <h3>ハコボウズで働くメリット</h3>
                <h4>日払い可</h4>
                <div class="block">
                    <figure><img src="{{ asset('front/img/tsuyomi/img_merit01.png')}}" alt="日払い可"></figure>
                     <div>一般的に給料は月単位でもらうものですが、日払い可能の仕事であれば、その日の仕事が終わった後に確実に働いた分の給料を手にすることができます。
                         働きはじめたばかりや、急にお金が必要になったときでも、早めに給料をもらえるのは安心です。</div>
                </div>
                    <h4>正社員登用あり</h4>
                    <div class="block">
                        <figure><img src="{{ asset('front/img/tsuyomi/img_merit02.png')}}" alt="正社員登用あり"></figure>
                        <div>正社員登用があるため、一般的に正社員として入社するのが難しい大手企業でも派遣から正社員になるチャンスがあります。
                            派遣として働いてから正社員になるため、職場の雰囲気や人間関係、仕事内容を知ったうえで正社員になることができるのでミスマッチを防ぐことができます。</div>
                    </div>
                    <h4>ワンルーム寮完備</h4>
                    <div class="block">
                        <figure><img src="{{ asset('front/img/tsuyomi/img_merit03.png')}}" alt="ワンルーム寮完備"></figure>
                    <div>
                    ワンルーム寮を完備しているので住む場所に悩むことなく安心して働くことが可能です。
                    引っ越し費用、赴任費用は当社が負担するので、引っ越し費用を気にせずに仕事に集中できます。
                    <ul class="oneroom">
                    <li><img src="{{ asset('front/img/tsuyomi/img_oneroom01.jpg')}}" alt="ワンルーム寮完備" width="170"></li>
                    <li><img src="{{ asset('front/img/tsuyomi/img_oneroom02.jpg')}}" alt="ワンルーム寮完備" width="170"></li>
                    <li><img src="{{ asset('front/img/tsuyomi/img_oneroom03.jpg')}}" alt="ワンルーム寮完備" width="170"></li>
                    </ul>
                </div>
                </div>
                <h4>自社保育園あり</h4>
                <div class="block">
                <figure><img src="{{ asset('front/img/tsuyomi/img_merit04.png')}}" alt="自社保育園あり"></figure>
                <div>
                    自社運営の保育園や提携保育園を利用することができるので、小さな子供の育児中でも働く環境が整っています。保育園はグループ店舗、FCを含め60店舗あるので、保活中のママやパパも安心です。
                    <p class="link">▶︎  とみよ保育園（自社運営）<br><a href="" target="_blank">http://xxx.com/wp3/</a></p>
                </div>
                </div>
                <h4>キャリアアップ支援</h4>
                <div class="block last">
                <figure><img src="{{ asset('front/img/tsuyomi/img_merit05.png')}}" alt="キャリアアップ支援"></figure>
                <div>
                    キャリアアップ支援としてオンライン学習（eラーニング）を活用することができます。eラーニングはクロスラーニングという支援サービスを利用することができ、場所や時間にかかわらず自分のペースで学習を進めることが可能です。
                    <p class="link">▶︎  クロスラーニング<br><a href="" target="_blank">https://xxx.jp.net/crosslearning/overview/</a></p>
                </div>
                </div>
            </div>
        </section>

        <section class="sec02">
        <div class="inner">
            <h3>他社と異なる４の優位性</h3>
            <p class="images"><img src="{{ asset('front/img/tsuyomi/img_yuuisei.png')}}" alt="他社と異なる４の優位性"></p>
        </div>
        </section>

        <section class="sec03">
        <div class="inner">
            <h3>待機児童問題への取り組み</h3>
            <figure><img src="{{ asset('front/img/tsuyomi/img_taikijido01.jpg')}}" alt="待機児童問題への取り組み"></figure>
            <div>
            <p class="txt">大切なお子様の預かり先がなく、働きたくても働けない主婦（夫）層の活躍を願い平成29年4月2日、（株）富世にて 保育園を開園致しました。他保育園とも提携を進め仕事・保育園両面においてサポートさせて頂き、受入企業、保護者、共に 喜びの声を頂いております。</p>
            <img src="{{ asset('front/img/tsuyomi/img_taikijido02.png')}}" alt="働く女性を応援！仕事・育児を一括サポート" width="450">
            </div>
        </div>
        </section>

    </article>
@endsection
