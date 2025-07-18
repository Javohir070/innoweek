<div class="rt-header-menu mean-container" id="meanmenu">
    <div class="mean-bar">
        <a href="{{ route('front.home') }}">
            <img src="{{ asset('/front/image/logo.webp') }}" alt="INNOWEEK" width="80">
        </a>

        <nav id="dropdown" class="template-main-menu menu-text-light d-flex align-items-center justify-content-center">
            <ul class="menu">
                <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.9s">
                    <a href="javascript:void(0);" class="d-flex align-items-center justify-content-center inno-cursor">
                        <img class="mx-2" width="30" src="{{ asset('/front/image/'.\App::getLocale().'.png') }}" alt="">
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="sub-menu menu-color">
                        <li class="menu-item text-center" style="background-color: blue;">
                            <a href="{{ route('change.locale', ['locale' => 'uz']) }}"><img class="mx-2" width="30" src="{{ asset('/front/image/uz.png') }}" alt=""></a>
                        </li>
                        <li class="menu-item text-center" style="background-color: blue;">
                            <a href="{{ route('change.locale', ['locale' => 'en']) }}"><img class="mx-2" width="30" src="{{ asset('/front/image/en.png') }}" alt=""></a>
                        </li>
                        <li class="menu-item text-center" style="background-color: blue;">
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
        

        <span class="sidebarBtn">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </span>
    </div>
    <div class="rt-slide-nav Down">
        <div class="offscreen-navigation">
            <nav class="menu-main-primary-container">
                <ul class="menu">
                    <li class="list {{ Request::routeIs('front.home') ? 'active-link' : '' }}">
                        <a href="{{ route('front.home') }}">{{ __('site.menus.Home')}}</a>
                    </li>
                    <li class="list {{ Request::routeIs('front.live') ? 'active-link' : '' }}">
                        <a href="{{ route('front.live.online') }}">{{ __('LIVE')}}</a>
                    </li>
                    <li class="list {{ Request::routeIs('front.menu') ? 'active-link' : '' }}">
                        <a href="{{ route('front.menu.about') }}">{{ __('site.menus.About Us')}}</a>
                    </li>
                    <li class="list">
                        <a target="_blank" href="{{ asset(getSiteInfo('file_1_'.\App::getLocale())) }}">{{ __('site.menus.InnoWeek Program File 1')}}</a>
                    </li>
                    <li class="list">
                        <a target="_blank" href="{{ asset(getSiteInfo('file_2_'.\App::getLocale())) }}">{{ __('site.menus.InnoWeek Program File 2')}}</a>
                    </li>
                    <li class="list">
                        <a href="{{ route('front.home') }}#gallery">{{ __('site.menus.Photo Gallery')}}</a>
                    </li>
                    <li class="list {{ Request::routeIs('front.speakers.index') ? 'active-link' : '' }}">
                        <a href="{{ route('front.speakers.index') }}">{{ __('site.menus.Speakers')}}</a>
                    </li>
                    <li class="list {{ Request::routeIs('front.certificates.index') ? 'active-link' : '' }}">
                        <a href="{{ route('front.certificates.index') }}">{{ __('site.menus.Certificate')}}</a>
                    </li>
                    <li class="list {{ Request::routeIs('front.marketplace.index') ? 'active-link' : '' }}">
                        <a href="{{ route('front.marketplace.index') }}">{{ __('site.menus.Marketplace')}}</a>
                    </li>
                    <li class="list">
                        <a target="_blank" href="https://urbantech.uz/">Xakaton 2024</a>
                    </li>
                    <li class="list {{ Request::routeIs('front.competition.fest') ? 'active-link' : '' }}">
                        <a href="{{ route('front.competition.fest') }}">{{ __('site.competition.fest')}}</a>
                    </li>
                    
                </ul>
            </nav>
            
        </div>
    </div>
</div>