@extends('layouts.front.front_main_layout')
@section('content')
<div id="mv">
    <div class="inner">
        <div class="search_area">
            <form action="{{ route('home.keyword_search') }}" method="get" class="second-form">
                <input type="text" name="keyword" placeholder="キーワードから探す" style="float:left;" class="mainvisual">
                <button id="submit_button02" type="submit"></button>
            </form>
            <form action="{{ route('home.search') }}" method="get">
                <!-- area変更 -->
                <select name="prefecture" class="mainvisual prefecture">
                    <option value="" disabled selected>勤務地</option>
                    @foreach($prefecture as $v)
                        <option value="{{ $v->ken_id }}">{{ $v->ken_name }}</option>
                    @endforeach
                </select>
                <select name="category" class="mainvisual">
                    <option value="" disabled selected>業種</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['kind_name'] }}">{{ $category['kind_name'] }}</option>
                    @endforeach
                </select>
                <button type="submit" class="action-button shadow animate red" id="submit_button01">検索する</button>
            </form>
        </div>
    </div>
    <p class="catch">ハコボウズは軽貨物専門の求人情報サイトです。<br>
            詳細な案件情報から自分にピッタリな仕事を探せます。</p>

    <!-- 都道府県から探す START -->
    <div class="areaBox">
        <p class="areaHead">都道府県から<br>軽貨物求人を探す</p>
        <dl class="areaList">
            <dt>北海道・東北</dt>
            <dd>
                <ul>
                    <li data-prefecture_id="1">
                       <a href="/area_search/1">北海道</a>
                    </li>
                    <li data-prefecture_id="2">
                        <a href="/area_search/2">青森</a>
                    </li>
                    <li data-prefecture_id="3">
                        <a href="/area_search/3">岩手</a>
                    </li>
                    <li data-prefecture_id="5">
                        <a href="/area_search/5">秋田</a>
                    </li>
                    <li data-prefecture_id="4">
                        <a href="/area_search/4">宮城</a>
                    </li>
                    <li data-prefecture_id="6">
                        <a href="/area_search/6">山形</a>
                    </li>
                    <li data-prefecture_id="7">
                        <a href="/area_search/7">福島</a>
                    </li>
                </ul>
            </dd>
            <dt>関東</dt>
            <dd>
                <ul>
                    <li data-prefecture_id="13">
                        <a href="/area_search/13">東京</a>
                    </li>
                    <li data-prefecture_id="14">
                        <a href="/area_search/14">神奈川</a>
                    </li>
                    <li data-prefecture_id="11">
                        <a href="/area_search/11">埼玉</a>
                    </li>
                    <li data-prefecture_id="12">
                        <a href="/area_search/12">千葉</a>
                    </li>
                    <li data-prefecture_id="8">
                        <a href="/area_search/8">茨城</a>
                    </li>
                    <li data-prefecture_id="9">
                        <a href="/area_search/9">栃木</a>
                    </li>
                    <li data-prefecture_id="10">
                        <a href="/area_search/10">群馬</a>
                    </li>
                </ul>
            </dd>
            <dt>中部・北陸</dt>
            <dd>
                <ul>
                    <li data-prefecture_id="23">
                        <a href="/area_search/23">愛知</a>
                    </li>
                    <li data-prefecture_id="21">
                        <a href="/area_search/21">岐阜</a>
                    </li>
                    <li data-prefecture_id="22">
                        <a href="/area_search/22">静岡</a>
                    </li>
                    <li data-prefecture_id="24">
                        <a href="/area_search/24">三重</a>
                    </li>
                    <li data-prefecture_id="15">
                        <a href="/area_search/15">新潟</a>
                    </li>
                    <li data-prefecture_id="19">
                        <a href="/area_search/19">山梨</a>
                    </li>
                    <li data-prefecture_id="20">
                        <a href="/area_search/20">長野</a>
                    </li>
                    <li data-prefecture_id="17">
                        <a href="/area_search/17">石川</a>
                    </li>
                    <li data-prefecture_id="16">
                        <a href="/area_search/16">富山</a>
                    </li>
                    <li data-prefecture_id="18">
                        <a href="/area_search/18">福井</a>
                    </li>
                </ul>
            </dd>
        </dl>
        <dl class="areaList">
            <dt>関西</dt>
            <dd>
                <ul>
                    <li data-prefecture_id="27">
                        <a href="/area_search/27">大阪</a>
                    </li>
                    <li data-prefecture_id="28">
                        <a href="/area_search/28">兵庫</a>
                    </li>
                    <li data-prefecture_id="26">
                        <a href="/area_search/26">京都</a>
                    </li>
                    <li data-prefecture_id="25">
                        <a href="/area_search/25">滋賀</a>
                    </li>
                    <li data-prefecture_id="29">
                        <a href="/area_search/29">奈良</a>
                    </li>
                    <li data-prefecture_id="30">
                        <a href="/area_search/30">和歌山</a>
                    </li>
                </ul>
            </dd>
            <dt>中国・四国</dt>
            <dd>
                <ul>
                    <li data-prefecture_id="33">
                        <a href="/area_search/33">岡山</a>
                    </li>
                    <li data-prefecture_id="34">
                        <a href="/area_search/34">広島</a>
                    </li>
                    <li data-prefecture_id="31">
                        <a href="/area_search/31">鳥取</a>
                    </li>
                    <li data-prefecture_id="32">
                        <a href="/area_search/32">島根</a>
                    </li>
                    <li data-prefecture_id="35">
                        <a href="/area_search/35">山口</a>
                    </li>
                    <li data-prefecture_id="37">
                        <a href="/area_search/37">香川</a>
                    </li>
                    <li data-prefecture_id="36">
                        <a href="/area_search/36">徳島</a>
                    </li>
                    <li data-prefecture_id="38">
                        <a href="/area_search/38">愛媛</a>
                    </li>
                    <li data-prefecture_id="39">
                        <a href="/area_search/39">高知</a>
                    </li>
                </ul>
            </dd>
            <dt>九州・沖縄</dt>
            <dd>
                <ul>
                    <li data-prefecture_id="40">
                        <a href="/area_search/40">福岡</a>
                    </li>
                    <li data-prefecture_id="41">
                        <a href="/area_search/41">佐賀</a>
                    </li>
                    <li data-prefecture_id="42">
                        <a href="/area_search/42">長崎</a>
                    </li>
                    <li data-prefecture_id="43">
                        <a href="/area_search/43">熊本</a>
                    </li>
                    <li data-prefecture_id="44">
                        <a href="/area_search/44">大分</a>
                    </li>
                    <li data-prefecture_id="45">
                        <a href="/area_search/45">宮崎</a>
                    </li>
                    <li data-prefecture_id="46">
                        <a href="/area_search/46">鹿児島</a>
                    </li>
                    <li data-prefecture_id="47">
                        <a href="/area_search/47">沖縄</a>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
    <!-- banner START  -->
    <div id="bannerBox">
        <div class="owl-carousel ow-car owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <div class="owl-item">
                        <a href="https://line.me/R/ti/p/%40549mgoxu" target="_blank" rel="noopener noreferrer nofollow"><img src="{{ asset('front/img/banner/240x60_line.jpg')}}" alt="ハコボウズ公式ライン→"></a>
                    </div>
                    <div class="owl-item">
                        <a href="https://mobile.twitter.com/keikamotsu_jp" target="_blank" rel="noopener noreferrer nofollow"><img src="{{ asset('front/img/banner/240x60_twitter.jpg')}}" alt="ハコボウズ公式Twitter"></a>
                    </div>
                    <div class="owl-item">
                        <a href="/about-oiwaikin"><img src="{{ asset('front/img/banner/240x60_iwaikin.jpg')}}" alt="祝い金"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner END  -->

