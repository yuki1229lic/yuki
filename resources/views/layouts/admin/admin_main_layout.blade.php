<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ハコボウズ | 管理者</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=" {{ asset('admin/plugins/fontawesome-free/css/all.css') }} ">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href=" {{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/dist/css/adminlte.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/plugins/daterangepicker/daterangepicker.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/plugins/summernote/summernote-bs4.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/dist/css/table.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/dist/css/admin_style.css') }} ">
</head>
<body>
<div class="wrapper">
    @include('layouts.admin.admin_header')
    @include('layouts.admin.admin_navbar')
    @yield('content')
</div>
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script  src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/table.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
@yield('script')
</body>
</html>
