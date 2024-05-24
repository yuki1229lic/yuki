@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .table th ,td{
            text-align:center!important;
            vertical-align: middle!important;
        }
        .box-content{
            min-height: 500px;
            margin-bottom: 30px;
            overflow-y: auto;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>お気に入りリスト</h3>
                        </div>
                        <div class="box-content">
                            <table class="table table-bordered userTableList"">
                                <thead>
                                    <tr>
                                        <th class="img">画像</th>
                                        <th>求人タイトル</th>
                                        <th class="num">掲載番号</th>
                                        <th class="icon">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="app">
                                    @foreach($myFavorites as $job)
                                    <tr>
                                        <?php
                                        $img = json_decode($job['post_img'], true);
                                        ?>
                                        <td class="img">
                                            <img src="{{ asset('images/jobs')}}/{{ $img[0] }}" alt="" width="100">
                                        </td>
                                        <td class="title">
                                            <a href="{{ route('home.job_detail',$job['id']) }}" style="color:#003399; text-decoration: underline;">
                                                {{ $job['post_title'] }}
                                            </a>
                                        </td>
                                        <td class="num">
                                            No.{{ $job->id }}
                                        </td>
                                        <td class="icon">
                                            <a href="{{ route('user.remove_favorite',$job->id) }}" class="">
                                                <i class="fa fa-times" style="color:red;"></i>
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
    </section>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection

