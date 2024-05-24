@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>コンテンツリスト</li>
            </ul>
        </div>
    </div>

    <article id="search">
        <section class="sec02">
            <ul class="list_jobs">
                @foreach($articles as $article)
                    <li>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset('images/blogs')}}/{{ $article['media_url'] }}" alt="" width="100%">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row col-md-12 mt-4 mb-1">
                                            <div class="col-md-8 text-center">
                                                <h4 class="b_font">{{ $article['article_title'] }}</h4>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <p class="day">掲載日：{{ Illuminate\Support\Carbon::parse($article['updated_at'])->format('Y.m.d') }}</p>
                                            </div>
                                        </div>
                                        <div class="row col-md-12 mt-1">
                                            {{ \App\Http\Controllers\HomeController::trip_text($article['article_content']) }}...
                                        </div>
                                        <hr>
                                        <dl class="text-center">
                                            <a href="{{ route('home.blog_detail',$article['id']) }}">詳しく見る</a>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    {!! $articles->links() !!}
                </div>
            </div>
        </section>
    </article>
@endsection
