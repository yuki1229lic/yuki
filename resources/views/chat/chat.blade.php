<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ハコボウズ – チャット</title>
    <link href="{{ asset('chat/dist/css/lib/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('chat/dist/css/swipe.css') }}" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('front/img/common/favicon.png') }}"/>
    <script>
        window.auth = {!! auth()->user() !!};
        var url = '{{ asset('images/users/') }}/';
    </script>
</head>
<body>
<main id="app">
    <private-chat-component></private-chat-component>
</main>
<script src="{{ asset('chat/dist/js/jquery-3.3.1.slim.min.js')}}"></script>
<script>
    window.jQuery || document.write('<script src="{{ asset('chat/dist/js/vendor/jquery-slim.min.js')}}"><\/script>')
</script>
<script src="{{ asset('chat/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ mix('js/app.js') }}"></script>
{{--<script>--}}
{{--    function scrollToBottom(el) { el.scrollTop = el.scrollHeight; }--}}
{{--    scrollToBottom(document.getElementById('content'));--}}
{{--</script>--}}
</body>

</html>
