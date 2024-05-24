@extends('layouts.front.front_main_layout')
@section('content')
<style>
    .img-round {
        width: 130px;
        height: 130px;
        border-radius: 65px;
        border: 2px solid #0be22e;
    }

    th {
        vertical-align: middle !important;
    }
</style>
<div id="mv_low">
    <div class="breadcrumb">
        <ul>
            <li><a href="/">ホーム</a></li>
            <li><a href="/search">お仕事検索</a></li>
            @isset($job['working_place'])
            <li><a href="/area_search/{{ $job['working_place'][0]['ken_id'] }}">{{ $job['working_place'][0]['ken_name'] }}</a></li>
            @endif
            <li>{{ $job['post_title'] }}</li>
        </ul>
    </div>
</div>
<div id="favorite">
    <article id="search_d">
        <section class="sec01">
            <div class="inner">
                <!--p class="number">掲載日：{{ Illuminate\Support\Carbon::parse($job['updated_at'])->format('Y.m.d') }}　掲載No.{{ $job['id'] }}</p-->
                <div id="jobDetailBox" class="box">
                    <div id="jobDetail">
                        <div class="carouselBox narrow">
                            <div class="owl-carousel ow-car owl-loaded owl-drag owCar">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage">
                                        <?php
                                        $imgs = json_decode($job['post_img'], true);
                                        ?>
                                        @if($imgs)
                                        @foreach($imgs as $img)
                                        <div class="owl-item">
                                            <img src="{{ asset('images/jobs') }}/{{ $img }}" alt="">
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="owl-item">
                                            <img src="{{ asset('images/jobs')}}/{{ 'default.jpeg' }}">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="block1">
                            <?php
                            $img = json_decode($job['post_img'], true);
                            ?>
                            <!-- 個々の画像はスライダー部分に移動
                            @if($img)
                            <figure><img src="{{ asset('images/jobs')}}/{{ $img[0] }}" class="article-img"></figure>
                            @else
                            <figure><img src="{{ asset('images/jobs')}}/{{ 'default.jpeg' }}" class="article-img"></figure>
                            @endif -->
                            <div class="col-md-12">
                                <p>
                                    <span class="line jobTitle">{{ $job['post_title'] }}</span>
                                </p>
                                <div class="mt-2">
                                    <ul class="tagList">
                                        <?php
                                        $benefits = json_decode($job['post_benefit'], true);
                                        ?>
                                        @foreach($benefits as $benefit)
                                        <li><i class="fa-solid fa-square-check" style="color: #0074c1;"></i>&nbsp;{{ $benefit }}</li>
                                        @endforeach
                                    </ul>

                                    @if($job['post_payment_text'])
                                    <p class="itemBox"><i class="fa-solid fa-yen-sign" style="color: #0074c1;"></i>&nbsp;&nbsp;&nbsp;
                                        月額報酬&nbsp;：{!! $job['post_payment_text'] !!}万円 {{ $job['post_is_payment_more'] ? '以上' : ''}}
                                        {{ $job['post_payment_max_text'] ? '〜' . $job['post_payment_max_text'] . '万円' : ''}}
                                    </p>
                                    @endif
                                    @isset($job['working_place'])
                                    <div class="itemBox"><i class="fa-solid fa-location-dot" style="color: #0074c1;"></i>&nbsp;&nbsp;&nbsp;
                                        @foreach($job['working_place'] as $key => $place)
                                        <a href="{{ route('home.area_search',$place['area_id']) }}"><span class="badge badge-orange">{{ $place['area_name'] }}</span></a>
                                        @endforeach
                                    </div>
                                    @endisset
                                    <?php
                                    $category = json_decode($job['post_category'], true);
                                    ?>
                                    <div class="itemBox"><i class="fa-solid fa-truck" style="color: #0074c1;">
                                        </i>&nbsp;
                                        @foreach($category as $category)
                                        <a href="{{ route('home.category_search',$category) }}">
                                            <span class="badge badge-info">
                                                {{ $category }}
                                            </span>
                                        </a>
                                        @endforeach
                                    </div>
                                    <p class="itemBox">最終更新日：{{ Illuminate\Support\Carbon::parse($job['updated_at'])->format('Y.m.d') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block2">
                        @isset($job['post_other'])
                        <section class="tableWork">
                            <h2>仕事内容</h2>
                            <div class="itemBlock">{!! nl2br($job['post_other']) !!}</div>
                        </section>
                        @endisset
                        <section class="tableWork">
                            @isset($job['post_require'])
                            <h2>応募資格</h2>
                            <div class="itemBlock">{!! nl2br($job['post_require']) !!}</div>
                            @endisset
                            @isset($job['post_suitable'])
                            <h3>こんな方にオススメ</h3>
                            <div class="itemBlock">{!! nl2br($job['post_suitable']) !!}</div>
                            @endisset
                        </section>
                    </div>
                    <div class="block3">
                        <div class="tableWork">
                            <table class="jobContentTeble">
                                <tbody>
                                    <tr>
                                        <th><i class="fa-solid fa-location-dot" style="color: #0074c1;"></i>
                                            <span class="tTitle">勤務地</span>
                                        </th>
                                        <td>
                                            @isset($job['working_place'])
                                            <ul class="placeList">
                                                @foreach($job['working_place'] as $key => $place)
                                                <li>{{ $place['area_name'] }}</li>
                                                @endforeach
                                            </ul>
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-regular fa-clock" style="color: #0074c1;"></i>
                                            <span class="tTitle">稼働時間</span>
                                        </th>
                                        <td>
                                            @isset($job['post_working_time'])
                                            {!! nl2br($job['post_working_time']) !!}
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-solid fa-yen-sign" style="color: #0074c1;"></i></i>
                                            <span class="tTitle">報酬</span>
                                        </th>
                                        <td>
                                            @if($job['post_payment_text'])
                                            月額報酬&nbsp;：{!! $job['post_payment_text'] !!}万円 {{ $job['post_is_payment_more'] ? '以上' : ''}}
                                            {{ $job['post_payment_max_text'] ? '〜' . $job['post_payment_max_text'] . '万円' : ''}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-solid fa-truck-fast" style="color: #0074c1;"></i>
                                            <span class="tTitle">報酬例</span>
                                        </th>
                                        <td>
                                            @isset($job['post_payment'])
                                            {!! nl2br($job['post_payment']) !!}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-solid fa-money-bill-transfer" style="color: #0074c1;"></i>
                                            <span class="tTitle">支払いサイト</span>
                                        </th>
                                        <td>
                                            @isset($job['post_rental_car'])
                                            {!! nl2br($job['post_rental_car']) !!}
                                            @endisset
                                        </td>
                                    </tr>
                                    @isset($job['post_revenue'])
                                    <tr>
                                        <th><i class="fa-regular fa-hand-point-up" style="color: #0074c1;"></i>
                                            <span class="tTitle">ロイヤリティ</span>
                                        </th>
                                        <td>
                                            {!! nl2br($job['post_revenue']) !!}
                                        </td>
                                    </tr>
                                    @endisset
                                    <tr>
                                        <th><i class="fa-solid fa-briefcase" style="color: #0074c1;"></i>
                                            <span class="tTitle">雇用形態</span>
                                        </th>
                                        <td>
                                            <?php
                                            $contract_types = json_decode($job['post_contract_type'], true);
                                            ?>
                                            @php
                                            $contract_types = $contract_types ?? [];
                                            @endphp
                                            @foreach ($contract_types as $contract_type)
                                                <i class="fa-solid fa-square-check" style="color: #0074c1;"></i>&nbsp;{{ $contract_type }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-solid fa-tag" style="color: #0074c1;"></i>
                                            <span class="tTitle">特徴タグ</span>
                                        </th>
                                        <td>
                                            <ul class="tagList">
                                                @foreach($benefits as $benefit)
                                                <li><i class="fa-solid fa-square-check" style="color: #0074c1;"></i>&nbsp;{{ $benefit }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @isset($job_prs[0])
                    <div class="block4">
                        <section class="tableWork">
                            <div class="itemBlock">
                                @foreach($job_prs as $job_pr)
                                <h2>
                                    @if($job_pr['post_pr_text'] === 'その他')
                                    {!! $job_pr['post_pr_title'] !!}
                                    @else
                                    {!! $job_pr['post_pr_type'] !!}
                                    @endif
                                </h2>
                                <p class="paragraphBox">
                                    {!! nl2br($job_pr['post_pr_text']) !!}<br><br>
                                </p>
                                @endforeach
                            </div>
                        </section>
                    </div>
                    @endisset
                    <div class="block6">
                        <div class="tableWork">
                            <section class="itemBlock">
                                <div class="infoHead">
                                    <!--div class="photo">
                                        <img src="{{ asset('images/jober_profile') }}/{{ $jober_profile['company_img'] }}" alt="" class="img-round">
                                    </div-->
                                    <p class="logo"><img src="{{ asset('images/jober_profile') }}/{{ $jober_profile['company_img'] }}" alt="{{ $jober_profile['company_name'] }}"></p>
                                    <h2 class="company-title">{{ $jober_profile['company_name'] }}</h2>
                                </div>
                                @isset($jober_profile['company_province'])
                                <h3>本社所在地</h3>
                                <p class="paragraphBox">{{ $jober_profile['company_province'] }}{{ $jober_profile['company_address'] }}</p>
                                @endisset
                                @isset($jober_profile['company_business_content'])
                                <h3>事業内容</h3>
                                <p class="paragraphBox">{!! nl2br($jober_profile['company_business_content']) !!}</p>
                                @endisset
                                @isset($jober_profile['company_establish_date'])
                                <h3>設立日</h3>
                                <p class="paragraphBox">{!! $jober_profile['company_establish_date'] !!}</p>
                                @endisset
                                @isset($jober_profile['company_employee'])
                                <h3>従業員数</h3>
                                <p class="paragraphBox">{!! nl2br($jober_profile['company_employee']) !!}</p>
                                @endisset
                                @isset($jober_profile['company_url'])
                                <h3>ホームページ</h3>
                                <p class="paragraphBox"><a href="{!! $jober_profile['company_url'] !!}" target="_blank" rel="noopener noreferrer nofollow">{!! $jober_profile['company_url'] !!}</a></p>
                                @endisset
                                <div class="buttonArea paragraphBox">
                                    <a href="/jobList/{{ $jober_id }}" class="action-button button-type_white"><i class="fa-solid fa-table-cells-large" style="color: #333333;"></i>&nbsp;この企業の求人一覧を見る</a>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="block5">
                        <div class="tableWork">
                            @isset($job['post_selection'])
                            <section class="mass">
                                <h2>選考について</h2>
                                <p>{!! nl2br($job['post_selection']) !!}</p>
                            </section>
                            @endisset
                        </div>
                    </div>
                    @if ($page !== 'jober')
                    <div class="row mt-2 narrow">
                        <div class="buttonArea">
                            <a href="{{ route('home.jobAppForm',$job['id']) }}" class="action-button button-type_green">
                            {{-- <a href="{{ route('user.bid_content',$job['id']) }}" class="action-button button-type_green"> --}}
                                <i class="fa-regular fa-circle-check fa-lg" style="color: #ffffff;"></i>&nbsp;応募画面へ進む
                            </a>
                            @guest
                            <a onclick="get_login();" class="action-button button-type_blue line2 mail">
                                <i class="fa-regular fa-envelope fa-lg" style="color: #ffffff;"></i><span class="anc">&nbsp;無料会員登録して<br>メッセージを送る</span>
                            </a>
                            @else
                            <a onclick="create_session( {{ $job['jober_id'] }} );" class="action-button button-type_blue mail">
                                <i class="fa-regular fa-envelope fa-lg" style="color: #ffffff;"></i><span class="anc">&nbsp;メッセージを送る</span>
                            </a>
                            <form id="message-form" action="{{ route('user.message_page') }}" method="post">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job['id'] }}">
                                <input type="hidden" name="jober_id" value="{{ $job['jober_id'] }}">
                                <input type="hidden" name="session_id" id="session_id" value="">
                            </form>
                            @endguest
                            @if (Auth::check())
                            <favorite :job="{{ $job->id }}" :favorited={{ $job->favorited() ? "true" : "false" }}></favorite>
                            @else
                            <a href="/login" class="action-button button-type_fav">
                                <i class="fa-regular fa-heart fa-lg" style="color: #ff3300;"></i><span class="anc">&nbsp;気になる</span>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </article>

    <div class="stickyFoot">
        <div class="stickyFootItem">
            <div class="jobInfo">
                <!--<p class="jobTitle">{{ Str::limit($job['post_title'], 64, '...') }}</p>-->
                <p class="jobTitle">{{ $job['post_title'] }}</p>
                <p class="companyName">{{ $jober_profile['company_name'] }}</p>
            </div>
            <div class="buttonArea">
                <a href="{{ route('home.jobAppForm',$job['id']) }}" class="action-button button-type_green">
                {{-- <a href="{{ route('user.bid_content',$job['id']) }}" class="action-button button-type_green"> --}}
                    <i class="fa-regular fa-circle-check fa-lg" style="color: #ffffff;"></i>&nbsp;応募画面へ進む
                </a>
                @guest
                <a onclick="get_login();" class="action-button button-type_blue line2 mail">
                    <i class="fa-regular fa-envelope fa-lg" style="color: #ffffff;"></i><span class="anc">&nbsp;無料会員登録して<br>メッセージを送る</span>
                </a>
                @else
                <a onclick="create_session( {{ $job['jober_id'] }} );" class="action-button button-type_blue mail">
                    <i class="fa-regular fa-envelope fa-lg" style="color: #ffffff;"></i><span class="anc">&nbsp;メッセージを送る</span>
                </a>
                <form id="message-form" action="{{ route('user.message_page') }}" method="post">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job['id'] }}">
                    <input type="hidden" name="jober_id" value="{{ $job['jober_id'] }}">
                    <input type="hidden" name="session_id" id="session_id" value="">
                </form>
                @endguest
                @if (Auth::check())
                <favorite :job="{{ $job->id }}" :favorited={{ $job->favorited() ? "true" : "false" }}></favorite>
                @else
                <a href="/login" class="action-button button-type_fav">
                    <i class="fa-regular fa-heart fa-lg" style="color: #ff3300;"></i><span class="anc">&nbsp;気になる</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function get_login() {
        window.location = '/login';
    }

    function create_session($friend_id) {
        $.post("{{ route('session.create') }}", {
            friend_id: $friend_id
        }, function(res) {
            if (res != 'error') {
                $('#session_id').val(res.data.id);
                $('#message-form').submit();
            } else {
                window.location = '{{ route("chatting") }}';
            }
        });
    }
</script>
<script>
    $(function() {
        var w_size = $(window).outerWidth();
        var count = $('.owl-stage .owl-item').length;
        if (w_size > 640) {
            if (4 > count) {
                $('.owCar').removeClass('ow-car');
                $('.owl-carousel').owlCarousel({
                    items: 3,
                    margin: 5,
                    autoplay: false,
                    loop: false,
                    pagination: false,
                });
                $('#jobDetail .owl-nav').css('display', 'none');
            } else {
                $('.owl-carousel').owlCarousel({
                    items: 3,
                    margin: 5,
                    autoplay: true,
                    loop: true,
                    pagination: true,
                });
            }
        } else if (640 >= w_size && w_size > 600) {
            if (3 > count) {
                $('.owCar').removeClass('ow-car');
                $('.owl-carousel').owlCarousel({
                    items: 2,
                    margin: 5,
                    autoplay: false,
                    loop: false,
                });
            } else {
                $('.owl-carousel').owlCarousel({
                    items: 2,
                    margin: 5,
                    autoplay: true,
                    loop: true,
                });
            }
        } else {
            if (2 > count) {
                $('.owCar').removeClass('ow-car');
                $('.owl-carousel').owlCarousel({
                    items: 1,
                    margin: auto,
                    autoplay: false,
                    loop: false,
                });
            } else {
                $('.owl-carousel').owlCarousel({
                    items: 1,
                    margin: auto,
                    autoplay: true,
                    loop: true,
                });
            }
        }
    });
</script>
@endsection