@extends('layouts.jober.jober_main_layout')
@section('content')
    <style>
        th{
            vertical-align: middle!important;
        }
    </style>
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li><a href="/jober/dashboard">マイページ</a></li>
                <li><a href="">{{ $job['post_title'] }}</a></li>
            </ul>
        </div>
    </div>
    <article id="search_d">
        <section class="sec01">
            <div class="inner">
                <p class="number">掲載日：{{ Illuminate\Support\Carbon::parse($job['updated_at'])->format('Y.m.d') }}　掲載No.{{ $job['id'] }}</p>
                <div class="box">
                    <div class="block1">
                        <?php
                        $img = json_decode($job['post_img'], true);
                        ?>
                        @if($img)
                        <figure><img src="{{ asset('images/jobs')}}/{{ $img[0] }}" class="article-img"></figure>
                        @else
                        <figure><img src="{{ asset('images/jobs')}}/{{ 'default.jpeg' }}" class="article-img"></figure>
                        @endif
                        <div class="col-md-12">
                            <p>
                                <span class="line">{{ $job['post_title'] }}</span>
                            </p>
                            <p class="mt-2">
                                <p class="mt-1">
                                    <?php
                                    $benefits = json_decode($job['post_benefit'], true);
                                    ?>
                                    @foreach($benefits as $benefit)
                                        <span><i class="fa fa-check-square-o"></i>{{ $benefit }}</span>
                                    @endforeach
                                </p>
                                <span>
                                    月額報酬 {!! $job['post_payment_text'] !!}万円 {{ $job['post_is_payment_more'] ? '以上' : ''}}
                                    {{ $job['post_payment_max_text'] ? '〜' . $job['post_payment_max_text'] . '万円' : ''}}
                                </span>
                                <br>
                                <?php
                                $areas = json_decode($job['post_working_place'], true);
                                ?>
                                @foreach($areas as $area)
                                    <a href="{{ route('home.area_search',$area) }}"><span class="badge badge-orange">{{ $area }}</span></a>
                                @endforeach
                                <br>
                                <?php
                                $category = json_decode($job['post_category'], true);
                                ?>
                                @foreach($category as $category)
                                <a href="{{ route('home.category_search',$category) }}">
                                         <span class="badge badge-info">
                                            {{ $category }}
                                        </span>
                                </a>
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="block2">
                        <h4>求人内容</h4>
                        <table cellpadding="0" class="table_work">
                            <tr>
                                <th>概要</th>
                                <td> {!! nl2br($job['post_other']) !!}</td>
                            </tr>
                            <tr>
                                <th>こんな方にオススメ</th>
                                <td>{!! nl2br($job['post_suitable']) !!}</td>
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
                                <td>
                                    {!! nl2br($job['post_payment']) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>支払いサイト</th>
                                <td>{!! nl2br($job['post_rental_car']) !!}</td>
                            </tr>
                            <tr>
                                <th>雇用形態</th>
                                <td>
                                    <?php
                                    $contract_types = json_decode($job['post_contract_type'], true);
                                    ?>
                                    @foreach($contract_types as $contract_type)
                                        <span class="badge badge-info">
                                            {{ $contract_types }}
                                        </span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>稼働時間・休日</th>
                                <td><?php
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
                            <tr>
                                <th>求める人材</th>
                                <td>{!! nl2br($job['post_require']) !!}</td>
                            </tr>
                            <tr>
                                <th>職場について</th>
                                <td>
                                    @foreach($job_prs as $job_pr)
                                        <span>
                                            {!! $job_pr['post_pr_type'] !!} :<br>
                                            @if ($job_pr['post_pr_title']) {!! $job_pr['post_pr_title'] !!}<br> @endif
                                            {!! nl2br($job_pr['post_pr_text']) !!}<br><br>
                                        </span>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
