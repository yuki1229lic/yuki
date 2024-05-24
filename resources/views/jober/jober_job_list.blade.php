@extends('layouts.jober.jober_main_layout')
@section('content')
    <style>
        .btn-danger, .btn-primary, .btn-success{
            padding:10px 0px;
            border-radius: 3px;
        }
        .number-span{
            text-align: center;
            border-radius: 50%;
            background-color: #39de0e;
            color: white;
            padding: 10px 17px 7px 17px;
            font-size: 25px;
        }
        td{
            padding:5px 10px!important;
            vertical-align: middle!important;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>求人リスト</h3>
                        </div>
                        <div class="box-content">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="60%">案件の概要</th>
                                            <th width="10%">ステータス</th>
                                            <th width="5%">閲覧数</th>
                                            <th width="5%">応募者数</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $job)
                                            <tr>
                                                <td>{{ $loop->iteration }}
                                                <input type="checkbox" name="jobs_check">
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-4 col-sm-4">
                                                                <?php
                                                                $img = json_decode($job['post_img'], true);
                                                                ?>

                                                                @if($img)
                                                                <figure><img src="{{ asset('images/jobs')}}/{{ $img[0] }}" class="post_img" width="150"></figure>
                                                                @else
                                                                <figure><img src="{{ asset('images/jobs')}}/{{ 'default.jpeg' }}" class="post_img" width="150"></figure>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8 col-sm-8">
                                                                <h4>
                                                                    <span class="line">{{ $job['post_title'] }}</span>
                                                                </h4>
                                                                <p class="mt-2">
                                                                    <?php
                                                                    $areas = json_decode($job['post_working_place'], true);
                                                                    ?>
                                                                    @foreach($areas as $area)
                                                                        <a href="{{ route('home.area_search',$area) }}"><span class="badge badge-orange">{{ $area }}</span></a>
                                                                    @endforeach
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
                                                                <p class="mt-2">
                                                                    <?php
                                                                    $benefits = json_decode($job['post_benefit'], true);
                                                                    ?>
                                                                    @foreach($benefits as $benefit)
                                                                        <span><i class="fa fa-check-square-o"></i>{{ $benefit }}</span>
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="status" onchange="job_change_status({{$job['id']}});return false;" id="status{{$job['id']}}">
                                                        <option value=1>公開</option>
                                                        <option value=0>非公開</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    {{ $job['view'] }}人
                                                </td>
                                                <td>
                                                    <?php
                                                    $bids = App\Models\Bid::where('job_id',$job['id'])->get();
                                                    ?>
                                                    {{ count($bids) }}人
                                                </td>
                                                <td>
                                                    <a href="{{ route('home.job_detail',$job['id']) }}" class="action-button shadow animate blue-btn col-sm-12">公開ページ確認</a>
                                                    <a href="{{ route('jober.bid_list',$job['id']) }}" class="action-button shadow animate green-btn col-sm-12">応募者リスト</a>
                                                    <a href="{{ route('jober.job_stop',$job['id']) }}" class="action-button shadow animate red-btn col-sm-12">求人掲載終了</a>
                                                    <a href="{{ route('jober.job_tempory_stop',$job['id']) }}" class="action-button shadow animate orange col-sm-12">非公開にする</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {!! $jobs->links() !!}
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="modal fade" id="quickView" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="product-details">
                                                <form action="{{ route('jober.job_status_change') }}" method="POST">
                                                    @csrf
                                                    <label for="">ステータスを<p id="post_status_name" class="bol"></p>に変更します</label>
                                                    <input type="hidden" name="job_id" id="job_id">
                                                    <input type="hidden" name="post_status" id="post_status">
                                                    <div class="row mt-4">
                                                        <div class="col-sm-12">
                                                            <button type="submit" class="action-button shadow animate green-btn col-md-push-3 col-md-6">変更する</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function job_change_status(job_id){
            $('#job_id').val(job_id);
            $('#post_status').val($('#status' + job_id).val());
            $('#post_status_name').text($('#status' + job_id + ' option:selected').text());
            $('#quickView').modal('show');
        };
    </script>
@endsection

