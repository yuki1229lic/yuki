@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>{{ $notification['notification_title'] }}</li>
            </ul>
        </div>
    </div>

    <article id="news_d">
        <section class="sec01">
            <div class="inner">
                <p class="ttl">{{ $notification['notification_title'] }}</p>
                <p class="data">{{ Illuminate\Support\Carbon::parse($notification['created_at'])->format('Y.m.d') }}</p>

                <div class="cont mt-3">
                    {!!  nl2br($notification['notification_content']) !!}
                </div>
            </div>
        </section>
    </article>
@endsection
