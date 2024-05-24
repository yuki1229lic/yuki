<!DOCTYPE html>
<html lang="jp">
<head>
    @isset($title)
    <title>{{ $title }}</title>
    @else
        @if (parse_url(url()->previous(), PHP_URL_PATH) === '/login')
        <title>会員ログイン｜軽貨物運送業界に特化した求人情報サイト ハコボウズ</title>
        @elseif (parse_url(url()->previous(), PHP_URL_PATH) === '/register')
        <title>新規会員登録フォーム｜軽貨物運送業界に特化した求人情報サイト ハコボウズ</title>
        @else
        <title>ハコボウズ｜軽貨物運送業界に特化した求人情報サイト</title>
        @endif
    @endisset
    <meta http-equiv="Content-Type" content="text/html" />
    <meta charset="UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @isset($description)
    <meta name="description" content={{ $description }}/>
    @else
        @if (parse_url(url()->previous(), PHP_URL_PATH) === '/login')
        <meta name="description" content="ハコボウズにログインすると、軽貨物ドライバーの求人情報へ簡単に応募ができます。非公開の求人情報を閲覧するには会員登録が必要です。ハコボウズ会員IDをお持ちでない方はぜひご登録ください。" />
        @elseif (parse_url(url()->previous(), PHP_URL_PATH) === '/register')
        <meta name="description" content="軽貨物ドライバーの求人情報を探すなら「ハコボウズ」。採用が決まると最大1万円のお祝い金を全員にプレゼント！ご希望のエリア・職種・給与やこだわりの条件であなたにピッタリの求人案件を見つけましょう！" />
        @else
        <meta name="description" content="ハコボウズは軽貨物運送業界に特化した求人サイトです。軽貨物ドライバーの方は勤務地や配送タイプから自分の希望条件に合う求人情報を探せます。軽貨物の求人に特化しているため、ドライバーの方は安心して求人に応募できます。今ならハコボウズを通して採用された方に祝い金を進呈中！" />
        @endif
    @endisset
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
    <meta name="google-site-verification" content="d7ri5r4txsHQzF8lmRSV1L0ziyOpxVNqKgxgp-7qY9U" />
    <link rel="icon" type="image/png" href="{{ asset('front/img/common/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('front/css/reset.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('front/css/base.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('front/css/extend-style.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('front/css/summernote-bs4.css')}}" type="text/css" media="all" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-209180669-1"></script>
    
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-209180669-1');
    </script>
    @isset($structuredDataFaq)
        @include('layouts.front.front_structuredDataFaq')
    @endisset
    @isset($structuredDataJob)
        @include('layouts.front.front_structuredDataJob')
    @endisset
    @include('gaHead')
</head>
<body>
    <div id="wrapper">
        @include('layouts.front.front_header')
        @yield('content')
        @include('layouts.front.front_footer')
    </div>

    <script type="text/javascript" src="{{ asset('front/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/owl.carousel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/common.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/summernote-bs4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/surface.js')}}"></script>
    <script src="{{asset('front/js/jquery.autoKana.js')}}"></script>
    @yield('script')
    @include('gaBody')
</body>
</html>
