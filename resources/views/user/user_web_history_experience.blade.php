@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .text-tag{
            text-align:center;
            color:#0074c1!important;
            text-decoration: underline!important;
        }
        button{ border:none;}
        th{
            width: 30%;
            text-align: center;
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
                    <section class="first-box mt-5">
                        <p class="text-left"><a href="{{ route('user.history_resume') }}" class="text-tag">既に職務経歴書をお持ちの方はこちらから送付してください。</a></p>
                    </section>
                    <section class="content-box mt-5">
                        <div class="row">
                            <a href="{{ route('user.web_history_main') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">1. 基本情報</p>
                                    @if($main->user_basic_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_experience') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title nav-active">2. 職務・工事経歴</p>
                                    @if($main->user_experience_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_qualification') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">3. 保有資格</p>
                                    @if($main->user_qualification_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_skill') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">4. 実務スキル</p>
                                    @if($main->user_skill_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_aspect') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">5. 経験分野</p>
                                    @if($main->user_history_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </section>

                    <section class="frame">
                        @foreach(['danger','warning', 'success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                                <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </p>
                            @endif
                        @endforeach
                        <form action="{{ route('user.web_history_experience_db') }}" method="post">
                            @csrf
                            <section class="content-box mt-3">
                                <div class="box-title">
                                    <h4>職務・工事経歴 </h4>
                                </div>
                            </section>

                            <section class="content-box mt-3" >
                                <div class="table-content mt-2" style="padding: 20px;">
                                    <table class="table table-bordered" >
                                        <tr>
                                            <th>企業名</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="user_company_name" value="{{ $main->user_company_name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>在籍期間</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                            $user_period = json_decode($main->user_period, true)
                                                        @endphp
                                                        <div class="form-group">
                                                            <select name="period_from_year" class="datepicker" id="period_from_year">
                                                                @for($i = 1990; $i <= 2021; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>年</span>
                                                            <select name="period_from_month" class="datepicker" id="period_from_month">
                                                                @for($i = 1; $i <= 12; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <script>
                                                                document.getElementById("period_from_year").value = '@if($user_period != null){{ $user_period['from_year'] }}@endif';
                                                                document.getElementById("period_from_month").value = '@if($user_period != null){{ $user_period['from_month'] }}@endif';
                                                            </script>
                                                            <span>月</span><span> 〜 </span>
                                                            <select name="period_to_year" class="datepicker" id="period_to_year">
                                                                @for($i = 1990; $i <= 2021; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>年</span>
                                                            <select name="period_to_month" class="datepicker" id="period_to_month">
                                                                @for($i = 1; $i <= 12; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>月</span>
                                                            <script>
                                                                document.getElementById("period_to_year").value = '@if($user_period != null){{ $user_period['to_year'] }}@endif';
                                                                document.getElementById("period_to_month").value = '@if($user_period != null){{ $user_period['to_month'] }}@endif';
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $company_history = json_decode($main->user_company_history, true);
                                            if($company_history == null){
                                                $company_history = [];
                                            }
                                        @endphp
                                        @if(count($company_history) > 0)
                                        @foreach($company_history as $company)
                                        <tr>
                                            <th>工事経歴</th>
                                            <td class="experience">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">工事名</label>
                                                            <input type="text" class="form-control" name="work_name[]" value="{{$company['name']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">工事期間</label>
                                                        <div class="form-group">
                                                            <select name="work_from_year[]" id="work_from_year{{ $loop->iteration }}" class="datepicker">
                                                                @for($i = 1990; $i <= 2021; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>年</span>
                                                            <select name="work_from_month[]" id="work_from_month{{ $loop->iteration }}" class="datepicker">
                                                                @for($i = 1; $i <= 12; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>月</span><span> 〜 </span>
                                                            <select name="work_to_year[]" id="work_to_year{{ $loop->iteration }}" class="datepicker">
                                                                @for($i = 1990; $i <= 2021; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>年</span>
                                                            <select name="work_to_month[]" id="work_to_month{{ $loop->iteration }}" class="datepicker">
                                                                @for($i = 1; $i <= 12; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>月</span>
                                                            <script>
                                                                document.getElementById("work_from_year{{$loop->iteration}}").value = '@if($company != null){{ $company['work_from_year'] }}@endif';
                                                                document.getElementById("work_from_month{{$loop->iteration}}").value = '@if($company != null){{ $company['work_from_month'] }}@endif';
                                                                document.getElementById("work_to_year{{$loop->iteration}}").value = '@if($company != null){{ $company['work_to_year'] }}@endif';
                                                                document.getElementById("work_to_month{{$loop->iteration}}").value = '@if($company != null){{ $company['work_to_month'] }}@endif';
                                                            </script>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">雇用形態</label>
                                                            <input type="text" class="form-control" name="hired_style[]" value="{{ $company['hired_style'] }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">職名</label>
                                                            <input type="text" class="form-control" name="level[]" value="{{ $company['level'] }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">業務内容 (担当業務等)</label>
                                                            <textarea name="work_content[]" class="form-control" rows="5">{{ $company['work_content'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <th>工事経歴</th>
                                                <td class="experience">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">工事名</label>
                                                                <input type="text" class="form-control" name="work_name[]" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="">工事期間</label>
                                                            <div class="form-group">
                                                                <select name="work_from_year[]" id="work_from_year" class="datepicker">
                                                                    @for($i = 1990; $i <= 2021; $i++ )
                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                                <span>年</span>
                                                                <select name="work_from_month[]" id="work_from_month" class="datepicker">
                                                                    @for($i = 1; $i <= 12; $i++ )
                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                                <span>月</span><span> 〜 </span>
                                                                <select name="work_to_year[]" id="work_to_year" class="datepicker">
                                                                    @for($i = 1990; $i <= 2021; $i++ )
                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                                <span>年</span>
                                                                <select name="work_to_month[]" id="work_to_month" class="datepicker">
                                                                    @for($i = 1; $i <= 12; $i++ )
                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                                <span>月</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">雇用形態</label>
                                                                <input type="text" class="form-control" name="hired_style[]" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">職名</label>
                                                                <input type="text" class="form-control" name="level[]" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">業務内容 (担当業務等)</label>
                                                                <textarea name="work_content[]" class="form-control" rows="5"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                    <div class="d-flex justify-content-end mt-2">
                                        <p>※ 複数の企業で工事経歴がある方はこちらから追加してください。</p><br>
                                        <a class="blue-btn experience_plus">
                                            <i class="fa fa-plus" style="color:white;"></i>職務経歴を追加する
                                        </a>
                                    </div>
                                </div>
                            </section>

                            <section class="content-box mt-3">
                                <div class="table-content" style="padding:30px 0;">
                                    <div class="row">
                                        <button type="submit" class="action-button shadow animate orange col-md-push-4 col-md-4">登録する</button>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).on('click', '.experience_plus' , function (){
            var html = $('.experience').html();
            $(".table").append('<tr><th>工事経歴<br><br><a class="text-tag remove"><i class="fa fa-times-circle-o"></i>この工事経歴を削除する</a></th><td>'+html+'</td></tr>');
        })
        $(document).on('click', '.remove' , function (){
            var tr = $(this).closest('tr');
            tr.remove();
        })

    </script>
@endsection

