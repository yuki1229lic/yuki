@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>過去の求人特集一覧</li>
            </ul>
        </div>
    </div>
    <article id="search">
        <section class="sec02">
            <ul class="list_jobs">
                @foreach($specials as $special)
                    <li>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset('images/special')}}/{{ $special['special_img'] }}" alt="" width="100%">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row col-md-12 mt-4 mb-4">
                                            <div class="col-md-8 text-center">
                                                <h4 class="b_font">{{ $special['special_title'] }}</h4>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <p class="day">掲載日：{{ Illuminate\Support\Carbon::parse($special['updated_at'])->format('Y.m.d') }}</p>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <p>
                                                <a href="{{ route('home.area_search',$special['special_area']) }}">
                                                    <span class="badge badge-orange">{{ $special['special_area'] }}</span>
                                                </a>
                                                <a href="{{ route('home.category_search',$special['special_category']) }}">
                                                     <span class="badge badge-info">
                                                        {{ App\Models\Job_kind::where('id',$special['special_category'])->first()->kind_name }}
                                                    </span>
                                                </a>
                                            </p>
                                        </div>
                                        <div class="row col-md-12 mt-3">
                                            {{ \App\Http\Controllers\HomeController::trip_text($special['special_content']) }}...
                                        </div>
                                        <hr>
                                        <dl class="text-center">
                                            <a href="{{ route('home.special_detail',$special['id']) }}">詳しく見る</a>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    {!! $specials->links() !!}
                </div>
            </div>
        </section>
    </article>
@endsection
