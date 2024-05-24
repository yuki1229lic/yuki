@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .user-panel{
            margin: 50px 0;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="first-box mt-5">
                        <p class="alarm-size">応募が完了しました。</p>
                        <div class="row mt-4">
                            <a href="{{ route('user.bid_list') }}" class="action-button shadow animate orange col-md-push-4 col-md-4">応募一覧ページへ</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection



