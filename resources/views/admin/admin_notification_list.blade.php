@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <table class="table table-bordered table-striped datatable information" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="num">№</th>
                                <th class="name">お知らせタイトル</th>
                                <th class="text">お知らせ内容</th>
                                <th class="management">youtube動画url</th>
                                <th class="created">登録日付</th>
                                <th class="management">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $item)
                                <tr>
                                    <td class="num">{{ $loop->iteration }}</td>
                                    <td class="name">{{ $item['notification_title'] }}</td>
                                    <td class="text">{{ $item['notification_content'] }}</td>
                                    <td class="media">{!! $item['media_url'] !!} </td>
                                    <td class="created">{{ $item['created_at'] }}</td>
                                    <td class="management">
                                        <a href="{{ route('admin.notification_delete',$item['id']) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.datatable').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
                }
            });
        });
    </script>
@endsection
