@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li><a href="/blog_list">お役立ちコンテンツ</a></li>
                <li>{{ $article['article_title'] }}</li>
            </ul>
        </div>
    </div>

    <article id="news_d">
        <section class="sec01">
            <div class="inner">
                <p class="ttl">{{ $article['article_title'] }}</p>
                <p class="data">{{ Illuminate\Support\Carbon::parse($article['created_at'])->format('Y.m.d') }}</p>
                <img src="{{ asset('images/blogs')}}/{{ $article['media_url'] }}" alt="" class="article-img">

                <div class="cont mt-3">
                    {!!  $article['article_content']  !!}
                </div>
            </div>
        </section>
    </article>
@endsection
