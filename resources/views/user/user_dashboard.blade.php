@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .text-tag{
            text-align:center;
            color:#0074c1!important;
            text-decoration: underline!important;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
{{--                    <section class="first-box mt-5">--}}
{{--                        <p class="alarm-size">はじめてご利用の方は<a href="{{ route('home.first') }}" class="text-tag b_font">こちら</a>をご覧ください。</p>--}}
{{--                        <p class="alarm-size">また、ご不明点はお<a href="{{ route('home.contact') }}" class="text-tag b_font">お問い合わせフォーム</a>よりお気軽にお問い合わせください。</p>--}}
{{--                    </section>--}}
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>お気に入りリスト</h3>
                        </div>
                        <div class="box-content">
                            @if($myFavorites != null)
                                <table class="table table-bordered userTableList top">
                                    <tbody id="app">
                                    @foreach($myFavorites as $favorite)
                                        <tr>
                                            <?php $job = App\Models\Job::where('id',$favorite->job_id)->first() ;?>
                                            <td class="num">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="textLeft title">
                                                <a href="{{ route('home.job_detail',$job['id']) }}" style="color:#003399; text-decoration: underline;">
                                                    {{ $job->post_title }}
                                                </a>
                                            </td>
                                            <td class="num">
                                                No.{{ $job->id }}
                                            </td>
                                            <td class="date">
                                                {{ $favorite->created_at }}
                                            </td>
                                            <td class="icon">
                                                <a href="{{ route('user.remove_favorite',$job['id']) }}" class="">
                                                    <i class="fa fa-times" style="color:red;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="normal-font mt-1">選択された項目がありません。</p>
                            @endif

                            <div class="row mt-3">
                                <a href="{{ route('user.myFavorites') }}" class="action-button shadow animate orange col-md-push-4 col-md-4">お気に入り求人をもっと見る</a>
                            </div>
                        </div>
                    </section>

{{--                    <section class="content-box mt-5">--}}
{{--                        <div class="box-title">--}}
{{--                            <h3>新着メッセージ</h3>--}}
{{--                        </div>--}}
{{--                        <div class="box-content">--}}
{{--                            <p class="normal-font mt-1">メッセージはありません。</p>--}}
{{--                            <p class="normal-font mt-1"><a href="" class="text-tag">WEB履歴書</a>または <a href="" class="text-tag">職務経歴書</a>のアップロードで、ご希望にマッチした求人をご案内できます。--}}
{{--                                まずはご登録をお願いします。</p>--}}
{{--                        </div>--}}
{{--                    </section>--}}

                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>応募リスト</h3>
                        </div>
                        <div class="box-content">
                            @if($bids != null)
                                <table class="table table-bordered userTableList top">
                                    <tbody id="app">
                                    @foreach($bids as $job)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="textLeft title">
                                                <a href="{{ route('home.job_detail',$job['id']) }}" style="color:#003399; text-decoration: underline;">
                                                    {{ $job['post_title'] }}
                                                </a>
                                            </td>
                                            <td class="num">
                                                No.{{ $job->id }}
                                            </td>
                                            <td class="date">
                                                {{ $job->created_at }}
                                            </td>
                                            <td class="icon">
                                                <a href="{{  route('chatting') }}" >
                                                    <i class="fa fa-comments" style="color:#31d713;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="normal-font mt-1">選択された項目がありません。</p>
                            @endif
                            <div class="row mt-4">
                                <a href="{{ route('user.bid_list') }}" class="action-button shadow animate orange col-md-push-4 col-md-4">応募リストをもっと見る</a>
                            </div>
                        </div>
                    </section>

                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>アカウント設定</h3>
                        </div>
                        <div class="box-content">
                            <p class="normal-font mt-2">会員登録情報・メール配信設定を変更したい場合はこちらよりお願いします。</p>

                            <div class="row mt-4">
                                <a href="{{ route('user.user_profile') }}" class="action-button shadow animate orange col-md-push-4 col-md-4">アカウント設定画面へ</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

