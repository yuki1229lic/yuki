@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                @if (isset($isJobList))
                <li>{{ $jobs[0]['company_name'] }}の求人一覧</li>
                @else
                <li>お仕事検索</li>
                    @isset($job['working_place'])
                        <li><a href="/area_search/{{ $job['working_place'][0]['ken_id'] }}">{{ $job['working_place'][0]['ken_name'] }}</a></li>
                    @endif
                    @isset($keyword)
                        <li>&emsp;-&emsp;キーワード検索 : {{ $keyword }}</li>
                    @endif
                    @isset($category_search_list)
                        <li>&emsp;-&emsp;カテゴリー検索 : {{ $category_search_list }}</li>
                    @endif
                    @isset($ken_search)
                        <li>&emsp;-&emsp;勤務地検索 : {{ $ken_search->ken_name }}</li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
    <article id="search">
        @include('front.search_form')
        <section class="sec02">
            <ul class="list_jobs" id="favorite">
                @foreach($jobs as $job)
                <li>
                    <div class="jobDigest">
                        <div class="jobHead">
                            <?php
                                $img = json_decode($job['post_img'], true);
                            ?>
                            <a class="photo" href="{{ route('home.job_detail',$job['id']) }}">
                                @if($img)
                                <img src="{{ asset('images/jobs')}}/{{ $img[0] }}" alt="" class="article-img">
                                @else
                                <img src="{{ asset('images/jobs')}}/{{ 'default.jpeg' }}" alt="" class="article-img">
                                @endif
                            </a>
                            <div class="companyInfo">
                                <p class="logo">
                                    <img src="{{ asset('images/jober_profile') }}/{{ $job['company_img'] }}" alt="{{ $job['company_name'] }}"></p>
                                <p class="name"><a href="/jobList/{{ $job['jober_id'] }}">{{ $job['company_name'] }}</a></p>
                            </div>
                        </div>
                        <div class="jobInfo">
                            <h4 class="job-title"><a href="{{ route('home.job_detail',$job['id']) }}">{{ Str::limit($job['post_title'], 60, '...') }}</a></h4>
                            <p class="jobCat">
                            <!--@isset($job['working_place'])
                                @foreach($job['working_place'] as $key => $place)
                                    <a href="{{ route('home.area_search',$place['area_id']) }}">
                                        <span class="badge badge-orange">{{ $place['area_name'] }}</span>
                                    </a>
                                @endforeach
                            @endisset
                                <br-->
                                <?php
                                    $category = json_decode($job['post_category'], true);
                                ?>
                                @foreach($category as $category)
                                    <a href="{{ route('home.category_search',$category) }}">
                                        <span class="badge badge-info">
                                            {{ $category }}
                                        </span>
                                    </a>
                                @endforeach
                            </p>
                            <!--div class="date">
                                <p class="day">掲載日：{{ Illuminate\Support\Carbon::parse($job['updated_at'])->format('Y.m.d') }}　掲載No.{{ $job['id'] }}</p>
                            </div-->
                            <div class="jobContent">
                                <!--p>{{ \App\Http\Controllers\HomeController::trip_text($job['post_other']) }}...</p-->
                                <ul class="jobItem">
                                    <li>
                                        <p class="job-content-title"><i class="fa-regular fa-clock" style="color: #0074c1;"></i>&nbsp;稼働時間</p>
                                        <p class="job-content">
                                            {{ \App\Http\Controllers\HomeController::trip_text($job['post_working_time']) }}...
                                        </p>
                                    </li>
                                    <li>
                                        @if($job['post_payment_text'])
                                        <p class="job-content-title"><i class="fa-solid fa-yen-sign" style="color: #0074c1;"></i>月額報酬</p>
                                        <p class="job-content">
                                            {!! $job['post_payment_text'] !!}万円 {{ $job['post_is_payment_more'] ? '以上' : ''}}
                                            {{ $job['post_payment_max_text'] ? '〜' . $job['post_payment_max_text'] . '万円' : ''}}
                                        @else
                                            {{ \App\Http\Controllers\HomeController::trip_text($job['post_payment']) }}...
                                        @endif
                                        </p>
                                    </li>
                                </ul>
                                <ul class="tagList">
                                    <?php
                                    $benefits = json_decode($job['post_benefit'], true);
                                    ?>
                                    @foreach($benefits as $benefit)
                                    <li><i class="fa-solid fa-square-check" style="color: #0074c1;"></i>&nbsp;{{ $benefit }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-btn narrow">
                        <div class="buttonArea between">
                            <p class="update"><i class="fa-solid fa-clock-rotate-left" style="color: #0074c1;"></i>&nbsp{{ $job->displayDaysAgo }}</p>
                            @if (Auth::check())
                                <favorite :job="{{ $job->id }}" :favorited={{ $job->favorited() ? "true" : "false" }}></favorite>
                            @else
                                <a href="/login" class="action-button button-type_fav">
                                    <i class="fa-regular fa-heart fa-lg" style="color: #ff3300;"></i><span class="anc">&nbsp;気になる</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    {!! $jobs->links() !!}
                </div>
            </div>
        </section>
    </article>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
