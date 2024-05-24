<style>
    .navbar{
        position: relative;
        display: flex;
        flex-wrap: wrap;
        min-height: 0px!important;
        margin-bottom: 12px!important;
        justify-content: flex-end;
    }
    .dropdown-menu > li >a {
        /*padding: 10px 20px!important;*/
        white-space: pre-wrap!important;
    }
    .drop-item{
        width: 100%;
    }
    .drop-item:focus-visible{
        border:none!important;
        outline: none!important;
    }
</style>
<header>
    <div class="inner clearfix">
        <h1><a href="/"><img src="{{ asset('front/img/common/logoHead.png')}}" alt="ハコボウズ"></a></h1>
        <div id="app">
            @guest
                <ul class="navbar">
                    <li><a href="/articles/lp/lp_b001/"><i class="fa fa-university"></i>採用担当者の方はこちら</a></li>
                    <li><a href="/contact"><i class="fa fa-envelope"></i>お問い合わせ</a></li>
                    <li><a href="/login" class="action-button shadow animate green">ログイン</a></li>
                    <li><a href="/register" class="action-button shadow animate red">まずは会員登録（無料）</a></li>
                </ul>
            @else
                <ul class="navbar">
                    @if(Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-user-circle-o"></i>
                                {{ Auth::user()->name }}様
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('user.dashboard') }}">
                                        <i class="fa fa-id-badge "></i>マイページ
                                    </a>
                                </li>
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('user.myFavorites') }}">
                                        <i class="fa fa-thumbs-up"></i>お気に入りリスト
                                    </a>
                                </li>
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('user.bid_list') }}">
                                        <i class="fa fa-bookmark"></i>応募リスト
                                    </a>
                                </li>
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('user.user_profile') }}">
                                        <i class="fa fa-cogs "></i>アカウント設定
                                    </a>
                                </li>
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('user.web_history_main') }}"><i class="fa fa-clipboard"></i>履歴書</a>--}}
{{--                    </li>--}}
                    @elseif(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-user-circle-o"></i>
                                {{ Auth::user()->name }}様
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('jober.dashboard') }}">
                                        <i class="fa fa-id-badge "></i>マイページ
                                    </a>
                                </li>
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('jober.jober_profile') }}">
                                        <i class="fa fa-cogs "></i>アカウント設定
                                    </a>
                                </li>
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('jober.hire_list') }}">
                                        <i class="fa fa-gavel"></i>採用者リスト
                                    </a>
                                </li>
                                <li role="presentation" class="drop-item">
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @elseif(Auth::user()->user_type == 1)
                        <ul class="navbar">
                            <li><a href="/articles/lp/lp_b001/"><i class="fa fa-university"></i>採用担当者の方はこちら</a></li>
                            <li><a href="/contact"><i class="fa fa-envelope"></i>お問い合わせ</a></li>
                            <li><a href="/login" class="action-button shadow animate green">ログイン</a></li>
                            <li><a href="/register" class="action-button shadow animate red">まずは会員登録（無料）</a></li>
                        </ul>
                    @endif
                    <li class="nav-item">
                        <push-component :app_url="'{{ env('APP_URL') }}'"></push-component>
                    </li>
                    <li class="nav-item">
                        <unread-message :user="{{ Auth::user()->id }}"></unread-message>
                    </li>
                </ul>
            @endguest
            <nav class="navbar below">
                <ul>
                    <li><a href="/">ホーム</a></li>
                    <li><a href="/search">お仕事検索</a></li>
                    <li><a href="/first">初めてご利用の方へ</a></li>
                    <li><a href="/articles/">お役立ちコンテンツ</a></li>
                    <li><a href="/company">会社概要</a></li>
                </ul>
            </nav>

            <p class="menu_sp sp">
                <a id="panel-btn" class="sp-menu off">
                    <i class="fa fa-bars" style="font-size:25px!important;" id="panel-btn-icon"></i><br>MENU
                </a>
                @guest
                    <a class="sp-menu" href="/register">
                        <i class="fa fa-user"  style="font-size:25px!important;"></i><br>新規登録
                    </a>
                    <a class="sp-menu" href="/login">
                        <i class="fa fa-sign-in" style="font-size:25px!important;"></i><br>ログイン
                    </a>
                @else
                    <div class="sp-menu">
                        <unread-message></unread-message>
                    </div>
                    <div class="sp-menu">
                        <push-component :app_url="'{{ env('APP_URL') }}'"></push-component>
                    </div>
                @endguest
            </p>
        </div>
        <div id="panel" class="sp_menu slideMenu">
            <div class="menu-box">
                <div class="menu-box-inner">
                    <ul class="menu-list-index">
                        <li><a href="/">ホーム</a></li>
                        @guest
                            <li><a href="/search?">お仕事検索</a></li>
                            <li><a href="/first">初めてご利用の方へ</a></li>
                            <li><a href="/articles/">お役立ちコンテンツ</a></li>
                        @else
                            @if(Auth::user()->user_type == 3)
                                <li><a href="{{ route('user.dashboard') }}">マイページ</a></li>
                                <li><a href="{{ route('user.myFavorites') }}">お気に入りリスト</a></li>
                                <li><a href="{{ route('user.bid_list') }}">応募リスト</a></li>
                                <li><a href="{{ route('user.user_profile') }}">アカウント設定</a></li>
                                <li><a href="{{ route('chatting')  }}">メッセージ</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @elseif(Auth::user()->user_type == 2)
                                <li><a href="{{ route('jober.dashboard') }}">マイページ</a></li>
                                <li><a href="{{ route('jober.hire_list') }}">採用者リスト</a></li>
                                <li><a href="{{ route('jober.jober_profile') }}">アカウント設定</a></li>
                                <li><a href="{{ route('chatting')  }}">メッセージ</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
                <div class="close"><span class="button">✕</span></div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</header>
