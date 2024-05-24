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
                                <table class="table table-bordered" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>画像</th>
                                        <th>メニュー名</th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($article_list as $article)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset("images/blogs") .'/'.$article['media_url'] }}" alt="" width="250">
                                            </td>
                                            <td>
                                                <h3>{{ $article['article_title'] }}</h3>
                                                <h6>{{ $article['article_content'] }}</h6>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.article_update',$article['id']) }}" class="btn btn-outline-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <a href="{{ route('admin.article_delete',$article['id']) }}" class="btn btn-outline-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
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



