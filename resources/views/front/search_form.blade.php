<section class="sec01">
    <div class="inner">
        <h3>お仕事検索</h3>
        <ul class="content">
            <li class="type01 clearfix">

                <form action="{{ route('home.search') }}" method="get">
                    <select name="prefecture">
                        <option value="" disabled selected>勤務地</option>
{{--                        @foreach($areas as $area)--}}
{{--                            <option value="{{ $area['area_name'] }}">{{ $area['area_name'] }}</option>--}}
{{--                        @endforeach--}}
                        @foreach($prefecture as $v)
                            <option value="{{ $v->ken_id }}">{{ $v->ken_name }}</option>
                        @endforeach
                    </select>
                    <select name="category">
                        <option value="" disabled selected>業種</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['kind_name'] }}">{{ $category['kind_name'] }}</option>
                        @endforeach
                    </select>
                    <button type="submit" id="submit_button01">
                    <i class="fa-solid fa-magnifying-glass fa-lg" style="color: #ffffff;"></i>&nbsp;検索する</button>
                </form>
            </li>
        </ul>
    </div>
</section>


