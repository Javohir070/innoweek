<header id="home" class="header header1 sticky-on trheader">
    <div id="navbar-wrap" class="navbar-wrap">
        <div class="header-menu">
            <div class="header-width">
                <div class="container-fluid">
                    <div class="inner-wrap">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="site-branding">
                                <a href="{{ route('front.home') }}" class="logo logo-light wow fadeInUp animated" data-wow-delay="0.40s"><img src="{{ asset('/front/image/logo.webp') }}" alt="Logo" width="120"></a>
                                <a href="{{ route('front.home') }}" class="logo logo-dark"><img src="{{ asset('/front/image/logo.webp') }}" alt="Logo" width="120"></a>
                            </div>

                            <nav id="dropdown" class="template-main-menu menu-text-light">
                                <ul class="menu">
                                    <li class="menu-item {{ Request::routeIs('front.home') ? 'active' : '' }} menu-item-has-children wow fadeInUp animated" data-wow-delay="0.1s">
                                        <a href="{{ route('front.home') }}">{{ __('site.menus.Home')}}</a>
                                    </li>
                                    <li class="menu-item {{ Request::routeIs('front.menu.*') ? 'active' : '' }}  menu-item-has-children wow fadeInUp animated" data-wow-delay="0.5s">
                                        <a class="inno-cursor">{{ __('site.menus.InnoWeek')}}</a>
                                        <ul class="sub-menu menu-w">
                                            <li class="menu-item"><a href="{{ route('front.menu.about') }}">{{ __('site.menus.About Us')}}</a></li>
                                            <li class="menu-item"><a href="{{ route('front.menu.news') }}">{{ __('site.menus.News')}}</a></li>
                                            <li class="menu-item">
                                                <a target="_blank" href="{{ asset(getSiteInfo('file_1_'.\App::getLocale())) }}">{{ __('site.menus.InnoWeek Program File 1')}}</a>
                                            </li>
                                            <li class="menu-item">
                                                <a target="_blank" href="{{ asset(getSiteInfo('file_2_'.\App::getLocale())) }}">{{ __('site.menus.InnoWeek Program File 2')}}</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="{{ route('front.home') }}#gallery">{{ __('site.menus.Photo Gallery')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="menu-item {{ Request::routeIs('front.menu.*') ? 'active' : '' }}  menu-item-has-children wow fadeInUp animated" data-wow-delay="0.5s">
                                        <a class="inno-cursor">{{ __('site.menus.Archive')}}</a>
                                        <ul class="sub-menu menu-w">
                                            <!-- <li class="menu-item">
                                                <a target="_blank" href="#">INNOWEEK 2023</a>
                                            </li> -->
                                            <li class="menu-item">
                                                <a target="_blank" href="http://2024.innoweek.uz/">INNOWEEK 2024</a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="menu-item {{ Request::routeIs('front.speakers.*') ? 'active' : '' }} menu-item-has-children wow fadeInUp animated" data-wow-delay="0.4s">
                                        <a href="{{ route('front.speakers.index') }}">{{ __('site.menus.Speakers')}}</a>
                                    </li>
                                    <li class="menu-item {{ Request::routeIs('front.certificates.*') ? 'active' : '' }} menu-item-has-children wow fadeInUp animated" data-wow-delay="0.4s">
                                        <a href="{{ route('front.certificates.index') }}">{{ __('site.menus.Certificate')}}</a>
                                    </li>
                                    
                                    
                                    
                                    <li class="menu-item {{ Request::routeIs('front.marketplace.*') ? 'active' : '' }} menu-item-has-children mega-menu mega-menu-col-2 wow fadeInUp animated" data-wow-delay="0.8s">
                                        <a href="{{ route('front.marketplace.index') }}">{{ __('site.menus.Marketplace')}}</a>
                                    </li>

                                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.5s">
                                        <a class="inno-cursor">{{__('site.menus.Youngs')}}</a>
                                        <ul class="sub-menu menu-w">
                                            <li class="menu-item"><a target="_blank" href="https://urbantech.uz/">Xakaton 2024</a></li>
                                            <li class="menu-item"><a href="{{ route('front.competition.fest') }}">{{ __('site.competition.fest')}}</a></li>
                                        </ul>
                                    </li>

                                    <li class="menu-item {{ Request::routeIs('front.live.*') ? 'active' : '' }} menu-item-has-children wow fadeInUp animated" data-wow-delay="0.4s">
                                        <a href="{{ route('front.live.online') }}">LIVE</a>
                                    </li>
                                </ul>
                            </nav>
                            <nav id="dropdown" class="template-main-menu menu-text-light d-flex align-items-center justify-content-center">
                                <ul class="menu">
                                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.9s">
                                        <a href="javascript:void(0);" class="d-flex align-items-center justify-content-center inno-cursor">
                                            <img class="mx-2" width="30" src="{{ asset('/front/image/'.\App::getLocale().'.png') }}" alt="">
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-menu menu-color">
                                            <li class="menu-item text-center">
                                                <a href="{{ route('change.locale', ['locale' => 'uz']) }}"><img class="mx-2" width="30" src="{{ asset('/front/image/uz.png') }}" alt=""></a>
                                            </li>
                                            <li class="menu-item text-center">
                                                <a href="{{ route('change.locale', ['locale' => 'en']) }}"><img class="mx-2" width="30" src="{{ asset('/front/image/en.png') }}" alt=""></a>
                                            </li>
                                            <li class="menu-item text-center">
                                                <a href="{{ route('change.locale', ['locale' => 'ru']) }}"><img class="mx-2" width="30" src="{{ asset('/front/image/ru.png') }}" alt=""></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="header-action-items">
                                    <li class="header-action-item d-none d-xl-block wow fadeInUp animated" data-wow-delay="1s">
                                        <button type="button" class="item-btn btn-fill style-one offcanvas-menu-btn style-one menu-status-open">
                                            {{ __('site.menus.Registration')}}
                                        </button>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>