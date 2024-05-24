@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .img-round{
            width: 130px;
            height: 130px;
            border-radius: 65px;
            border:2px solid #0be22e;
        }
        .company-title{
            font-size: 20px;
            margin-top: 50px;
        }
        th{
            vertical-align: middle!important;
        }
    </style>
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
            </ul>
        </div>
    </div>
    <article id="search_d">
        <section class="sec01">
            <div class="inner">
                <div class="box">
                    <div class="block2">
                        <form action="{{ route('home.user_profile_db') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <h4>ユーザー情報</h4>
                        <table cellpadding="0" class="table_work">
                            <tr>
                                <th>お名前</th>
                                <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                            @if( $user['image'] == 'default.png')
                                                <img src="{{ asset('images/users/default.png') }}" alt="" class="img-round">
                                            @else
                                                <img src="{{ asset('images/users') }}/{{ $user['image'] }}" alt="" class="img-round">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <p class="company-title">{{ $profile['last_name'] }}{{ $profile['first_name'] }}</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>ふりがな</th>
                                <td>{{ $profile['last_name_kana'] }}{{ $profile['first_name_kana'] }}</td>
                            </tr>
                            <tr>
                                <th>携帯電話番号</th>
                                <td>{{ $profile['phone'] }}</td>
                            </tr>
                            <tr>
                                <th>生年月日	</th>
                                <td>{!! $profile['birthday'] !!} </td>
                            </tr>
                            <tr>
                                <th>性別	</th>
                                <td>
                                    @if($profile->sex != 0)
                                        男性
                                    @else
                                        女性
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>居住地</th>
                                <td>{{ $address->ken_name }}
                                    @if (isset($address->city_name))
                                    {{ $address->city_name }}
                                    @endif</td>
                            </tr>
                            <tr>
                                <th>持ち込み車両の有無</th>
                                <td>
                                    @if($profile->car != 0)
                                        あり
                                    @else
                                        なし
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>軽貨物運送業の経験</th>
                                <td>
                                    @if($profile->experience != 0)
                                        あり
                                    @else
                                        なし
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>メモ</th>
                                <td>
                                    <textarea name="memo" class="form-control" rows="10">{{$profile->memo}}</textarea>
                                </td>
                            </tr>
                        </table>
                            <input type="hidden" name="user_id" value="{{$profile->user_id}}">
                            <div class="row mt-3">
                                <button type="submit" class="action-button submitButton userInfoButton">ユーザー情報を保存する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
