@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>職種リスト</h3>
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
                                        <th class="name">職種</th>
                                        <th class="management">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($category_list as $category)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="name">{{ $category->kind_name }}</td>
                                            <td class="management">
                                                <div class="flex">
                                                    <a href="{{ route('admin.category_update', $category->id) }}" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('admin.category_delete', $category->id) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
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
