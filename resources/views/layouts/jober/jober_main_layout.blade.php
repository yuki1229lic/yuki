<!DOCTYPE html>
<html lang="jp">
<head>
    <title>ハコボウズ</title>
    <meta http-equiv="Content-Type" content="text/html" />
    <meta charset="UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
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
    <link rel="stylesheet" href="{{ asset('jober/css/base.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-209180669-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-209180669-1');
    </script>
    @include('gaHead')
</head>
<body>
    <div id="wrapper">
        @include('layouts.jober.jober_header')
        @yield('content')
        @include('layouts.jober.jober_footer')
    </div>

    <script type="text/javascript" src="{{ asset('front/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/owl.carousel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/common.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/summernote-bs4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/surface.js')}}"></script>
    @yield('script')
    @include('gaBody')
</body>
</html>
