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
                            <?php
                                $jober_name = App\Models\User::where('id',$jober_id)->first()->name;
                            ?>
                            <div class="col-12 mt-5">
                                <h4>企業名 : {{ $jober_name }}</h4>
                                <p>今採用中リスト :</p>
                                <hr>
                                <table class="table table-bordered datatable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>採用者名</th>
                                        <th>求人タイトル</th>
                                        <th>採用日付</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($hires as $hire)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ App\Models\User::where('id',$hire['user_id'])->first()->name }}</td>
                                            <td>{{ App\Models\Job::where('id',$hire['job_id'])->first()->post_title }}</td>
                                            <td>{{ $hire['hired_date'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 mt-5">
                                <p>過去採用履歴 :</p>
                                <hr>
                                <table class="table table-bordered datatable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>求人案件</th>
                                        <th>採用者名</th>
                                        <th>採用日付</th>
                                        <th>完了日付</th>
                                        <th>可動日</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($old_hires as $hire)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ App\Models\Job::where('id',$hire['job_id'])->first()->post_title }}</td>
                                            <td>{{ App\Models\User::where('id',$hire['user_id'])->first()->name }}</td>
                                            <td>{{ $hire['hired_date'] }}</td>
                                            <td>{{ $hire['expired_date'] }}</td>
                                            <td>{{ Illuminate\Support\Carbon::parse( $hire->expired_date )->diffInDays( $hire->hired_date ) }}日</td>
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

