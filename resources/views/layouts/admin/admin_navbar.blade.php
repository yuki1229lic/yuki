<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('jober.dashboard') }}" class="brand-link">
        <img src="{{ asset('front/img/common/admin_logo.png')}}" alt="Logo" width="">
        <span class="brand-text font-weight-light">| 管理者</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('jober.dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            ダッシュボード
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            ユーザー管理
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>ユーザーリスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user_add') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>ユーザー追加</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>
                            企業管理
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.enterprise_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>企業リスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.dsp_enterprise_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>DSP企業リスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.enterprise_add') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>企業追加</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-calendar-check-o"></i>
                        <p>
                            求人情報管理
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.public_job_list') }}" class="nav-link">
                                <i class="fa fa-unlock nav-icon"></i>
                                <p>公開求人リスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.old_job_list') }}" class="nav-link">
                                <i class="fa fa-lock nav-icon"></i>
                                <p>過去求人リスト</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-free-code-camp"></i>
                        <p>
                            特集求人管理
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.special_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>特集求人リスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.special_add') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>特集求人追加</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-anchor"></i>
                        <p>
                            職種管理
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>職種リスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category_add') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>新規職種追加</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-map-marker"></i>
                        <p>
                            勤務地管理
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.area_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>勤務地リスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.area_add') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>新規勤務地追加</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            お役立ちコンテンツ管理
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.article_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>お役立ちコンテンツリスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=" {{ route('admin.article_setting') }} " class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>お役立ちコンテンツ追加</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bell"></i>
                        <p>
                            お知らせ管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.notification_list') }}" class="nav-link">
                                <i class="fa fa-table nav-icon"></i>
                                <p>お知らせリスト</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.notification_add') }}" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>お知らせ追加</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
