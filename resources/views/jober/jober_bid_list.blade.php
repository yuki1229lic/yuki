@extends('layouts.jober.jober_main_layout')
@section('content')
    <article id="search_d">
        <section class="sec01">
            <div id="overlay" class="overlay"></div>
            <div class="inner">
                <div class="box">
                    <div class="block2">
                        <h4>応募履歴</h4>
                        <div class="box-title">
                            <h3>応募者リスト</h3>
                        </div>
                        <div class="box-content">
                            <table class="table table-bordered dataTable bidTable">
                                <tbody>
                                    <tr>
                                        <th>No.</th>
                                        <th>氏名</th>
                                        <th>応募日</th>
                                        <th>選考ステータス</th>
                                        <th>求人タイトル</th>
                                        <th>メモ</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    @foreach($bids as $bid)
                                    <tr>
                                        <td class="num">{{ $loop->iteration }}</td>
                                        <td>
                                            @if($bid->user_id)
                                                <a href="{{ route('home.user_profile',$bid->user_id) }}" class="text-link">
                                                    {{ $bid_name = App\Models\User::where('id',$bid->user_id)->first()->name }}様
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{$bid->created_at}}
                                        </td>
                                        <td>
                                            {{-- TODO データベース化する--}}
                                            <select name="hired_status" onchange="status_change({{$bid['id']}});return false;" id="status{{$bid['id']}}">
                                                <option value=0 @if ($bid->hired_status === 0) selected @endif>未対応</option>
                                                <option value=3 @if ($bid->hired_status === 3) selected @endif>連絡済</option>
                                                <option value=4 @if ($bid->hired_status === 4) selected @endif>選考中</option>
                                                <option value=5 @if ($bid->hired_status === 5) selected @endif>内定</option>
                                                <option value=6 @if ($bid->hired_status === 6) selected @endif>内定承諾</option>
                                                <option value=1 @if ($bid->hired_status === 1) selected @endif>入社</option>
                                                <option value=7 @if ($bid->hired_status === 7) selected @endif>辞退</option>
                                                <option value=2 @if ($bid->hired_status === 2) selected @endif>不採用</option>
                                            </select>
                                        </td>
                                        <td>
{{--                                            <a href="{{ route('jober.job_detail',$bid->job_id) }}" class="text-link">--}}
                                            <a href="{{ route('home.job_detail',['id'=>$bid->job_id,'page'=>'jober']) }}" class="text-link">
                                                {{ $post_title = App\Models\Job::where('id',$bid->job_id)->first()->post_title }}
                                                {{$bid->post_title}}
                                            </a>
                                        </td>
                                        <td>{{$bid->memo}}</td>
                                        <td>
                                            <a onclick="create_session( {{ $bid['user_id'] }} );" class="action-button blueButton">
                                                {{--<i class="fa fa-envelope-o" style="color:white;"></i>--}}メッセージを送る
                                            </a>
                                            @if($bid->hired_status != 1)
                                                <a class="action-button redButton" onclick="hire_bid({{ $bid->id }})">
{{--                                                    <i class="fa fa-handshake-o" style="color:white;"></i>--}}
                                                    採用する
                                                </a>
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
    <div class="modal fade" id="quickView" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="product-details">
                                <form action="" method="POST" id="message_form">
                                    @csrf
                                    <input type="hidden" name="to_user" id="to_user">
                                    <input type="hidden" name="session_id" id="session_id">
                                    <textarea name="message" class="form-control mt-4" rows="4"></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <a type="button" class="action-button shadow animate green-btn col-md-push-3 col-md-6" id="send_message">メッセージを送信する</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-window" id="modal_status_change" data-id="modal1">
        <form action="{{ route('jober.hire_status_change') }}" method="POST">
            @csrf
            <label for="" class="statusText">ステータスを<span id="status_name" class="bol"></span>に変更します</label>
            <input type="hidden" name="bid_id" id="status_change_bid_id">
            <input type="hidden" name="hired_status" id="hired_status">
            <div class="buttonBox">
                <button type="button" class="js-close button-cancel">キャンセル</button>
                <button type="submit" class="js-close button-close">変更する</button>
            </div>
        </form>
    </div>
    <div class="modal fade" id="quickView2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="product-details">
                                <form action="{{ route('jober.hire') }}" method="POST">
                                    @csrf
                                    <label for="">作業着手の日付を選択してください。</label>
                                    <input type="hidden" name="bid_id" id="bid_id">
                                    <input type="date" name="hired_date" class="form-control">
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <button type="submit" class="action-button shadow animate green-btn col-md-push-3 col-md-6">採用する</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#send_message').click(function(){
                $('#message_form').submit();
                $('#quickView').modal('close');
            })
        });
        function create_session($friend_id){
            $.post("{{ route('session.create') }}", {friend_id:$friend_id}, function (res){
                if(res != 'error'){
                    var url = '/send_first_message/' + res.data.id;
                    $('#message_form').attr('action',url);
                    $('#to_user').val($friend_id);
                    $('#session_id').val(res.data.id)
                    $('#quickView').modal('show');
                    $('#overlay, #quickView').fadeIn();
                }else{
                    window.location = '{{ route('chatting') }}'
                }
            });
        }
        function status_change(bid_id){
            $('#status_change_bid_id').val(bid_id);
            $('#hired_status').val($('#status' + bid_id).val());
            $('#status_name').text($('#status' + bid_id + ' option:selected').text());
            $('#overlay, #modal_status_change').fadeIn();
        };

        // オーバーレイクリックでもモーダルを閉じるように
        $('.js-close , #overlay').click(function () {
            $('#overlay, .modal-window').fadeOut();
        });
        function hire_bid(bid_id){
            $('#bid_id').val(bid_id);
            $('#quickView2').modal('show');
        }
    </script>
@endsection
