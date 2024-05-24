@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>新規職種編集</h3>
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
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.category_update_db') }}" method="post" id="area_form">
                                    @csrf
                                    <input type="hidden" name="kind_id" value="{{ $id }}">
                                    <div class="form-group">
                                        <label>職種</label>
                                        <input type="text" class="form-control @error('kind_name') is-invalid @enderror" name="kind_name" value="{{ $category->kind_name }}">
                                        @error('kind_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group text-center">
                                        <button id="submit" class="btn btn-primary">編集する</button>
                                    </div>
                                </form>
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
