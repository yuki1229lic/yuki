@extends('layouts.jober.jober_main_layout')
@section('content')
<style>
    .post_other_exsample_popup {
        display: none;
        height: 100vh;
        width: 100%;
        background: black;
        opacity: 0.9;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .post_other_exsample {
        position: fixed;
        left: 15%;
        top: 150px;
        width: 70%;
        height: auto;
        padding: 10px;
        background: #fff;
    }

    .post_other_exsample_text {
        overflow-y: auto;
        height: 60vh;
        padding: 10px;
    }

    .post_other_exsample_show {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<section class="user-panel">
    <div class="container">
        <div class="col-lg-12">
            <section class="content-box mt-5">
                @foreach(['danger','warning', 'success','info'] as $msg)
                @if(Session::has('alert-'.$msg))
                <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">
                        <i class="fa fa-times"></i>
                    </a>
                </p>
                @endif
                @endforeach
                <div id="overlay" class="overlay"></div>
                <div class="box-title">
                    <h3>求人情報の編集</h3>
                </div>
                <div class="box-content">
                    @if ($is_copy)
                    <div class="wrap pos_r">
                        <button type="button" class="js-open actionButton" data-id="5">他の求人をコピーして作成</button>
                    </div>
                    <?php $route = 'jober.job_register_db'; ?>
                    @else
                    <div class="wrap pos_r">
                        <a href="{{ route('home.job_detail',['id'=>$job_id,'page'=>'jober']) }}" class="text-link currentPageLink" target="_blank">既存ページを表示</a>
                    </div>
                    <?php $route = 'jober.job_update_db'; ?>
                    @endif
                    <form action="{{ route($route) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($is_copy)
                        <input type="hidden" name="is_copy" value="1">
                        @else
                        <input type="hidden" name="job_id" value="{{ $job_id }}">
                        @endif
                        <h4 class="itemTitle">仕事について</h4>
                        <table class="table table-data table-bordered profileTable">
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
                                    $post_category = json_decode($job->post_category, true);
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
                                    <td><textarea name="post_other" id="post_other" class="form-control" rows="10" placeholder="">{{ $job->post_other }}</textarea>
                                        <button type='button' id="post_other_exsample_button" class="exsample_button">記入例を見る</button>
                                        <div class="post_other_exsample_popup">
                                            <div class="post_other_exsample">
                                                <div class="post_other_exsample_text">例）軽バンを運転し、ECサイトで注文された商品の配送をお任せします。<br>
                                                    配送先は（個人のお客様、企業様）で1日に〇〇件程度の荷物をお届けしていただきます。配送する（エリア・ルート）は固定なので、慣れてくると地図を見なくても配れるようになります。<br>
                                                    報酬は配った数に応じて変わる個数単価制のため、頑張った分だけしっかりと毎月の運賃に反映されます。<br>
                                                    はじめは既存のドライバーに同乗して配送の流れや現場のルールを覚えてもらいます。稼げるようになるまで責任を持って教育しますので、未経験の方も安心してご応募ください。<br><br><br>
                                                    ----- より詳しい仕事内容を追記したい場合は下記の要素を参考に追記してください -----<br><br>
                                                    ■運転する⾞種（軽バン、冷凍車、冷蔵車、幌者など）<br>
                                                    ■運ぶモノ、件数（モノは何？重さは？1日何件くらい運ぶ？）<br>
                                                    ■配送エリア（具体的にどのエリアで配送する？）<br>
                                                    ■運転距離（近距離〜⻑距離？1日何km運転する？1日ルート何往復？）<br>
                                                    ■配送スタイル（毎回違う場所いく？固定ルートある？）<br>
                                                    ■1日の流れ（何時に着車？何時に帰庫？現場からは直行直帰？）<br>
                                                    ■運転以外の業務（帰庫後、事務作業ある？運転とその他の業務の割合？）<br>
                                                    ■報酬（個数単価？固定報酬？）<br>
                                                    ■契約締結後の流れ（研修はある？車は貸してもらえる？）
                                                </div>
                                                <button id="post_other_exsample_close" type='button' class="exsample_button">閉じる</button>
                                            </div>
                                        </div>
                                        @error('post_other')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th>応募資格<span class="any">任意</span></th>
                                    <td><textarea name="post_require" class="form-control" placeholder="例）年齢不問、未経験者歓迎、要普通AT免許">{{ $job->post_require }}</textarea></td>
                                </tr>
                                <tr>
                                    <th>こんな方にオススメ<span class="any">任意</span></th>
                                    <td><textarea name="post_suitable" class="form-control" rows="10" placeholder="例）
・日給保証で安定して稼ぎたい
・固定のエリアで配送したい
・シフトの融通がきく仕事がしたい
・やった分だけ稼げる仕事がしたい
・車の運転が好き
・自分のペースで自由に働きたい">{{ $job->post_suitable }}</textarea></td>
                                </tr>
                                <tr>
                                    <?php
                                    $post_benefit = json_decode($job->post_benefit, true);
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
                                    <?php
                                    $imgs = json_decode($job->post_img, true);
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
                                        {{-- <div class="new-img-wrapper">--}}
                                        {{-- @for($i = 0; $i < (1-count($imgs)); $i++)--}}
                                        {{-- <input name="new_post_img[]" class="new-img" type="file">--}}
                                        {{-- @endfor--}}
                                        {{-- </div>--}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="itemTitle">働く条件について</h4>
                        <table class="table table-data table-bordered profileTable">
                            <tbody>
                                <tr>
                                    <?php
                                    $post_working_place = json_decode($job->post_working_place, true)
                                    ?>
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
                                                <div id="job_working_place" style="display:none;">{{ json_encode($job_working_place) }}</div>
                                            </li>
                                        </ul>
                                        <p class="add">
                                            <button type="button" class="post_working_place_add">追加</button>
                                        </p>
                                        @error('prefecture.0')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th>報酬<span class="requisite">必須</span></th>
                                    <td>
                                        <p class="item">月額報酬<span class="requisite">必須</span></p>
                                        <input type="text" name="post_payment_text" value="{{ $job->post_payment_text }}" style="max-width: 60%" pattern="^[0-9]+$">&nbsp;万円
                                        &nbsp
                                        <input type="checkbox" name="post_is_payment_more" value="1" {{ $job->post_is_payment_more ? 'checked' : ''}}>以上〜
                                        上限 &nbsp;<input type="text" name="post_payment_max_text" value="{{ $job->post_payment_max_text }}" style="max-width: 60%" pattern="^[0-9]+$">&nbsp;万円<br>
                                        ※数字のみで入力してください。{{$job->post_is_payment_more}}
                                        @error('post_payment_text')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                        <p class="item">ロイヤリティ<span class="requisite">必須</span></p>
                                        <textarea name="post_revenue" class="form-control" placeholder="例）売上の15％">{{ $job->post_revenue }}</textarea>
                                        @error('post_revenue')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                        <p class="item">報酬例<span class="requisite">必須</span></p>
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
                                    <td><textarea name="post_selection" class="form-control" placeholder="応募から稼働開始までの流れや必要書類について記入します。">{{ $job->post_selection }}</textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="itemTitle">職場について</h4>
                        <table class="table table-data table-bordered profileTable">
                            <tbody>
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
                            </tbody>
                        </table>
                        <div class="row mt-3"> @if ($is_copy)
                            <button type="submit" class="action-button submitButton">登録情報を保存する</button>
                            @else
                            <button type="submit" class="action-button submitButton">登録情報を編集する</button>
                            @endif
                        </div>
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
                                <button type="button" class="set js-close button-close" data-target="post_benefit">設定する</button>
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
            </section>
            <div class="modal-window" data-id="modal5">
                <table class="copyTable">
                    <thead>
                        <tr>
                            <td>求人タイトル</td>
                            <td>作成日</td>
                            <td>求人ステータス</td>
                            <td></td>
                        </tr>
                    </thead>
                    @csrf
                    @if(isset($jobs))
                    @foreach($jobs as $copy_job)
                    <tr>
                        <td>{{$copy_job['post_title']}}</td>
                        <td>{{$copy_job['created_at']}}</td>
                        <td>
                            @if ($copy_job['post_status'] === 0) 非公開 @endif
                            @if ($copy_job['post_status'] === 1) 公開 @endif
                            @if ($copy_job['post_status'] === 2) 掲載終了 @endif </td>
                        <td>
                            <form action="{{ route('jober.job_update_copy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="job_id" value="{{$copy_job['id']}}">
                                <button type="submit" class="action-button copyButton">コピー</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.img-remove').click(function() {
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
        for (i = 0; i < category_checked.length; i++) {
            $('.category-checkbox').each(function() {
                var result = $(this).val()
                if (category_checked[i] == result) {
                    $(this).prop("checked", true);
                }
            })
        }
        for (i = 0; i < benefit_checked.length; i++) {
            $('.benefit-checkbox').each(function() {
                var result = $(this).val()
                if (benefit_checked[i] == result) {
                    $(this).prop("checked", true);
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
    $('.set').on('click', function() {
        var target = $(this).data('target');
        var item = $('.' + target + ':checked').map(function() {
            return $(this).val();
        }).get();
        $('#' + target).text(item);
    });

    $(function() {
        $('.js-open').click(function() {
            var id = $(this).data('id'); // 何番目のキャプション（モーダルウィンドウ）か認識
            $('#overlay, .modal-window[data-id="modal' + id + '"]').fadeIn();
        });
        // オーバーレイクリックでもモーダルを閉じるように
        $('.js-close , #overlay').click(function() {
            $('#overlay, .modal-window').fadeOut();
        });
    });

    //職場について初期値表示
    let job_pr = @json($job_pr);
    if (typeof(job_pr) != 'undefined' && job_pr != null && job_pr != '') {
        $.each(job_pr, function(index, value) {
            let clone = $('.post_pr_add').parent().prev('ul.list').find('li.post_pr_block:last-of-type').clone(true);
            clone.find('.post_pr_type').val(value['post_pr_type']);
            if (value['post_pr_title'] != null) {
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
    $('.post_img_add').on('click', function() {
        if ($('.img_block').length < 5) {
            var clone = $(this).parent().prev('ul.img_list').find('li.img_block.new_img:last-of-type').clone(true);
            clone.find('.post_img').val('');
            clone.appendTo('.img_list');
        }
        if ($('.img_block').length == 5) {
            $('.img_add').hide();
        }
    });
    // 画像削除ボタンを押した時
    $('.post_img_delete').on('click', function() {
        if ($('.img_block.new_img').length > 1) {
            $(this).closest('.img_block').remove();
            $('.img_add').show();
        } else {
            $('.post_img').val('');
        }
    });

    // 職場について追加ボタンを押した時
    $('.post_pr_add').on('click', function() {
        var clone = $(this).parent().prev('ul.list').find('li.post_pr_block:last-of-type').clone(true);
        clone.find('.post_pr_type').val('');
        clone.find('.post_pr_text').val('');
        clone.find('.post_pr_title').val('');
        clone.find('.post_pr_title').hide();
        clone.appendTo('.list');
    });
    // 職場について削除ボタンを押した時
    $('.post_pr_delete').on('click', function() {
        if ($('.post_pr_block').length > 1) {
            $(this).closest('.post_pr_block').remove();
        } else {
            $('.post_pr_type').val('');
            $('.post_pr_text').val('');
            $('.post_pr_title').val('');
        }
    });

    // 仕事内容説明ポップアップ
    $('#post_other_exsample_button').on('click', function() {
        $('.post_other_exsample_popup').addClass('post_other_exsample_show');
    });

    $('#post_other_exsample_close').on('click', function() {
        $('.post_other_exsample_popup').hide();
    });

    // 職場についてで「その他（自由テーマ）」が選択されたらタイトル行追加
    $('.post_pr_type').each(function() {
        if ($(this).val() === 'その他') {
            $(this).nextAll('.post_pr_title').show();
        }
    });
    // 職場について 選択された内容によってplaceholderの内容を変える
    $('.post_pr_type').on('change', function() {
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

    $('.submitButton').on('click', function() {
        let error = true;
        $('.post_pr_type').each(function() {
            if ($(this).val() === 'その他' && $(this).nextAll('.post_pr_title').val() === '') {
                $(this).nextAll('.pr_title_error').append('<strong>この項目は必須です。</strong>');
                error = false;
            }
        });
        return error;
    });

    // 勤務地
    // DOMの読み込みが完了したら実行
    $(document).ready(function() {
        // 初期設定
        if ($('#job_working_place').length > 0) {
            let working_places = JSON.parse($('#job_working_place').text());
            setInitialWorkingPlaces(working_places);
        }

        // 勤務地追加ボタン
        $('.post_working_place_add').click(function() {
            let clone = $('.post_working_place_block:first').clone();
            let firstPrefectureValue = $('.post_working_place_block:first').find('.prefecture').val();
            clone.find('.prefecture').val(firstPrefectureValue).prop('disabled', true);
            clone.find('.post_working_place_delete').show();
            $('.post_working_place_list').append(clone);
        });

        // 勤務地削除ボタン
        $('.post_working_place_list').on('click', '.post_working_place_delete', function() {
            $(this).closest('.post_working_place_block').remove();
        });

        let previousPrefectureValue = null;
        let previousCityValue = null;

        $('.post_working_place_list').on('focus', '.post_working_place_block:first .prefecture', function() {
            previousPrefectureValue = $(this).val();
            previousCityValue = $(this).closest('.post_working_place_block').find('.city').val();
        });

        $('.post_working_place_list').on('change', '.post_working_place_block:first .prefecture', function() {
            let currentBlock = $(this).closest('.post_working_place_block');
            if ($('.post_working_place_block').length > 1) {
                let userConfirmed = window.confirm('都道府県は一つしか選択できません。他のエリアを削除してもよろしいですか？');

                if (!userConfirmed) {
                    $(this).val(previousPrefectureValue);
                    let citySelect = currentBlock.find('.city');
                    $.getJSON('/api/getCityList/' + previousPrefectureValue, function(data) {
                        citySelect.empty();
                        $.each(data, function(_, city) {
                            citySelect.append($('<option>').text(city.city_name).val(city.city_id));
                        });
                        citySelect.val(previousCityValue);
                    });
                    return false;
                } else {
                    $('.post_working_place_block:not(:first)').remove();
                }
            }
        });

        // 都道府県が変更された場合、関連する市区町村を更新
        $('.post_working_place_list').on('change', '.prefecture', function() {
            let block = $(this).closest('.post_working_place_block');
            let prefectureId = $(this).val();
            let citySelect = block.find('.city');
            let list_id = $(this).attr('data-id'); // 新しく追加した部分
            let city = prefectureId + '000'; // 新しく追加した部分

            // 市区町村プルダウンを初期化
            citySelect.empty();
            citySelect.append('<option value="">選択してください</option>');

            // APIから市区町村データを取得
            $.ajax({
                url: '/api/getCityList/' + prefectureId,
                method: 'GET',
                success: function(data) {
                    $.each(data, function(index, cityData) {
                        citySelect.append('<option value="' + cityData.city_id + '">' + cityData.city_name + '</option>');
                    });
                    $('#post_working_place' + list_id).val(city); // 新しく追加した部分
                },
                error: function() {
                    alert('市区町村のデータの取得に失敗しました');
                }
            });
        });

    });

    // 初期値をセット
    function setInitialWorkingPlaces(working_places) {
        $.each(working_places, function(index, place) {
            let block;
            if (index === 0) {
                block = $('.post_working_place_block:first');
                block.find('.post_working_place_delete').hide();
            } else {
                block = $('.post_working_place_block:first').clone();
                block.find('.prefecture').prop('disabled', true);
                block.find('.post_working_place_delete').show();
                $('.post_working_place_list').append(block);
            }

            block.find('.prefecture').val(place.ken_id);

            // 市区町村のプルダウンリストを更新
            $.getJSON('/api/getCityList/' + place.ken_id, function(data) {
                let citySelect = block.find('.city');
                citySelect.empty();
                $.each(data, function(_, city) {
                    citySelect.append($('<option>').text(city.city_name).val(city.city_id));
                });
                // 初期値をセット
                citySelect.val(place.city_id);
            });
        });
    }
</script>
@endsection