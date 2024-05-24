@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>勤務地リスト</h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
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
                            <div class="col-md-12">
                                <table class="table table-bordered datatable dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th class="num">No.</th>
                                            <th class="name">勤務地</th>
                                            <th class="management">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($areas as $area)
                                            <tr>
                                                <td class="num">{{ $loop->iteration }}</td>
                                                <td class="name">{{ $area->area_name }}</td>
                                                <td class="management">
                                                    <div class="flex">
                                                        <a href="{{ route('admin.area_update', $area->id) }}" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ route('admin.area_delete', $area->id) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    </script>
@endsection
