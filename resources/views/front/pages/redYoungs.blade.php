@extends('layouts.front')
@section('head_title', trans("site.competition.fest"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{__('site.competition.fest')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{__('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{ __('site.competition.fest')}}</li>
    </ul>
  </div>
</div>
<div class="blog-area ">
  <div class="about-area pb-120 pbx-120" id="about">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12">
          <div class="about-right wow fadeInLeft" data-wow-delay=".25s">
            <div class="site-heading">
              <span class="site-title-tagline text-center">{{ __('site.competition.slug') }}</span>
              <p class="about-text h4">{!! __('site.competition.description') !!}</p>
          </div>
           <div class="site-heading mb-3 text-center">
            {{-- <a target="_blank" href="https://forms.gle/opghAf4N8BBxMvHZ6" class="theme-btn btn-md btn-theme mt-3">{{ __('site.Register Online')}}<i class="fas fa-link"></i></a>
            <br> --}}
            <a target="_blank" href="{{ asset('/upload/competition/program_'. \App::getLocale().'.pdf') }}" class="theme-btn btn-theme mt-3">{{__('site.competition.Show Program')}}<i class="fas fa-file-pdf"></i></a>
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
            <div class="col-lg-6">
              <div class="video-info">
                <div class="site-heading mb-0">
                  <span class="site-title-tagline text-white">Promo</span>
                  <h2 class="site-title text-white">
                    {!! __('site.competition.Promo Title') !!}
                  </h2>
                </div>
                {{-- <a href="#" class="theme-btn mt-30">Batafsil <i class="fas fa-arrow-right"></i></a> --}}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="video-wrapper">
                <iframe style="width: 100%; height: auto;" src="https://www.youtube.com/embed/sIDjsOCDgRo" title="R:ED Fest робототехника мусобақаси" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                {{-- <a class="play-btn popup-youtube" class="font-size: 1rem;" href="https://www.youtube.com/watch?v=sIDjsOCDgRo">
                  <i class="fas fa-play"></i>
                </a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
