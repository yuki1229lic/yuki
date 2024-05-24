@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        th{
            width: 30%;
            vertical-align: middle!important;
            padding-left: 10%;
        }
        th,td{
            padding:20px 10px 20px 20px!important;
        }
        table{
            margin-bottom: 0px!important;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h4>会員登録情報</h4>
                        </div>
                        <div class="box-content">
                            <table class="table table-bordered">
                                <tr>
                                    <th>お名前</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>{{ $profile->last_name }} {{ $profile->first_name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ふりがな</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>{{ $profile->last_name_kana }} {{ $profile->first_name_kana }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>携帯電話番号</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>{{ $profile->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>生年月日</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>{{ $profile->birthday }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>性別</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($profile->sex == 1)
                                                    <p>男性</p>
                                                @else
                                                    <p>女性</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>居住地</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>{{ $address->ken_name }}
                                                    @if (isset($address->city_name))
                                                    {{ $address->city_name }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>持ち込み車両の有無</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($profile->car == 1)
                                                    <p>あり</p>
                                                @else
                                                    <p>なし</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>軽貨物運送業の経験</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($profile->experience == 1)
                                                    <p>あり</p>
                                                @else
                                                    <p>なし</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>自動ログイン</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>あり</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="row mt-4">
                                <a href="{{ route('user.user_profile_update') }}" class="action-button shadow animate orange col-md-push-4 col-md-4">変更する</a>
                            </div>
                        </div>
                    </section>
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h4>パスワード</h4>
                        </div>
                        <div class="box-content">
                            <div class="row mt-4">
                                <a href="{{ route('user.user_password_update') }}" class="action-button shadow animate orange col-md-push-4 col-md-4">変更する</a>
                            </div>
                        </div>
                    </section>
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h4>退会の手続き</h4>
                        </div>
                        <div class="box-content">
                            <p class="normal-font">ハコボウズからの退会手続きを行います。</p>
                            <div class="row mt-4">
                                <a type="button" class="action-button shadow animate red-btn col-md-push-4 col-md-4" id="deleteModal">脱退する</a>
                            </div>
                        </div>
                    </section>
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
                                <h3>アカウントを本当に削除しますか？</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <a class="action-button shadow animate green-btn col-md-push-1 col-md-3" id="closeModal">いいえ</a>
                            <a href="{{ route('user.account_delete') }}" class="action-button shadow animate red-btn col-md-push-4 col-md-3">はい</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#deleteModal').click(function (){
                $('#quickView').modal('show');
            })
            $('#closeModal').click(function (){
                $('#quickView').modal('hide');
            })
        })
    </script>
@endsection

