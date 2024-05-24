@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .text-tag{
            text-align:center;
            color:#0074c1!important;
            text-decoration: underline!important;
        }
        .img-round{
            width: 80px;
            height: 80px;
            border-radius: 65px;
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
                            <h3>メッセージを送る</h3>
                        </div>
                        <div class="box-content">
                            <p class="normal-font mt-2">
                                <?php  $jober = App\Models\Jober_profile::where('jober_id', $receive)->first() ; ?>
                                <img src="{{ asset('images/jober_profile') }}/{{ $jober->company_img }}" alt="" class="img-round">
                                {{ $jober->company_name }}様へ
                            </p>
                            <?php $job = App\Models\Job::where('id', $job_id)->first(); ?>
                            <p class="normal-font mt-2">案件名 : <a href="{{ route('home.job_detail',$job->id) }}" class="text-tag">{{ $job->post_title }}</a></p>
                            <form action="/send_first_message/{{ $session_id }}" method="post">
                                @csrf
                                <input type="hidden" name="to_user" value="{{ $receive }}">
                                <input type="hidden" name="session_id" value="{{ $session_id }}">
                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                <textarea name="message" class="form-control mt-4" rows="7"></textarea>
                                <div class="row mt-4">
                                    <button type=submit" class="action-button shadow animate orange col-md-push-4 col-md-4">送信する</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

