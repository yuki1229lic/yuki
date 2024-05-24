@extends('layouts.admin.admin_main_layout')
@section('content')
<style>
    th {
        width: 25%;
        text-align: center;
        vertical-align: middle !important;
    }

    td {
        text-align: left;
        vertical-align: middle;
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
                            <a href="{{ route('admin.enterprise_job_list',$job['jober_id']) }}" class="btn btn-outline-success float-lg-right"><i class="fa fa-reply"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3>{{ $job['post_title'] }}</h3>
                                </div>
                                <div class="col-md-3">
                                    <p>掲載日：{{ Illuminate\Support\Carbon::parse($job['updated_at'])->format('Y.m.d') }}　掲載No.{{ $job['id'] }}</p>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>画像</th>
                                        <td>
                                            <?php
                                            $img = json_decode($job['post_img'], true);
                                            ?>
                                            @foreach($img as $img)
                                            <img src="{{ asset('images/jobs')}}/{{ $img }}" alt="" width="150">
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>報酬</th>
                                        <td>
                                            @if($job['post_payment_text'])
                                            <p class="itemBox">&nbsp;&nbsp;&nbsp;
                                                月額報酬&nbsp;：{!! $job['post_payment_text'] !!}万円 {{ $job['post_is_payment_more'] ? '以上' : ''}}
                                                {{ $job['post_payment_max_text'] ? '〜' . $job['post_payment_max_text'] . '万円' : ''}}
                                            </p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>職種</th>
                                        <td>
                                            <?php
                                            $category_list = json_decode($job['post_category'], true);
                                            ?>
                                            @foreach($category_list as $category)
                                            {{ $category }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>仕事内容</th>
                                        <td>
                                            {!! nl2br($job['post_other']) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>応募資格</th>
                                        <td>
                                            {!! nl2br($job['post_require']) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>こんな方にオススメ</th>
                                        <td>
                                            {!! nl2br($job['post_suitable']) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>勤務地</th>
                                        <td>
                                            <p class="paragraphBox">
                                                @isset($job['working_place'])
                                                @foreach($job['working_place'] as $key => $place)
                                                {{ $place['area_name'] }}
                                                @endforeach
                                                @endisset
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>稼働時間</th>
                                        <td>
                                            @isset($job['post_working_time'])
                                            {!! nl2br($job['post_working_time']) !!}
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>報酬例</th>
                                        <td>
                                            @if($job['post_payment_text'])
                                            月額報酬&nbsp;：{!! $job['post_payment_text'] !!}万円 {{ $job['post_is_payment_more'] ? '以上' : ''}}
                                            {{ $job['post_payment_max_text'] ? '〜' . $job['post_payment_max_text'] . '万円' : ''}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>支払いサイト</th>
                                        <td>
                                            @isset($job['post_rental_car'])
                                            {!! nl2br($job['post_rental_car']) !!}
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>雇用形態</th>
                                        <td>
                                            <?php
                                            $contract_types = json_decode($job['post_contract_type'], true);
                                            ?>
                                            @php
                                            $contract_types = $contract_types ?? [];
                                            @endphp

                                            @foreach ($contract_types as $contract_type)
                                            <li><i class="fa-solid fa-square-check" style="color: #0074c1;"></i>&nbsp;{{ $contract_type }}</li>
                                            @endforeach
                                        </td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>特徴タグ</th>
                                        <td>
                                            <?php
                                            $benefits = json_decode($job['post_benefit'], true);
                                            ?>
                                            @foreach($benefits as $benefit)
                                            <li><i class="fa-solid fa-square-check" style="color: #0074c1;"></i>&nbsp;{{ $benefit }}</li>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>職場について</th>
                                        <td>
                                            @foreach($job_prs as $job_pr)
                                            <h2>
                                                {!! $job_pr['post_pr_type'] !!}
                                                @if($job_pr['post_pr_text'] === 'その他')
                                                {!! $job_pr['post_pr_title'] !!}
                                                @else
                                                {!! $job_pr['post_pr_type'] !!}
                                                @endif
                                            </h2>
                                            <p class="paragraphBox">
                                                {!! nl2br($job_pr['post_pr_text']) !!}<br><br>
                                            </p>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>選考について</th>
                                        <td>
                                            {!! $job['post_selection'] !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>求める人材</th>
                                        <td>
                                            {!! nl2br($job['post_require']) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 mt-lg-5">
                            <h3> 応募リスト</h3>
                            <hr>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>応募者名</th>
                                        <th>応募日付</th>
                                        <th>採用状況</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bids as $bid)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ App\Models\User::where('id',$bid['user_id'])->first()->name }}</td>
                                        <td>{{ Illuminate\Support\Carbon::parse($bid['created_at'])->format('Y.m.d')  }}</td>
                                        <td>
                                            @if($bid->hired_status == 1)
                                            <a class="btn btn-danger">非採用</a>
                                            @elseif($bid->hired_status == 2)
                                            <a class="btn btn-warning">採用完了</a>
                                            @else
                                            <a class="btn btn-success">採用</a>
                                            @endif
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
    $(document).ready(function() {
        $('.datatable').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
            }
        });
    })
</script>
@endsection