@extends('layouts.admin.admin_main_layout')
@section('content')
    <style>
        td{
            vertical-align:middle;
            text-align:center;
            align-items: center;
            justify-items: center;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1 class="m-0 text-dark">注目求人情報設定</h1>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @foreach(['danger','warning', 'success','info'] as $msg)
                    @if(Session::has('alert-'.$msg))
                        <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                <i class="fa fa-times"></i>
                            </a>
                        </p>
                    @endif
                @endforeach
                <form action="{{ route('admin.featured_job_setting') }}" method="post">
                    @csrf
                    <input type="hidden" name="featured_id[]" id="hiddenField" value="">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mt-5">
                                    <table class="table table-bordered datatable" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th class="num">&nbsp;</th>
                                            <th class="name">求人掲載会社名</th>
                                            <th class="email">求人タイトル</th>
                                            <th class="email">登録日付</th>
                                            <th class="management">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($public_jobs as $public_job)
                                            <tr>
                                                <td class=num>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="{{ $public_job['id'] }}" class="featured-status" id="featured{{$public_job['id']}}"
                                                            {{ $public_job['feature_job'] ? 'checked' : '' }}>
                                                        <label for="featured{{$public_job['id']}}"></label>
                                                    </div>
                                                </td>
                                                <td class="name">{{ App\Models\User::where('id',$public_job['jober_id'])->first()->name }}</td>
                                                <td class="email">{{ $public_job['post_title'] }}</td>
                                                <td class="email">{{ $public_job['created_at'] }}</td>
                                                <td class="management fl">
                                                    <a href="" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                    <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">設定する</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            $('.datatable').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
                }
            });

            var selectedJobs = JSON.parse(localStorage.getItem('selectedJobs')) || [];

            updateHiddenField();

            $('.datatable').on('draw.dt', function() {
                $('.featured-status').each(function() {
                    var id = $(this).val();
                    $(this).prop('checked', selectedJobs.includes(id));
                });
            });

            $('.featured-status').change(function() {
                var id = $(this).val();
                if($(this).is(':checked')) {
                    if(!selectedJobs.includes(id)) {
                        selectedJobs.push(id);
                    }
                } else {
                    var index = selectedJobs.indexOf(id);
                    if(index > -1) {
                        selectedJobs.splice(index, 1);
                    }
                }

                localStorage.setItem('selectedJobs', JSON.stringify(selectedJobs));

                updateHiddenField();
            });

            function updateHiddenField() {
                $('#hiddenField').val(selectedJobs.join(','));
            }
        });
    </script>
@endsection

