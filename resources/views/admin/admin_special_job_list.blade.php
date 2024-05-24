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
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-5">
                                <table class="table table-bordered datatable dataTable no-footer spacial" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="num">№</th>
                                        <th class="management">画像</th>
                                        <th class="name">特集求人</th>
                                        <th class="email">勤務地</th>
                                        <th class="created">職種</th>
                                        <th class="management">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($special_list as $special)
                                        <tr>
                                            <td class="num">{{ $loop->iteration }}</td>
                                            <td class="banner">
                                                <img src="{{ asset("images/special") .'/'.$special['special_img'] }}" alt="" width="250">
                                            </td>
                                            <td class="name">
                                                <h3>{{ $special['special_title'] }}</h3>
                                                <h6>{!! $special['special_content'] !!}</h6>
                                            </td>
                                            <td class="email">{{ $special['special_area'] }}</td>
                                            <td class="created">{{ App\Models\Job_kind::where('id',$special['special_category'])->first()->kind_name }}</td>
                                            <td class="num">
                                                <div class="flex">
                                                    <a href="{{ route('admin.special_update',$special['id']) }}" class="btn btn-outline-primary">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.special_delete',$special['id']) }}" class="btn btn-outline-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
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



