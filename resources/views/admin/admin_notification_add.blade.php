@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container">
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
                        <form role="form" method="POST" action="{{ route('admin.notification_add_db') }}" class="form-container">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>お知らせタイトル</label>
                                        <input type="text" class="form-control @error('n_title') is-invalid @enderror" name="n_title">
                                        @error('n_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="lcheckbox1">お知らせ内容</label>
                                        <textarea name="n_content" id="summernote" class="form-control text-editor"  rows="10"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="lcheckbox1">youtube動画url</label>
                                        <textarea name="media_url" class="form-control"  rows="10"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn btn-block btn-primary btn-lg col-md-4 offset-md-4">追加</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.text-editor').summernote().text()
        });
        $('#summernote').summernote({
            toolbar: [
                    ['link', ['linkDialogShow', 'unlink']]
            ]
        });
    </script>
@endsection



