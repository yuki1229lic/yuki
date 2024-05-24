@extends('layouts.admin.admin_main_layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>新規勤務地追加</h3>
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
                                <form action="{{ route('admin.area_add_db') }}" method="post" id="area_form">
                                    @csrf
                                    <div class="form-group">
                                        <label>勤務地</label>
                                        <input type="text" class="form-control @error('area_name') is-invalid @enderror" name="area_name">
                                        @error('area_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group text-center">
                                        <button id="submit" class="btn btn-primary">追加する</button>
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
