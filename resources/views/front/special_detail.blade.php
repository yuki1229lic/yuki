@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li><a href="{{ route('home.special_list') }}">特集求人リスト</a></li>
                <li>{{ $special['special_title'] }}</li>
            </ul>
        </div>
    </div>
    <article id="news_d">
        <section class="sec01">
            <div class="inner">
                <img src="{{ asset('images/special')}}/{{ $special['special_img'] }}" alt="" class="wp-article-img">
                <p class="ttl mt-3">{{ $special['special_title'] }}</p>
                <p class="data">{{ Illuminate\Support\Carbon::parse($special['created_at'])->format('Y.m.d') }}</p>
                <div class="col-md-12 mb-3">
                    <p>
                        <a href="{{ route('home.area_search',$special['special_area']) }}">
                            <span class="badge badge-orange">{{ $special['special_area'] }}</span>
                        </a>
                        <a href="{{ route('home.category_search',$special['special_category']) }}">
                             <span class="badge badge-info">
                                {{ App\Models\Job_kind::where('id',$special['special_category'])->first()->kind_name }}
                            </span>
                        </a>
                    </p>
                </div>
                <div class="cont mt-3">
                    {!!  $special['special_content']  !!}
                </div>
            </div>
        </section>
    </article>
    <article id="search_d">
        <section class="sec02">
            <div class="inner">
                <ul class="list_jobs" id="app">
                    @foreach($jobs as $job)
                        <li>
                            <a href="{{ route('home.job_detail',$job['id']) }}">
                                <div class="row">
                                    <div class="col-md-8 text-center">
                                        <h4 class="job-title">{{ $job['post_title'] }}</h4>
                                    </div>
                                    <div class="col-md-4 text-right">
                                    @if (Auth::check())
                                        <favorite :job="{{ $job->id }}" :favorited={{ $job->favorited() ? "true" : "false" }}></favorite>
                                    @else
                                        <a href="/login" class="action-button button-type_fav">
                                            <i class="fa-regular fa-heart fa-lg" style="color: #ff3300;"></i><span class="anc">&nbsp;気になる</span>
                                        </a>
                                    @endif
                                        <p class="day">掲載日：{{ Illuminate\Support\Carbon::parse($job['updated_at'])->format('Y.m.d') }}　掲載No.{{ $job['id'] }}</p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php
                                                $img = json_decode($job['post_img'], true);
                                                ?>
                                                <img src="{{ asset('images/jobs')}}/{{ $img[0] }}" alt="" width="100%">
                                            </div>
                                            <div class="col-md-6">
                                                {!! $job['post_other'] !!}
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <p class="job-content-title">職種</p>
                                                <p class="job-content">
                                                    {{ App\Models\Job_kind::where('id',$job['post_category'])->first()->kind_name }}
                                                </p>
                                                <p class="job-content-title mt-1">勤務地</p>
                                                <p class="job-content">
                                                    <?php
                                                    $areas = json_decode($job['post_working_place'], true);
                                                    ?>
                                                    @foreach($areas as $area)
                                                        <span class="badge">{{ $area }}</span>
                                                    @endforeach
                                                </p>
                                                <p class="job-content-title mt-1">報酬</p>
                                                <p class="job-content">
                                                    {!! $job['post_payment'] !!}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="job-content-title">売上シュミレーション</p>
                                                <p class="job-content">
                                                    {!! $job['post_revenue'] !!}
                                                </p>
                                                <p class="job-content-title mt-1">車両レンタル</p>
                                                <p class="job-content">
                                                    {!! $job['post_rental_car'] !!}
                                                </p>
                                                <p class="job-content-title">稼働時間</p>
                                                <p class="job-content">
                                                    {!! $job['post_working_time'] !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </article>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
