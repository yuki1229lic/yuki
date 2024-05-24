@extends('layouts.admin.admin_main_layout')
@section('content')
    <style>
        th{
            width:25%;
            text-align: center;
            vertical-align: middle!important;
        }
        td{
            text-align: left;
            vertical-align:middle;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1 class="m-0 text-dark">自社情報の設定</h1>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <a href="{{ route('admin.enterprise_list') }}" class="btn btn-outline-success float-lg-right"><i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach(['danger','warning', 'success','info'] as $msg)
                                @if(Session::has('alert-'.$msg))
                                    <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </p>
                                @endif
                            @endforeach

                            <form action="{{ route('admin.enterprise_profile_update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="jober_id" value="{{ $jober_id }}">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>企業名<span class="requisite">必須</span></th>
                                        <td>
                                            <input type="text" name="company_name" class="form-control" value="{{ $profile->company_name }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>所在地</th>
                                        <td>
                                            <div id="japan">
                                                〒<input type="text" name="company_postal_code" value="{{ $profile->company_postal_code }}">
                                                <br>
                                                【都道府県】<br>
                                                <select name="company_province" id="province">
                                                    <option value="北海道"> 北海道 </option>
                                                    <option value="青森県">青森県</option>
                                                    <option value="岩手県">岩手県</option>
                                                    <option value="宮城県">宮城県</option>
                                                    <option value="秋田県">秋田県</option>
                                                    <option value="山形県">山形県</option>
                                                    <option value="福島県">福島県</option>
                                                    <option value="茨城県">茨城県</option>
                                                    <option value="栃木県">栃木県</option>
                                                    <option value="群馬県">群馬県</option>
                                                    <option value="埼玉県">埼玉県</option>
                                                    <option value="千葉県">千葉県</option>
                                                    <option value="東京都">東京都</option>
                                                    <option value="神奈川県">神奈川県</option>
                                                    <option value="新潟県">新潟県</option>
                                                    <option value="富山県">富山県</option>
                                                    <option value="石川県">石川県</option>
                                                    <option value="福井県">福井県</option>
                                                    <option value="山梨県">山梨県</option>
                                                    <option value="長野県">長野県</option>
                                                    <option value="岐阜県">岐阜県</option>
                                                    <option value="静岡県">静岡県</option>
                                                    <option value="愛知県">愛知県</option>
                                                    <option value="三重県">三重県</option>
                                                    <option value="滋賀県">滋賀県</option>
                                                    <option value="京都府">京都府</option>
                                                    <option value="大阪府">大阪府</option>
                                                    <option value="兵庫県">兵庫県</option>
                                                    <option value="奈良県">奈良県</option>
                                                    <option value="和歌山県">和歌山県</option>
                                                    <option value="鳥取県">鳥取県</option>
                                                    <option value="島根県">島根県</option>
                                                    <option value="岡山県">岡山県</option>
                                                    <option value="広島県">広島県</option>
                                                    <option value="山口県">山口県</option>
                                                    <option value="徳島県">徳島県</option>
                                                    <option value="香川県">香川県</option>
                                                    <option value="愛媛県">愛媛県</option>
                                                    <option value="高知県">高知県</option>
                                                    <option value="福岡県">福岡県</option>
                                                    <option value="佐賀県">佐賀県</option>
                                                    <option value="長崎県">長崎県</option>
                                                    <option value="熊本県">熊本県</option>
                                                    <option value="大分県">大分県</option>
                                                    <option value="宮崎県">宮崎県</option>
                                                    <option value="鹿児島県">鹿児島県</option>
                                                    <option value="沖縄県">沖縄県</option>
                                                </select>
                                                <br>
                                                【宇都宮市・番地・マンション・ビル名等】<br>
                                                <input type="text" name="company_address" value="{{ $profile->company_address }}" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>代表者名</th>
                                        <td>
                                            <input type="text" name="company_leader" value="{{ $profile->company_leader }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>担当者名</th>
                                        <td>
                                            <input type="text" name="company_task_manager" value="{{ $profile->company_task_manager }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>事業内容</th>
                                        <td>
                                            <textarea name="company_business_content" class="text-editor">{{ $profile->company_business_content }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>設立年月</th>
                                        <td>
                                            <textarea name="company_establish_date" class="text-editor">{{ $profile->company_establish_date }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>従業員数</th>
                                        <td>
                                            <textarea name="company_employee" class="text-editor">{{ $profile->company_employee }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>担当者電話番号</th>
                                        <td>
                                            <input type="text" name="company_phone" value="{{ $profile->company_phone }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>担当者メールアドレス</th>
                                        <td>
                                            <input type="email" name="company_email" value="{{ $profile->company_email }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>企業ホームページ</th>
                                        <td>
                                            <input type="text" name="company_url" value="{{ $profile->company_url }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>DSP</th>
                                        <td>
                                            <input type="checkbox" name="is_dsp" value="1" {{ $profile->is_dsp ? 'checked' : ''}}> DSP企業
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>企業ロゴ画像</th>
                                        <td>
                                                <span class="hint">
                                                    ※ 1MBまで<br>
                                                </span>
                                            @if($profile->company_img != null)
                                                <div class="old-img-wrapper">
                                                    <img src="{{ asset('images/jober_profile') }}/{{ $profile->company_img }}" alt="" width="250">
                                                    <span class="img-remove"><i class="fa fa-times" style="color:red;"></i></span>
                                                    <input type="hidden" name="old_company_img" class="old-img" value="{{ $profile->company_img }}">
                                                </div>
                                                <div class="new-img-wrapper"></div>
                                            @else
                                                <div class="new-img-wrapper">
                                                    <input name="new_company_img" type="file">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="row mt-3">
                                    <button type="submit" class="btn btn-primary offset-md-4 col-md-3">自社情報の設定する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $('.img-remove').click(function (){
                var old_wrapper = $(this).parent();
                old_wrapper.remove();
                $('.new-img-wrapper').append('<input name="new_company_img" type="file">')
            })
            var select = '{{ $profile->company_province }}';
            $('#province option').each( function (){
                var result = $(this).val();
                if( select == result){
                    $(this).prop("selected",true);
                }
            });
        })
    </script>
@endsection

