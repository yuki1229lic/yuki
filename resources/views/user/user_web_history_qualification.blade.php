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
                            <a href=" {{ route('user.web_history_main') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title ">1. 基本情報</p>
                                    @if($main->user_basic_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_experience') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title">2. 職務・工事経歴</p>
                                    @if($main->user_experience_status == 1)
                                        <p class="nav-status-success">入力</p>
                                    @else
                                        <p class="nav-status-failed">未入力</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('user.web_history_qualification') }}">
                                <div class="nav-btn text-center">
                                    <p class="nav-title nav-active">3. 保有資格</p>
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
                        <form action="{{ route('user.web_history_qualification_db') }}" method="post">
                            @csrf
                            <section class="content-box mt-3">
                                <div class="box-title">
                                    <h4>個人情報</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table table-bordered" id="qualification_table">
                                       <?php
                                            $q1= json_decode( $main->user_qualification1, true);
                                            if($q1 != null){
                                       ?>
                                        @foreach($q1 as $q)
                                        <tr id="increment">
                                            <th>資格</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">資格 </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="name[]" value="{{ $q['name']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">資格取得年月</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="year[]" id="year{{$loop->iteration}}" class="datepicker">
                                                                @for($i = 1990; $i <= 2021; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>年</span>
                                                            <select name="month[]" id="month{{ $loop->iteration }}" class="datepicker">
                                                                @for($i = 1; $i <= 12; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>月</span>
                                                            <script>
                                                                document.getElementById("year{{$loop->iteration}}").value = '{{ $q['year'] }}';
                                                                document.getElementById("month{{$loop->iteration}}").value = '{{ $q['month'] }}';
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="remove">
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                       <?php
                                          }else{
                                       ?>
                                        <tr id="increment">
                                            <th>資格</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">資格 </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="name[]">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">資格取得年月</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="year[]" id="" class="datepicker">
                                                                @for($i = 1990; $i <= 2021; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>年</span>
                                                            <select name="month[]" id="" class="datepicker">
                                                                @for($i = 1; $i <= 12; $i++ )
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <span>月</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="remove">
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="table-content" style="padding:30px 0;">
                                    <div class="row">
                                        <a role="button" class="action-button shadow animate blue-btn col-md-4 col-md-push-4" id="qualification_plus">
                                            <i class="fa fa-plus" style="color:white;"></i>資格を追加する
                                        </a>
                                    </div>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>保有資格（プラント）</h4>
                                </div>
                                <div class="box-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>保有している資格にチェックを入れてください（複数チェック可）</p>
                                        </div>
                                    </div>
                                    <?php
                                        $q2 = json_decode($main->user_qualification2, true);
                                    ?>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="酸欠作業主任者"> 酸欠作業主任者</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="足場組立作業主任者"> 足場組立作業主任者</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="玉掛作業主任者"> 玉掛作業主任者</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="安全衛生責任者(職長教育)"> 安全衛生責任者(職長教育)</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="溶接管理技術者"> 溶接管理技術者</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="施工管理技術者"> 施工管理技術者</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="非破壊検査（レベル1～3）"> 非破壊検査（レベル1～3）</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="危険物取扱者（甲・乙・丙）"> 危険物取扱者（甲・乙・丙）</label>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="高圧ガス"> 高圧ガス</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="消防設備士"> 消防設備士</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for=""><input type="checkbox" class="qualification2" name="qualification2[]" value="ボイラー技士"> ボイラー技士</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="content-box">
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
        $(document).on('click', '#qualification_plus' , function (){
            var html = $('#increment').clone();
            html.find('#remove').append('<a class="text-tag remove-btn"><i class="fa fa-times-circle-o"></i>この資格を削除する</a>')
            $("#qualification_table").append(html);
        })
        $(document).on('click', '.remove-btn' , function (){
            var target = $(this).closest("tr")
            target.remove();
        })
        var checked =  @json($q2, JSON_UNESCAPED_UNICODE);
        for(i=0; i<checked.length; i++){
            $('.qualification2').each( function (){
                var result = $(this).val()
                if( checked[i] == result){
                    $(this).prop("checked",true);
                }
            })
        }
    </script>
@endsection

