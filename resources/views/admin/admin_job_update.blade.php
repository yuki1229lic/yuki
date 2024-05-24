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

                </div>
            </div>
        </div>
        <div id="overlay" class="overlay"></div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <a href="{{ route('admin.enterprise_job_list',$job['jober_id']) }}" class="btn btn-outline-success float-lg-right"><i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @foreach(['danger','warning', 'success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                                <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </p>
                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col-12 mt-5">
                                    <div class="box-content">
                                        <form action="{{ route('admin.job_update_db') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                                            <table class="table table-data table-bordered addNewjob">
                                                <tbody>
                                                <tr>
                                                    <th>求人タイトル<span class="requisite">必須</span></th>
                                                    <td>
                                                        <input type="text" name="post_title" class="form-control" value="{{ $job->post_title }}" placeholder="例）ネットスーパーの宅配ドライバー／企業配のルート配送ドライバー ※具体的な職種を記入
　　・仕事内容（追加してください）
例）大手ECサイトで注文された商品をお届けする宅配の仕事です。
　　1日100〜150件程度の荷物をお届けしてもらいます。">
                                                        @error('post_title')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $post_category = json_decode( $job->post_category, true );
                                                    $post_contract_type = json_decode($job->post_contract_type, true);
                                                    ?>
                                                    <th>職種選択<span class="requisite">必須</span></th>
                                                    <td>
                                                        <p class="item">職種区分</p>
                                                        <div id="post_category"></div>
                                                        <div class="wrap">
                                                            <button type="button" class="js-open addButton" data-id="1">職種を設定する</button>
                                                        </div>
                                                        @error('post_category')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                        <p class="item">雇用形態</p>
                                                        <div id="post_contract_type"></div>
                                                        <div class="wrap">
                                                            <button type="button" class="js-open addButton" data-id="3">雇用形態を設定する</button>
                                                        </div>
                                                        @error('post_contract_type')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>仕事内容<span class="requisite">必須</span></th>
                                                    <td>
                                                        <textarea name="post_other" id="post_other" class="form-control" rows="10" placeholder="">{{ $job->post_other }}</textarea>
                                                        @error('post_other')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>こんな方にオススメ<span class="any">任意</span></th>
                                                    <td><textarea name="post_suitable" class="form-control" rows="10">{{ $job->post_suitable }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $post_benefit = json_decode( $job->post_benefit, true );
                                                    ?>
                                                    <th>求人の特徴<span class="requisite">必須</span></th>
                                                    <td>
                                                        <div id="post_benefit"></div>
                                                        <div class="wrap">
                                                            <button type="button" class="js-open addButton" data-id="2">求人の特徴を設定する</button>
                                                        </div>
                                                        @error('post_benefit')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>応募資格<span class="any">任意</span></th>
                                                    <td><textarea name="post_require" class="form-control" placeholder="例）年齢不問、未経験者歓迎、要普通AT免許">{{ $job->post_require }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $imgs = json_decode($job->post_img, true );
                                                    ?>
                                                    <th>写真を追加<span class="requisite">必須</span></th>
                                                    <td>
                                                        <span class="hint"> ※ 1MBまで</span>
                                                        <ul class="img_list">
                                                            @foreach($imgs as $img)
                                                                <li class="img_block">
                                                                    <div class="old-img-wrapper">
                                                                        <img src="{{ asset('images/jobs') }}/{{ $img }}" alt="" width="250">
                                                                        <span class="img-remove">
                                                            <i class="fa fa-times" style="color:red;"></i>
                                                        </span>
                                                                        <input type="hidden" name="old_post_img[]" class="old-img" value="{{ $img }}">
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                            <li class="img_block new_img">
                                                                <input class="post_img" name="post_img[]" type="file">
                                                                <p class="delete">
                                                                    <button type="button" class="post_img_delete">削除</button>
                                                                </p>
                                                            </li>
                                                        </ul>
                                                        <p class="img_add">
                                                            <button type="button" class="post_img_add">追加</button>
                                                        </p>
                                                        {{--                                        <div class="new-img-wrapper">--}}
                                                        {{--                                            @for($i = 0; $i < (1-count($imgs)); $i++)--}}
                                                        {{--                                            <input name="new_post_img[]" class="new-img" type="file">--}}
                                                        {{--                                            @endfor--}}
                                                        {{--                                        </div>--}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>勤務地<span class="requisite">必須</span></th>
                                                    <td>
                                                        <ul class="post_working_place_list">
                                                            <li class="post_working_place_block" data-id="1">
                                                                <select class="prefecture" name="prefecture[]" data-id="1">
                                                                    <option value="">選択してください</option>
                                                                    @foreach($prefecture as $v)
                                                                        <option value="{{ $v->ken_id }}">{{ $v->ken_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class="city" name="city[]" data-id="1" id="city1">
                                                                    <option value="">選択してください</option>
                                                                </select>
                                                                <p class="delete">
                                                                    <button type="button" class="post_working_place_delete">削除</button>
                                                                </p>
                                                                <input type="hidden" class="post_working_place" name="post_working_place[]" value="" id="post_working_place1">
                                                            </li>
                                                        </ul>
                                                        <p class="add">
                                                            <button type="button" class="post_working_place_add">追加</button>
                                                        </p>
                                                        @error('prefecture.0')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>報酬<span class="requisite">必須</span></th>
                                                    <td>
                                                        <p class="item">月額報酬</p>
                                                        <input type="text" name="post_payment_text" value="{{ $job->post_payment_text }}" style="max-width: 60%" pattern="^[0-9]+$">&nbsp;万円
                                                        &nbsp
                                                        <input type="checkbox" name="post_is_payment_more" value="1" {{ $job->post_is_payment_more ? 'checked' : ''}}>以上〜
                                                        上限 &nbsp;<input type="text" name="post_payment_max_text" value="{{ $job->post_payment_max_text }}" style="max-width: 60%" pattern="^[0-9]+$">&nbsp;万円<br>
                                                        ※数字のみで入力してください。{{$job->post_is_payment_more}}
                                                        @error('post_payment_text')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>ロイヤリティ<span class="requisite">必須</span></th>
                                                    <td>
                                                        <textarea name="post_revenue" class="form-control" placeholder="例）売上の15％">{{ $job->post_revenue }}</textarea>
                                                        @error('post_revenue')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>報酬例<span class="requisite">必須</span></th>
                                                    <td>
                                                        <textarea name="post_payment" class="form-control" rows="10" placeholder="例）22,000円×23日＝506,000円、180円×150個×22日稼働＝594,000円">{{ $job->post_payment }}</textarea>
                                                        @error('post_payment')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>支払いサイト<span class="requisite">必須</span></th>
                                                    <td><textarea name="post_rental_car" class="form-control" placeholder="例）月末締め翌月5日払い（35日サイト）">{{ $job->post_rental_car }}</textarea>
                                                        @error('post_rental_car')
                                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>稼働時間・休日<span class="any">任意</span></th>
                                                    <td>
                                                        <textarea name="post_working_time" class="form-control" rows="10" placeholder="例）シフト制、週5日〜">{{ $job->post_working_time }}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>選考について<span class="any">任意</span></th>
                                                    <td><textarea name="post_selection" class="form-control" rows="10" placeholder="応募から稼働開始までの流れや必要書類について記入します。">{{ $job->post_other }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <th>職場について<span class="any">任意</span></th>
                                                    <td>
                                                        <div>
                                                            <ul class="list">
                                                                <li class="post_pr_block">
                                                                    <select class="post_pr_type" name="post_pr_type[]">
                                                                        <option value="">選択してください。</option>
                                                                        <option value="ドライバー紹介">ドライバー紹介</option>
                                                                        <option value="オススメポイント">オススメポイント</option>
                                                                        <option value="その他">その他（自由テーマ）</option>
                                                                    </select>
                                                                    <input type="text" name="post_pr_title[]" id="post_pr_title" class='post_pr_title form-control' placeholder="タイトルを入力してください">
                                                                    <span class="pr_title_error invalid-feedback" role="alert"></span>
                                                                    <textarea name="post_pr_text[]" class="post_pr_text form-control" rows="10" placeholder="">@isset($job_pr->post_pr_text){{ $job_pr->post_pr_text }}@endisset</textarea>
                                                                    <p class="delete">
                                                                        <button type="button" class="post_pr_delete">削除</button>
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                            <p class="add">
                                                                <button type="button" class="post_pr_add">追加</button>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>案件公開</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="">
                                                                    <input type="radio" name="post_status" value="0" @if($job->post_status == 0) checked @endif>非公開
                                                                </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">
                                                                    <input type="radio" name="post_status" value="1" @if($job->post_status == 1) checked @endif>公開
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="row mt-3">
                                                <button type="submit" class="btn btn-primary offset-md-4 col-md-4">登録情報を編集する</button>
                                            </div>
                                            <div class="modalBg"></div>
                                            <div class="modal-window" data-id="modal1">
                                                <div class="modalBox">
                                                    @foreach($category as $cate)
                                                        <div class="col-md-3 mb-3">
                                                            <label><input type="checkbox" class="category-checkbox post_category" name="post_category[]" value="{{ $cate->kind_name }}">
                                                                <span class="check-label">{{ $cate->kind_name }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="buttonBox">
                                                    <button type="button" class="js-close button-cancel">キャンセル</button>
                                                    <button type="button" class="set js-close button-close" data-target="post_category">設定する</button>
                                                </div>
                                            </div>
                                            <div class="modal-window" data-id="modal2">
                                                <p class="title">歓迎</p>
                                                <div class="modalBox">
                                                    @foreach($receptions as $reception)
                                                        <div class="col-md-3 mb-3">
                                                            <label><input type="checkbox" class="benefit-checkbox post_benefit" name="post_benefit[]" value="{{ $reception->benefit_name }}">
                                                                <span class="check-label">{{ $reception->benefit_name }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <p class="title">待遇</p>
                                                <div class="modalBox">
                                                    @foreach($treatments as $treatment)
                                                        <div class="col-md-3 mb-3">
                                                            <label><input type="checkbox" class="benefit-checkbox post_benefit" name="post_benefit[]" value="{{ $treatment->benefit_name }}">
                                                                <span class="check-label">{{ $treatment->benefit_name }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <p class="title">稼働時間</p>
                                                <div class="modalBox">
                                                    @foreach($working_times as $working_time)
                                                        <div class="col-md-3 mb-3">
                                                            <label><input type="checkbox" class="benefit-checkbox post_benefit" name="post_benefit[]" value="{{ $working_time->benefit_name }}">
                                                                <span class="check-label">{{ $working_time->benefit_name }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="buttonBox">
                                                    <button type="button" class="js-close button-cancel">キャンセル</button>
                                                    <button type="button" data-target="post_benefit" class="set js-close button-close">設定する</button>
                                                </div>
                                            </div>
                                            <!-- モーダルウィンドウ3 -->
                        <div class="modal-window" data-id="modal3">
                            <div class="modalBox">
                                <div class="col-md-3 mb-3">
                                    <label><input type="checkbox" class="contract_type-checkbox post_contract_type" name="post_contract_type[]" value="正社員">
                                        <span class="check-label">正社員</span></label>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label><input type="checkbox" class="contract_type-checkbox post_contract_type" name="post_contract_type[]" value="業務委託">
                                        <span class="check-label">業務委託</span></label>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label><input type="checkbox" class="contract_type-checkbox post_contract_type" name="post_contract_type[]" value="アルバイト・パート">
                                        <span class="check-label">アルバイト・パート</span></label>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label><input type="checkbox" class="contract_type-checkbox post_contract_type" name="post_contract_type[]" value="契約社員">
                                        <span class="check-label">契約社員</span></label>
                                </div>
                            </div>
                            <div class="buttonBox">
                                <button type="button" class="js-close button-cancel">キャンセル</button>
                                <button type="button" class="set js-close button-close" data-target="post_contract_type">設定する</button>
                            </div>
                        </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.img-remove').click(function (){
                var old_wrapper = $(this).parents('.img_block');
                old_wrapper.remove();
                // $('.new-img-wrapper').append('<input name="new_post_img[]" class="new-img" type="file">')
            })

            // 初期値表示
            var category_checked = @json($post_category, JSON_UNESCAPED_UNICODE);
            $('#post_category').append(category_checked.join(','));

            var benefit_checked = @json($post_benefit, JSON_UNESCAPED_UNICODE);
            $('#post_benefit').append(benefit_checked.join(','));

            var contract_type_checked = @json($post_contract_type, JSON_UNESCAPED_UNICODE);
            $('#post_contract_type').append(contract_type_checked.join(','));

            //初期値セット
            for(i=0; i<category_checked.length; i++){
                $('.category-checkbox').each( function (){
                    var result = $(this).val()
                    if( category_checked[i] == result){
                        $(this).prop("checked",true);
                    }
                })
            }
            for(i=0; i<benefit_checked.length; i++){
                $('.benefit-checkbox').each( function (){
                    var result = $(this).val()
                    if( benefit_checked[i] == result){
                        $(this).prop("checked",true);
                    }
                })
            }
            for (i = 0; i < contract_type_checked.length; i++) {
                $('.contract_type-checkbox').each(function() {
                    var result = $(this).val()
                    if (contract_type_checked[i] == result) {
                        $(this).prop("checked", true);
                    }
                })
            }
        })

        //チェックされたら
        $('.set').on('click', function(){
            var target = $(this).data('target');
            var item = $('.' + target + ':checked').map(function() {
                return $(this).val();
            }).get();
            $('#' + target).text(item);
        });

        $(function () {
            $('.js-open').click(function () {
                var id = $(this).data('id'); // 何番目のキャプション（モーダルウィンドウ）か認識
                $('#overlay, .modal-window[data-id="modal' + id + '"]').fadeIn();
            });
            // オーバーレイクリックでもモーダルを閉じるように
            $('.js-close , #overlay').click(function () {
                $('#overlay, .modal-window').fadeOut();
            });
        });

        //職場について初期値表示
        let job_pr = @json($job_pr);
        if (typeof(job_pr) != 'undefined' && job_pr != null && job_pr != '') {
            $.each(job_pr, function (index, value) {
                let clone = $('.post_pr_add').parent().prev('ul.list').find('li.post_pr_block:last-of-type').clone(true);
                clone.find('.post_pr_type').val(value['post_pr_type']);
                if(value['post_pr_title'] != null){
                    clone.find('.post_pr_title').val(value['post_pr_title']);
                } else {
                    clone.find('.post_pr_title').hide();
                }
                clone.find('.post_pr_text').val(value['post_pr_text']);
                clone.appendTo('.list');
            });
            $('.post_pr_block').eq(0).remove();
        }

        // 画像追加ボタンを押した時
        $('.post_img_add').on('click',function() {
            if($('.img_block').length < 5 ) {
                var clone = $(this).parent().prev('ul.img_list').find('li.img_block.new_img:last-of-type').clone(true);
                clone.find('.post_img').val('');
                clone.appendTo('.img_list');
            }
            if($('.img_block').length == 5){
                $('.img_add').hide();
            }
        });
        // 画像削除ボタンを押した時
        $('.post_img_delete').on('click',function() {
            if($('.img_block.new_img').length > 1 ) {
                $(this).closest('.img_block').remove();
                $('.img_add').show();
            } else {
                $('.post_img').val('');
            }
        });

        // 職場について追加ボタンを押した時
        $('.post_pr_add').on('click',function() {
            var clone = $(this).parent().prev('ul.list').find('li.post_pr_block:last-of-type').clone(true);
            clone.find('.post_pr_type').val('');
            clone.find('.post_pr_text').val('');
            clone.find('.post_pr_title').val('');
            clone.find('.post_pr_title').hide();
            clone.appendTo('.list');
        });
        // 職場について削除ボタンを押した時
        $('.post_pr_delete').on('click',function() {
            if($('.post_pr_block').length > 1 ) {
                $(this).closest('.post_pr_block').remove();
            } else {
                $('.post_pr_type').val('');
                $('.post_pr_text').val('');
                $('.post_pr_title').val('');
            }
        });

        //勤務地初期値表示
        let working_place_selected = @json($job_working_place);
        if (typeof(working_place_selected) != 'undefined' && working_place_selected != null && working_place_selected != '') {
            $.each(working_place_selected, function (index,value) {
                let clone = $('.post_working_place_add').parent().prev('ul.post_working_place_list').find('li.post_working_place_block:last-of-type').clone(true);
                clone.find('.prefecture').val(value.ken_id);
                $.getJSON('/api/getCityList/' + value.ken_id, function(data) {
                    $.each(data, function (index, data2) {
                        clone.find('.city').append($('<option>').text(data2.city_name).val(data2.city_id));
                        clone.find('.city').val(value.city_id);
                        clone.find('.post_working_place').val(value.city_id);
                    });
                });
                clone.appendTo('.post_working_place_list');
            });
            $('.post_working_place_block').eq(0).remove();
            let i = 1;
            $('.post_working_place_block').each(function(){
                $(this).attr('data-id', i);
                $(this).find('.prefecture').attr('data-id', i);
                $(this).find('.city').attr('id', 'city' + i);
                $(this).find('.city').attr('data-id', i);
                $(this).find('.post_working_place').attr('id', 'post_working_place' + i);
                i++;
            });
        }

        $('.prefecture').change(function () {
                if (this.value) {
                    let prefecture = this.value;
                    let city = prefecture + '000';
                    let list_id = $(this).attr('data-id');
                    $('#city' + list_id + ' option').remove();
                    $('#city' + list_id).append($('<option>').text('選択してください').val(''));
                    $.getJSON('/api/getCityList/' + prefecture, function(data) {
                        $.each(data, function (index, data2) {
                            $('#city' + list_id).append($('<option>').text(data2.city_name).val(data2.city_id));
                            $('#post_working_place' + list_id).val(city);
                        });
                    });
                }
            }
        );
        $('.city').change(function () {
                if (this.value) {
                    let list_id = $(this).attr('data-id');
                    $('#post_working_place' + list_id).val(this.value);
                }
            }
        );
        // 勤務地追加ボタンを押した時
        $('.post_working_place_add').on('click',function() {
            let clone = $(this).parent().prev('ul.post_working_place_list').find('li.post_working_place_block:last-of-type').clone(true);
            clone.find('.city').val('');
            clone.appendTo('.post_working_place_list');
            let i = 1;
            $('.post_working_place_block').each(function(){
                $(this).attr('data-id', i);
                $(this).find('.prefecture').attr('data-id', i);
                $(this).find('.city').attr('id', 'city' + i);
                $(this).find('.city').attr('data-id', i);
                $(this).find('.post_working_place').attr('id', 'post_working_place' + i);
                i++;
            });
        });

        // 勤務地削除ボタンを押した時
        $('.post_working_place_delete').on('click',function() {
            if($('.post_working_place_block').length > 1 ) {
                $(this).closest('.post_working_place_block').remove();
            } else {
                $('.prefecture').val('');
                $('.city').val('');
            }
        });
        // 仕事内容説明ポップアップ
        $('#post_other_exsample_button').on('click',function(){
            $('.post_other_exsample_popup').addClass('post_other_exsample_show');
        });

        $('#post_other_exsample_close').on('click',function(){
            $('.post_other_exsample_popup').hide();
        });

        // 職場についてで「その他（自由テーマ）」が選択されたらタイトル行追加
        $('.post_pr_type').each(function (){
            if ($(this).val() === 'その他') {
                $(this).nextAll('.post_pr_title').show();
            }
        });
        // 職場について 選択された内容によってplaceholderの内容を変える
        $('.post_pr_type').on('change', function () {
            const selectedValue = $(this).val();
            let placeholderText = '';
            switch (selectedValue) {
                case 'ドライバー紹介':
                    placeholderText =
                        '例）' +
                        '20代男性Wさん\n\n私は大手運送会社の宅配の仕事をしています。\n' +
                        '配達件数に応じてその日の売上が変わる「完全歩合」の現場でバリバリ荷物を配っています。\n\n' +
                        '不在のお家が多くてショック、、なんてこともありますが、より効率良く配達できるよう日々試行錯誤しながら頑張っています。\n\n' +
                        '始めた当初は道がわからなかったり、機械の操作に手こずったりと配達件数を伸ばせませんでした。\n\n' +
                        'しかし配達の早い先輩方からアドバイスをもらい、今では一時間あたり20件以上配達できるようになりました。' +
                        '繁忙期には荷物が増えて180〜200件配れる日もあり、大変ですが頑張った分だけお金になるこの仕事はすごくやりがいがあります。\n\n' +
                        '【Wさんの報酬例】\n180円×150個(一日平均)=27000\n27000円×22日出勤=594,000円';
                    $(this).nextAll('.post_pr_title').hide();
                    break;
                case 'オススメポイント':
                    placeholderText =
                        '例）' +
                        '充実の研修制度\n' +
                        '経験者の方でも初めて入る現場だと不安なことも多いかと思います。\n' +
                        '弊社では仕事に慣れるまで、経験豊富な先輩ドライバーが同乗して仕事のルールや配達のコツをしっかりと教えます。\n' +
                        'わからないことは何でも聞いてくださいね。';
                    $(this).nextAll('.post_pr_title').hide();
                    break;
                case 'その他':
                    placeholderText =
                        '自由なテーマで仕事や職場の魅力を記入してください。';
                    $(this).nextAll('.post_pr_title').show();
                    break;
                default:
                    placeholderText = '';
            }

            $(this).nextAll('.post_pr_text').attr('placeholder', placeholderText);
        });

        $('.submitButton').on('click', function (){
            let error = true;
            $('.post_pr_type').each(function (){
                if ($(this).val() === 'その他' && $(this).nextAll('.post_pr_title').val() === '') {
                    $(this).nextAll('.pr_title_error').append('<strong>この項目は必須です。</strong>');
                    error = false;
                }
            });
            return error;
        });
    </script>
@endsection

