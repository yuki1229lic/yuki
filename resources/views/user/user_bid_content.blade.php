@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        th{
            text-align:center;
            vertical-align: middle;
            width: 30%;
        }
        .img-round{
            width: 80px;
            height: 80px;
            border-radius: 65px;
            object-fit: cover;
        }
        button{
            outline: none;
            border:none;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>{{ $job['post_title'] }}</h3>
                        </div>
                        <div class="box-content">
                            <p class="normal-font mt-2">
                                <img src="{{ asset('images/jober_profile') }}/{{ $jober->company_img }}" alt="" class="img-round">
                                {{ $jober->company_name }}様
                            </p>

                            <h3 class="mt-3 mb-1">求人内容</h3>

                            <table class="table table-bordered didContactTable">
                                <tr>
                                    <th>概要</th>
                                    <td> {!! nl2br($job['post_other']) !!}</td>
                                </tr>
                                <tr>
                                    <th>勤務地</th>
                                    <td>
                                        <?php
                                        $areas = json_decode($job['post_working_place'], true);
                                        ?>
                                        @foreach($areas as $area)
                                            <span class="badge">{{ $area }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>報酬</th>
                                    <td>
                                        月額報酬 {!! $job['post_payment_text'] !!}万円 {{ $job['post_is_payment_more'] ? '以上' : ''}}
                                        {{ $job['post_payment_max_text'] ? '〜' . $job['post_payment_max_text'] . '万円' : ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>ロイヤリティ</th>
                                    <td> {!! nl2br($job['post_revenue']) !!}</td>
                                </tr>
                                <tr>
                                    <th>報酬例</th>
                                    <td> {!! nl2br($job['post_payment']) !!}</td>
                                </tr>
                                <tr>
                                    <th>支払いサイト</th>
                                    <td>{!! nl2br($job['post_rental_car']) !!}</td>
                                </tr>
                                <tr>
                                    <th>稼働時間・休日</th>
                                    <td>
                                        <?php
                                        $working_time_types = json_decode($job['post_working_time_type'], true);
                                        ?>
                                        @isset($working_time_types)
                                            @foreach($working_time_types as $working_time_type)
                                                <span>{!! $working_time_type !!}</span><br>
                                            @endforeach
                                        @endisset
                                        <br>
                                        {!! nl2br($job['post_working_time']) !!}
                                    </td>
                                </tr>
                            </table>

                            <h3 class="mt-4">備考・PR（任意） : </h3>
                            <form action="{{ route('user.bid_post') }}" method="post">
                                @csrf
                                <input type="hidden" name="jober_id" value="{{ $job->jober_id }}">
                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                <textarea name="bid_content" class="form-control mt-1" rows="10" placeholder="連絡希望の時間帯やその他伝えたい内容を記入します。"></textarea>
                                <div class="row mt-4">
                                    <button type="submit" class="action-button shadow animate orange col-md-push-4 col-md-4">
                                        <i class="fa fa-gavel" style="color:white;"></i>応募する
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

