@extends('layouts.jober.jober_main_layout')
@section('content')
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>現存採用リスト</h3>
                        </div>
                        <div class="box-content">
                            <table class="table table-bordered hireTable dataTable">
                                <tbody>
                                    <tr>
                                        <th>No.</th>
                                        <th>求人案件概要</th>
                                        <th>採用者名</th>
                                        <th>業務開始日</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    @foreach($hired_list as $hire)
                                    <tr>
                                        <td class="num">{{ $loop->iteration }}</td>
                                        <td>
                                            <?php
                                            $job = App\Models\Job::where('id',$hire->job_id)->first();
                                            $working_place = App\Models\Job_working_place::where('id',$hire->job_id)->get();
                                            $img = json_decode($job['post_img'], true);
                                            ?>
{{--                                        <div class="col-md-3">--}}
{{--                                            <img src="{{ asset('images/jobs')}}/{{ $img[0] }}" class="article-img" height="100">--}}
{{--                                        </div>--}}
                                            <h4>{{ $job['post_title'] }}</h4>
                                            <p class="mt-2">
                                                @isset($working_place)
                                                    @foreach($working_place as $key => $place)
                                                        <a href="{{ route('home.area_search',$place['city_id'] ?? $place['ken_id']) }}">
                                                            <span class="badge badge-orange">{{ $place['ken_name'] . $place['city_name'] }}</span>
                                                        </a>
                                                    @endforeach
                                                @endisset
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
                                            <div class="featureBox">
                                                <?php
                                                $benefits = json_decode($job['post_benefit'], true);
                                                ?>
                                                @foreach($benefits as $benefit)
                                                    <span class="feature">{{--<i class="fa fa-check-square-o"></i>--}}{{ $benefit }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            $user = App\Models\User::where('id',$hire->user_id)->first();
                                            ?>
                                            <a href="{{ route('home.user_profile',$hire->user_id) }}" class="text-link">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $hire->hired_date }}
                                        </td>
                                        <td>
                                            <a href="{{ route('chatting') }}" class="action-button blueButton">
                                                {{--<i class="fa fa-comment" style="color:white;"></i>--}}メッセージを送る
                                            </a>
{{--                                            <a href="{{ route('jober.hire_stop',$hire->id) }}" class="action-button redButton">--}}
{{--                                                --}}{{-- ポップアップ削除--}}
{{--                                                <a class="action-button redButton" onclick="hire_stop({{ $hire->id }})">--}}
{{--                                                --}}
{{--                                                退職通知--}}
{{--                                            </a>--}}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>過去採用履歴</h3>
                        </div>
                        <div class="box-content">
                            <table class="table table-bordered hireTable dataTable">
                                <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>求人案件概要</th>
                                    <th>採用者名</th>
                                    <th>採用日付</th>
                                    <th>完了日付</th>
                                    <th>可動日</th>
                                    <th></th>
                                </tr>
                                @foreach($old_hired_list as $hire)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td >
                                            <?php
                                            $job = App\Models\Job::where('id',$hire->job_id)->first();
                                            $working_place = App\Models\Job_working_place::where('id',$hire->job_id)->get();
                                            $img = json_decode($job['post_img'], true);
                                            ?>
                                            <h4>{{ $job['post_title'] }}</span></h4>
                                            <p class="mt-2">
                                                @isset($working_place)
                                                    @foreach($working_place as $key => $place)
                                                        <a href="{{ route('home.area_search',$place['city_id'] ?? $place['ken_id']) }}">
                                                            <span class="badge badge-orange">{{ $place['ken_name'] . $place['city_name'] }}</span>
                                                        </a>
                                                    @endforeach
                                                @endisset
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
                                        </td>
                                        <td>
                                            <?php
                                            $user = App\Models\User::where('id',$hire->user_id)->first();
                                            ?>
                                            <a href="{{ route('home.user_profile',$hire->user_id) }}" class="text-link">
                                            {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $hire->hired_date }}</td>
                                        <td>{{ $hire->expired_date }}</td>
                                        <td>{{ Illuminate\Support\Carbon::parse( $hire->expired_date )->diffInDays( $hire->hired_date ) }}日</td>
                                        <td>
                                            <a href="{{ route('chatting') }}" class="action-button blueButton">
                                                {{--<i class="fa fa-comment" style="color:white;"></i>--}}メッセージを送る
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
{{--        <div class="modal fade" id="quickView2" tabindex="-1">--}}
{{--            <div class="modal-dialog modal-dialog-centered">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <div class="product-details">--}}
{{--                                    <form action="{{ route('jober.hire_stop') }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <label for="">退職の日付を選択してください。</label>--}}
{{--                                        <input type="hidden" name="hire_id" id="hire_id">--}}
{{--                                        <input type="date" name="hire_stop_date" class="form-control">--}}
{{--                                        <div class="row mt-4">--}}
{{--                                            <div class="col-sm-12">--}}
{{--                                                <button type="submit" class="action-button shadow animate green-btn col-md-push-3 col-md-6">退職通知をする</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </section>
    <script>
        // function hire_stop(hire_id){
        //     $('#hire_id').val(hire_id);
        //     $('#quickView2').modal('show');
        // }
    </script>
@endsection

