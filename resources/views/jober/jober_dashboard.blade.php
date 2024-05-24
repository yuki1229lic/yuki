@extends('layouts.jober.jober_main_layout')
@section('content')
    <style>
        .text-tag{
            text-align:center;
            color:#0074c1!important;
            text-decoration: underline!important;
        }
        @media (max-width: 640px) {
            .article-img{
                display: none;
            }
        }
    </style>
    <section class="user-panel">
        <div class="container">
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
                    <h3>求人リスト</h3>
                </div>
                <div class="box-content detailBox">
                    <form id="form_job_status_all_change" action="{{ route('jober.job_status_change') }}" method="POST" class="clearfix">
                        <a href="{{ route('jober.job_register') }}" class="add_button"><span class="add">+</span>求人作成</a>
                        <p>ステータス一括変更</p>
                        <select name="job_all_status_change" id='job_all_status_change'>
                            <option value=''>選択してください。</option>
                            <option value=1>公開中</option>
                            <option value=0>募集停止</option>
                        </select>
                    </form>
                    <div class="detailListBox">
                        <table class="table table-bordered dataTable">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>求人タイトル</th>
                                    <th>勤務地</th>
                                    <th >作成日</th>
                                    <th>ステータス</th>
                                    <th>閲覧数</th>
                                    <th>応募者数</th>
                                </tr>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $loop->iteration }}
                                        <input type="checkbox" name="all_status" class="all_status" value="{{$job['id']}}">
                                    </td>
                                    <td >
                                        <a href="{{ route('jober.job_update',$job['id']) }}" class="link">{{ $job['post_title'] }}</a>
                                    </td>
                                    <td>
                                        @isset($job['working_place'])
                                            @foreach($job['working_place'] as $key => $place)
                                                <a href="{{ route('home.area_search',$place['area_id']) }}" class="badgeBtn"><span class="badge badge-orange">{{ $place['area_name'] }}</span></a>
                                            @endforeach
                                        @endisset
                                    </td>
                                    <td>
                                        {{ $job['created_at'] }}
                                    </td>
                                    <td>
                                        <select name="post_status" onchange="job_status_change({{$job['id']}});return false;" id="status{{$job['id']}}">
                                            <option value=1 @if ($job['post_status'] === 1) selected @endif>公開中</option>
                                            <option value=0 @if ($job['post_status'] === 0) selected @endif>募集停止</option>
                                        </select>
                                    </td>
                                    <td>
                                        {{ $job['view'] }}人
                                    </td>
                                    <td>
                                        <?php
                                            $bids = App\Models\Bid::where('job_id',$job['id'])->get();
                                        ?>
                                        {{ count($bids) }}人
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        {!! $jobs->links() !!}
                    </div>
                </div>
            </section>
            <div class="modal-window" id="quickView" data-id="modal1">
                <form action="{{ route('jober.job_status_change') }}" method="POST">
                        @csrf
                        <label for="" class="statusText">ステータスを<span id="post_status_name" class="bol"></span>に変更します</label>
                        <input type="hidden" name="job_id" id="job_id">
                        <input type="hidden" name="jober_id" id="jober_id" value="{{$jober_id}}">
                        <input type="hidden" name="post_status" id="post_status">
                    <div class="buttonBox">
                        <button type="button" class="js-close button-cancel">キャンセル</button>
                        <button type="submit" class="js-close button-close">変更する</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        $('.set').on('click', function(){
            var target = $(this).data('target');
            var item = $('.' + target + ':checked').map(function() {
                return $(this).val();
            }).get();
            $('#' + target).text(item);
        });

        function job_status_change(job_id){
            $('#job_id').val(job_id);
            $('#post_status').val($('#status' + job_id).val());
            $('#post_status_name').text($('#status' + job_id + ' option:selected').text());
            $('#overlay, #quickView').fadeIn();
        };

        $('#job_all_status_change').on('change', function(){
            if ($('#job_all_status_change').val() !== '') {
                var ids = $('[class="all_status"]:checked').map(function() {
                    return $(this).val();
                }).get().join(',');
                $('#job_id').val(ids);
                $('#post_status').val($('#job_all_status_change').val());
                $('#post_status_name').text($('#job_all_status_change option:selected').text());
                $('#overlay, #quickView').fadeIn();
            }
        });

        // オーバーレイクリックでもモーダルを閉じるように
        $('.js-close , #overlay').click(function () {
            $('#overlay, .modal-window').fadeOut();
        });
    </script>
@endsection

