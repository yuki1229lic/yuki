@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .text-tag{
            text-align:center;
            color:#0074c1!important;
            text-decoration: underline!important;
        }
        .out-table th{
            width: 30%;
            vertical-align: middle!important;
            padding-left: 10%;
        }
        .out-table th,td{
            padding:20px 10px 20px 20px!important;
        }
        table{
            margin-bottom: 0px!important;
        }
        .inner-table th{
            vertical-align: middle;
            text-align:center;
            background: linear-gradient(to bottom,#ff5c33 0,#ff3300 100%);
            color:white;
            padding:15px 5px!important;
        }
    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    <section class="first-box mt-5" style="text-align:left">
                        <p class="mt-1">
                            <span class="note-size blue-font">履歴書・職務経歴書の送付</span>
                        </p>
                        <p>既に履歴書・職務経歴書をお持ちの方は、当ページより送付をすることでWEB履歴書の入力が不要となります。</p>
                    </section>
                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>送付の仕方は3種類あります</h3>
                        </div>
                        <div class="table-content">
                            <table class="table table-bordered out-table">
                                <tr>
                                    <th>1. フォームで送信する。</th>
                                    <td>
                                        <div class="col-md-12">
                                            <p>※ 下記ボタンから書類送信フォームへ。簡単に送信できます。</p>
                                            <a href="{{ route('user.resume_contact') }}" class="action-button shadow animate orange col-md-6 mt-2">
                                                <i class="fa fa-envelope" style="color:white;"></i>フォームで送信する
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>2. Eメールで送信する。</th>
                                    <td>
                                        <div class="col-md-12">
                                            <p>※ 下記メールアドレスへ送付をお願いします。</p>
                                            <a role="button" class="text-tag">
                                                example@test.com
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>3. 郵送する。</th>
                                    <td>
                                        <div class="col-md-12">
                                            <p>※ 下記住所へ郵送をお願いします。</p>
                                            <p class="mt-2">〒163-0455<br>
                                                東京都新宿区<br>
                                                西新宿2-1-1<br>
                                                新宿三井ビルディング 55階<br>
                                                株式会社ウィルオブ・コンストラクション 採用チーム行</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </section>

                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>必要書類をご用意ください</h3>
                        </div>
                        <div class="box-content">
                            <p class="normal-font">本会員登録には下記の2種類が必要となります。既に履歴書・職務経歴書をお持ちの方はそちらでも代用可能ですので提出をお願いします。</p>
                            <p class="normal-font mt-2">１．人材派遣サービスをご利用の方</p>
                            <div class="table-content mt-2">
                                <table class="table table-bordered inner-table">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;">No</th>
                                            <th style="width:30%;">必要書類</th>
                                            <th style="width:40%;">説明</th>
                                            <th style="width:25%;">ダウンロード</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>履歴チェック</td>
                                            <td>履歴書とスキルのチェックリストが一緒になった、施工管理求人ナビ独自のフォーマットとなります。</td>
                                            <td><a href="{{ asset('samplePDF/1.pdf') }}" download class="text-tag"><i class="fa fa-download"></i>ダウンロード</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>工事経歴書</td>
                                            <td>既に作成済のものをご提出下さっても可です。お持ちでない方は、ダウンロードしてご利用下さい。</td>
                                            <td><a href="{{ asset('samplePDF/2.pdf') }}" download class="text-tag"><i class="fa fa-download"></i>ダウンロード</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p class="normal-font mt-2">・ダウンロードできない<br>
                                ・手書きのものが既にあるのでそれを郵送したい<br>
                                ・プリンターがないので印刷できない…　場合、<br>
                                「書類セットを請求する」よりご請求ください。入力して頂いたご住所に、白紙の1～2の書類セットをお届けします。作成後、郵送にてご返送下さい。送料はかかりません。</p>

                            <div class="row mt-4">
                                <a href="{{ route('user.web_history_main') }}" class="action-button shadow animate orange col-md-push-4 col-md-4">WEB履歴書登録画面へ</a>
                            </div>
                        </div>
                    </section>

                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>必要書類についてのご不明点のお問い合わせはこちら</h3>
                        </div>
                        <div class="box-content text-center">
                            <p class="mt-3">
                                <span class="note-size blue-font"><i class="fa fa-phone lg-fa"></i>0120-244-104</span><br>
                                <span class="alarm-size">月〜金 10:00-19:00</span>
                            </p>
                            <p class="mt-2">ご不明な点がありましたら、お気軽にお問い合わせください。</p>
                            <p>全部が揃っていなくても大丈夫です。</p>
                            <p>株式会社ウィルオブ・コンストラクションよりご連絡時にご案内いたしますので、ご相談下さい。</p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

