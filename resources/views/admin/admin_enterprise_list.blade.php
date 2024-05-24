@extends('layouts.admin.admin_main_layout')
@section('content')
    <style>
        td{
            vertical-align:middle;
            text-align:center;
            align-items: center;
            justify-items: center;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    @if ($isDsp)
                    <h1 class="m-0 text-dark">DSP企業リスト</h1>
                    @else
                    <h1 class="m-0 text-dark">企業リスト</h1>
                    @endif
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-5">
                                <table class="table table-bordered datatable">
                                    <thead>
                                    <tr>
                                        <th class="num">№</th>
                                        <th class="name">名前</th>
                                        <th class="email">メール</th>
                                        <th class="created">登録日付</th>
                                        <th class="management">&nbsp:</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($enterprises as $enterprise)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="name">{{ $enterprise['name'] }}</td>
                                            <td class="email">{{ $enterprise['email'] }}</td>
                                            <td class="created">{{ $enterprise['created_at'] }}</td>
                                            <td class="management">
                                                <div class="flex">
                                                    <a href="{{ route('admin.enterprise_profile',$enterprise['id']) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('admin.job_register',$enterprise['id']) }}" class="btn btn-outline-success"><i class="fa fa-hammer"></i></a>
                                                    <a href="{{ route('admin.enterprise_job_list',$enterprise['id']) }}" class="btn btn-outline-info"><i class="fa fa-calendar-check-o"></i></a>
                                                    <a href="{{ route('admin.enterprise_hire_list',$enterprise['id']) }}" class="btn btn-outline-primary"><i class="fa fa-handshake"></i></a>
                                                    <a href="{{ route('admin.user_password', $enterprise['id'])}} " class="btn btn-outline-warning"><i class="fa fa-key"></i></a>
                                                    <a href="{{ route('admin.user_delete',$enterprise['id']) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $('.datatable').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
                }
            });
        })
    </script>
@endsection

