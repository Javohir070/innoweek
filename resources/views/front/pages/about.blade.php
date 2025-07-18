@extends('layouts.front')
@section('head_title', trans("site.About.Title"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{__('site.About.Title')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{__('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{ __('site.About.Title')}}</li>
    </ul>
  </div>
</div>
<div class="blog-area ">
  <div class="about-area pb-120 pbx-120" id="about">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="about-left wow fadeInRight" data-wow-delay=".25s">
            <div class="about-img">
              <img src="{{ asset('/front/image/flag-uzb.png') }}" alt="">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-right wow fadeInLeft" data-wow-delay=".25s">
            <div class="site-heading mb-3">
              <span class="site-title-tagline">INNOWEEK.UZ</span>
              <p class="about-text">{{ getSiteInfo('description_'.\App::getLocale())}}</p>
            <a target="_blank" href="{{ asset(getSiteInfo('file_2_'.\App::getLocale())) }}" class="theme-btn btn-theme mt-3">{{ __('site.About.File 1')}}<i class="fas fa-file-pdf"></i></a>
            <a target="_blank" href="{{ asset(getSiteInfo('file_1_'.\App::getLocale())) }}" class="theme-btn btn-theme mt-3">{{__('site.About.File 2')}}<i class="fas fa-file-pdf"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Promo -->
  <div class="video-area">
    <div class="container-fluid px-0">
      <div class="video-content pb-50" style="background-image: url({{ asset('/front/image/promo.jpg') }});">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <div class="video-info">
                <div class="site-heading mb-0">
                  <span class="site-title-tagline text-white">Promo</span>
                  <h2 class="site-title text-white">
                    <span>Innoweek</span> 2024
                  </h2>
                </div>
                {{-- <a href="#" class="theme-btn mt-30">Batafsil <i class="fas fa-arrow-right"></i></a> --}}
              </div>
            </div>
            <div class="col-lg-4">
              <div class="video-wrapper">
                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=oR5OvcFKZak">
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="feature-area fa-negative">
    <div class="container">
      <div class="feature-wrapper">
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
              <span class="count">01</span>
              <div class="feature-icon">
                <img src="{{ asset('/front/image/favicon.ico') }}" alt>
              </div>
              <h4 class="feature-title">Innoweek 2023</h4>
              <p>14-16 - noyabr 2024</p>
              <div class=" promo-videos">
                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=oR5OvcFKZak">
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
              <span class="count">02</span>
              <div class="feature-icon">
                <img src="{{ asset('/front/image/favicon.ico') }}" alt>
              </div>
              <h4 class="feature-title">Innoweek 2022</h4>
              <p>17-21 - oktyabr 2023</p>
              <div class=" promo-videos">
                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=GlMzaGahQYQ">
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
              <span class="count">03</span>
              <div class="feature-icon">
                <img src="{{ asset('/front/image/favicon.ico') }}" alt>
              </div>
              <h4 class="feature-title">Innoweek 2021</h4>
              <p>22-27-noyabr 2022</p>
              <div class=" promo-videos">
                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=AHtW5Xi6Md0">
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
              <span class="count">04</span>
              <div class="feature-icon">
                <img src="{{ asset('/front/image/favicon.ico') }}" alt>
              </div>
              <h4 class="feature-title">Innoweek 2020</h4>
              <p>3-8 noyabr 2021</p>
              <div class=" promo-videos">
                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=oR5OvcFKZak">
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
