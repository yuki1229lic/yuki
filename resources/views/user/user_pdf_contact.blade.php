@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        button{
            border:none;
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
                            <span class="note-size blue-font">書類アップロード</span>
                        </p>
                        <p>下記フォームから「履歴書・職務経歴書」をアップロードすると、会員登録が完了いたします。</p>
                        <p>会員登録後、2営業日以内に転職アドバイザーから、非公開・高額給与求人や優良企業からのスカウト情報等をご案内させていただきます。</p>
                        <p>※職務経歴書の記述内容が詳細なほど、転職成功率と転職時の給与提示額が高まる傾向がございます。</p>
                        <p>※書類が全部揃っていない場合、まずはどちらか一方の書類をアップロードしていただくだけでも構いません。</p>
                        <p class="mt-3">ご不明点がございましたら、お気軽にお問い合わせください。</p>
                        <a href="/contact" style="color:#0099ff;">お問い合わせフォームはこちら</a>
                    </section>

                    @foreach(['danger','warning', 'success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <p class="mt-4 alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">

                                </a>
                            </p>
                        @endif
                    @endforeach

                    <section class="content-box mt-5">
                        <div class="box-title">
                            <h3>履歴書・職務経歴書の送付</h3>
                        </div>
                        <form action="{{ route('user.pdf_mail') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="table-content">
                                <table class="table table-bordered out-table">
                                    <tr>
                                        <th>1. お名前</th>
                                        <td>
                                            <div class="col-md-12">
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                @error('name')
                                                <p class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2. ふりがな</th>
                                        <td>
                                            <div class="col-md-12">
                                                <input type="text" name="kana_name" class="form-control @error('kana_name') is-invalid @enderror" value="{{ old('kana_name') }}">
                                                @error('kana_name')
                                                <p class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3. メールアドレス</th>
                                        <td>
                                            <div class="col-md-12">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                                @error('email')
                                                <p class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>4. 履歴書</th>
                                        <td>
                                            <div class="col-md-12">
                                                <input type="file" name="pdf1" value="{{ old('pdf1') }}">
                                                @error('pdf1')
                                                <p class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                                @enderror
                                                <p>ファイル形式：PDF<br>
                                                    ※xlsx、docxのファイル形式の場合、正しく認識しないことがございます。<br>
                                                    その際はお手数ですがPDFの形式に保存し直しの上、アップロードしてください。</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>5. 職務経歴書(工事経歴書)</th>
                                        <td>
                                            <div class="col-md-12">
                                                <input type="file" name="pdf2" value="{{ old('pdf2') }}">
                                                @error('pdf2')
                                                <p class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                                @enderror
                                                <p>ファイル形式：PDF<br>
                                                    ※xlsx、docxのファイル形式の場合、正しく認識しないことがございます。<br>
                                                    その際はお手数ですがPDFの形式に保存し直しの上、アップロードしてください。</p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <button type="submit" class="action-button shadow animate orange col-md-push-4 col-md-4">送信する</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