</div>
<article id="top">
    <section class="sec03">
        <div class="inner">
            <center><h3>注目の求人情報</h3></center>
            <div class="carousel-wrap">
                <div class="owl-carousel ow-car">
                    @foreach($featured_jobs as $job)
                        <div class="col-sm-12">
                            <div class="article-box-2">
                                <a href="{{ route('home.job_detail',$job['id']) }}" class="alpha">
                                    <?php
                                    $img = json_decode($job['post_img'], true);
                                    ?>
                                    @if($img)
                                    <img src="{{ asset('images/jobs')}}/{{ $img[0] }}" alt="" class="article-img">
                                    @else
                                    <img src="{{ asset('images/jobs')}}/{{ 'default.jpeg' }}" alt="" class="article-img">
                                    @endif
                                    <div class="mt-1">
                                        <p class="special-title">{{ \App\Http\Controllers\HomeController::trip_text($job['post_title'], 42) }}...</p>
                                        <p>
                                            @isset($job['working_place'])
                                                @foreach($job['working_place'] as $key => $place)
                                                    <a href="{{ route('home.area_search',$place['area_id']) }}">
                                                        <span class="badge badge-orange">{{ $place['area_name'] }}</span>
                                                    </a>
                                                @endforeach
                                            @endisset
                                            <?php
                                            $category = json_decode($job['post_category'], true);
                                            ?>
                                            @foreach($category as $category)
                                                <a href="{{ route('home.category_search',$category) }}">
                                                     <span class="badge badge-info">{{ $category }}</span>
                                                </a>
                                            @endforeach
                                        </p>
                                        <p class="special-content">{{ \App\Http\Controllers\HomeController::trip_text($job['post_other']) }}...</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="sec05">
        <div class="inner">
            <center><h3>新着の求人情報</h3></center>
            <div class="mt-2">
                <div class="carousel-wrap">
                    <div class="owl-carousel ow-car">
                        @foreach($new_jobs as $job)
                            <div class="col-sm-12">
                                <div class="article-box-2">
                                    <a href="{{ route('home.job_detail',$job['id']) }}" class="alpha">
                                        <?php
                                        $img = json_decode($job['post_img'], true);
                                        ?>

                                        @if($img)
                                        <img src="{{ asset('images/jobs')}}/{{ $img[0] }}" alt="" class="article-img">
                                        @else
                                        <img src="{{ asset('images/jobs')}}/{{ 'default.jpeg' }}" alt="" class="article-img">
                                        @endif
                                        <div class="mt-1">
                                            <p class="special-title">{{ \App\Http\Controllers\HomeController::trip_text($job['post_title'], 42) }}...</p>
                                            <p>
                                                @isset($job['working_place'])
                                                    @foreach($job['working_place'] as $key => $place)
                                                        <a href="{{ route('home.area_search',$place['area_id']) }}">
                                                            <span class="badge badge-orange">{{ $place['area_name'] }}</span>
                                                        </a>
                                                    @endforeach
                                                @endisset
                                                <?php
                                                    $category = json_decode($job['post_category'], true);
                                                ?>
                                                @foreach($category as $category)
                                                    <a href="{{ route('home.category_search',$category) }}">
                                                         <span class="badge badge-info">{{ $category }}</span>
                                                    </a>
                                                @endforeach
                                            </p>
                                            <p class="special-content">{{ \App\Http\Controllers\HomeController::trip_text($job['post_other']) }}...</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <form action="{{ route('home.search') }}" method="get">
                    <button type="submit" class="more-view action-button shadow animate">新着求人の一覧を見る&nbsp;&nbsp;&nbsp;&nbsp;&gt;</button>
                </form>
            </div>
        </div>
    </section>
    <section class="sec01">
        <div class="inner">
            <h3>ハコボウズの特徴</h3>
            <ul class="clearfix">
                <!-- <li>
                    <figure><img src="{{ asset('front/img/top/img_advantages01.png')}}" alt="日払い可"></figure>
                    <h4>国内最大級の求人数</h4>
                </li> -->
                <li>
                    <figure><img src="{{ asset('front/img/top/img_advantages02.png')}}" alt="正社員登用あり"></figure>
                    <h4>軽貨物運送業に特化した求人サイト</h4>
                </li>
                <li>
                    <figure><img src="{{ asset('front/img/top/img_advantages03.png')}}" alt="ワンルーム寮完備"></figure>
                    <h4>好条件の非公開求人も多数掲載</h4>
                </li>
                <li>
                    <figure><img src="{{ asset('front/img/top/img_advantages05.png')}}" alt="自社保育園あり"></figure>
                    <h4>気になる会社に直接メッセージを送れる</h4>
                </li>
            </ul>
            <a href="{{ route('register') }}" class="more-view action-button shadow animate">まずは無料で会員登録！&nbsp;&nbsp;&nbsp;&nbsp;&gt;</a>
        </div>
    </section>
    <section class="sec07">
        <div class="inner">
            <div class="section_title">
                <center>
                    <h3 class="mt-4" style="margin-bottom: 20px;">軽貨物運送業のメディアサイト</h3>
                    <p>
                        <span>
                            <img src="{{ asset('front/img/top/media1.png') }}" alt="" class="jp-logo">
                        </span>
                        <span class="jp-title">軽貨物ドライバーJP注目の記事</span>
                    </p>
                </center>
            </div>
            <div class="row mt-2">
                @isset($wp_blogs[0])
                @for($i = 0 ; $i < 6 ; $i++)
                    <div class="col-md-4 col-12">
                        <a href="{{ $wp_blogs[$i]['link'] }}" target="_blank">
                            <div class="article-box">
                                <div class="wp-img">
                                    <img src="{{ $wp_blogs[$i]['img'] }}" class="wp-article-img">
                                </div>
                                <div class="wp-wrapper">
                                    <p class="wp-article-title">{{ $wp_blogs[$i]['title'] }}</p>
                                    <p class="wp-article-content mt-2">{{ \App\Http\Controllers\HomeController::trip_text($wp_blogs[$i]['content']) }}...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
                @endisset
            </div>
            <div class="row mt-3">
                <a href="/articles/" class="more-view action-button shadow animate">お役立ちコンテンツをもっと見る&nbsp;&nbsp;&nbsp;&nbsp;&gt;</a>
            </div>
        </div>
    </section>
    <section class="sec08">
        <div class="inner">
            <h3>よくある質問</h3>
            <div class="accordion">
                <div class="accordion-item">
                    <a>どのような案件がありますか？</a>
                    <div class="text-content">
                        <p class="first-content">・宅配便</p>
                        <p>・チャーター便</p>
                        <p>・スポット配送便</p>
                        <p>・ルート配送便</p>
                        <p>・冷蔵便・冷凍便</p>
                        <p>・企業配送便</p>
                        <p>軽貨物運送業界の全ジャンルの案件が探せます。</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>サービスを利用するのに、費用はかかりますか？</a>
                    <div class="text-content">
                        <p class="first-content">全て無料でご利用いただけます。</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>年齢制限はありますか？</a>
                    <div class="text-content">
                        <p class="first-content">年齢不問の案件もございます。募集要項をご確認ください。</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>応募した会社との間を仲介してもらえるのですか？</a>
                    <div class="text-content">
                        <p class="first-content">仲介は行っておりません。応募した会社の担当者様と利用者様でのやりとりになります。</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>車両を持っていないのですが、仕事を始めることができますか？</a>
                    <div class="text-content">
                        <p class="first-content">車両のリースやレンタルを用意している会社が多いです。募集要項をご確認ください。</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>プロフィール情報は誰に公開されますか？</a>
                    <div class="text-content">
                        <p class="first-content">応募した会社様にのみ公開されます。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sec07">
        <div class="inner">
            <h3>お知らせ</h3>
            <dl>
                <dd>
                    @foreach($notifications as $notification)
                    <a href="{{ route('home.notification_detail',$notification['id']) }}">
                        <dl>
                            <dt class="title">{{ Illuminate\Support\Carbon::parse($notification['created_at'])->format('Y.m.d') }}</dt>
                            <dd>{{ $notification['notification_title'] }}</dd>
                        </dl>
                    </a>
                    @endforeach
                </dd>
            </dl>
        </div>
    </section>

</article>
@endsection
