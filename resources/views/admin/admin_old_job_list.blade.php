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
                    <h1 class="m-0 text-dark">過去求人リスト</h1>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-5">
                                <table class="table table-bordered datatable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="num">№</th>
                                        <th class="name">求人掲載会社名</th>
                                        <th class="email">求人タイトル</th>
                                        <th class="created">登録日付</th>
                                        <th class="management">&nbsp:</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($old_jobs as $old_job)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="name">
                                                <?php
                                                    $company = App\Models\User::where('id',$old_job['jober_id'])->first();

                                                    if($company != null){
                                                        $name = $company->name;
                                                    }else{
                                                       $name =  '会社名なし';
                                                    }
                                                ?>
                                                {{ $name }}
                                            </td>
                                            <td class="email">{{ $old_job['post_title'] }}</td>
                                            <td class="created">{{ $old_job['created_at'] }}</td>
                                            <td class="management">
                                                <div class="flex">
                                                    <a href="{{ route('admin.job_detail',$old_job['id']) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('admin.job_delete',$old_job['id']) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

