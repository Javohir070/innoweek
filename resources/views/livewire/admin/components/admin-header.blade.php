<div class="header">
    <!-- Logo -->
    <div class="header-left active">
        <a href="index.html" class="logo logo-white">
            <img src="/admin/assets/img/logo-white.png" alt="">
        </a>
        <a href="index.html" class="logo-small">
            <img src="/admin/assets/img/logo-small.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!-- Flag -->
        <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                <img src="/admin/assets/img/flags/uz.png" alt="Language" class="img-fluid">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item active">
                    <img src="/admin/assets/img/flags/uz.png" alt="" height="16"> O'zbekcha
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="/admin/assets/img/flags/ru.png" alt="" height="16"> Russian
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="/admin/assets/img/flags/us.png" alt="" height="16"> English
                </a>
            </div>
        </li>
        <!-- /Flag -->

        <li class="nav-item nav-item-box">
            <a href="javascript:void(0);" id="btnFullscreen">
                <i data-feather="maximize"></i>
            </a>
        </li>
        <!-- Notifications -->
        <li class="nav-item dropdown nav-item-box">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i data-feather="bell"></i><span class="badge rounded-pill">2</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Bildirishnomalar</span>
                    <a href="javascript:void(0)" class="clear-noti"> Barchasini tozalash </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="/admin/assets/img/profiles/avatar-02.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">John Doe</span> yangi talabnoma yubordi <span class="noti-title">Loyiha boshqaruvi va texnologiya tranferi bo'limi</span></p>
                                        <p class="noti-time"><span class="notification-time">4 daqiqa avval</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">Barcha bildirishnomalar</a>
                </div>
            </div>
        </li>
        <!-- /Notifications -->

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-info">
                    <span class="user-letter">
                        <img src="/admin/assets/img/profiles/avator1.jpg" alt="" class="img-fluid">
                    </span>
                    <span class="user-detail">
                        <span class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        <span class="user-role">
                            @role('super-admin')
                                Administrator
                            @endrole
                            @role('admin')
                                Administrator
                            @endrole
                            @role('moderator')
                                Moderator
                            @endrole
                            @role('organizer')
                                Organizator
                            @endrole
                        </span>
                    </span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{ route('admin.users.info').'?user_id='. auth()->id() }}"> <i class="me-2" data-feather="user"></i> Profil</a>
                    <a class="dropdown-item" href="{{ route('admin.users.info').'?user_id='. auth()->id() }}"><i class="me-2" data-feather="settings"></i>Profil sozlamlari</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="/admin/assets/img/icons/log-out.svg" class="me-2" alt="img">Chiqish
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('admin.users.info') }}">Profil</a>
            <a class="dropdown-item" href="general-settings.html">Profil sozlamalar</a>
            <a class="dropdown-item" href="signin.html">Chiqish</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>
