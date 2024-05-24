@extends('layouts.admin.admin_main_layout')
@section('content')
    <style>
        td{
            vertical-align:middle;
            text-align:center;
            align-items: center;
            justify-items: center;
        }
        h4{
            color:white;
            width: 300px;
            text-align: center;
            padding: 10px 5px;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <a href="{{ route('admin.enterprise_list') }}" class="btn btn-outline-success float-lg-right"><i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-5">
                                <h4 style="background-color:#10dc10;">公開求人リスト</h4>
                                <hr>
                                <table class="table table-bordered datatable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="num">№</th>
                                        <th class="name">求人掲載会社名</th>
                                        <th class="email">求人タイトル</th>
                                        <th class="created">登録日付</th>
                                        <th class="management">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($public_jobs as $public_job)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="name">{{ App\Models\User::where('id',$public_job['jober_id'])->first()->name }}</td>
                                            <td class="email">{{ $public_job['post_title'] }}</td>
                                            <td class="created">{{ $public_job['created_at'] }}</td>
                                            <td class="management">
                                                <a href="{{ route('admin.job_detail',$public_job['id']) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.job_update',$public_job['id']) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('admin.job_delete',$public_job['id']) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 mt-5">
                                <h4 style="background-color:#0988e5;">非公開求人リスト</h4>
                                <hr>
                                <table class="table table-bordered datatable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="num">№</th>
                                        <th class="name">求人掲載会社名</th>
                                        <th class="email">求人タイトル</th>
                                        <th class="created">登録日付</th>
                                        <th class="management">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($non_public_jobs as $non_public_job)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="name">{{ App\Models\User::where('id',$non_public_job['jober_id'])->first()->name }}</td>
                                            <td class="email">{{ $non_public_job['post_title'] }}</td>
                                            <td class="created">{{ $non_public_job['created_at'] }}</td>
                                            <td class="management">
                                                <a href="{{ route('admin.job_update',$non_public_job['id']) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('admin.job_delete',$non_public_job['id']) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 mt-5">
                                <h4 style="background-color:#ee0606;">過去開求人リスト</h4>
                                <hr>
                                <table class="table table-bordered datatable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="num">№</th>
                                        <th class="name">求人掲載会社名</th>
                                        <th class="email">求人タイトル</th>
                                        <th class="created">登録日付</th>
                                        <th class="management">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($close_jobs as $close_job)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="name">{{ App\Models\User::where('id',$close_job['jober_id'])->first()->name }}</td>
                                            <td class="email">{{ $close_job['post_title'] }}</td>
                                            <td class="created">{{ $close_job['created_at'] }}</td>
                                            <td class="management">
                                                <a href="{{ route('admin.job_detail',$close_job['id']) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.job_delete',$close_job['id']) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

