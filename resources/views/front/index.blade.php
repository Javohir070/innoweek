@extends('layouts.front')
@section('head_title', trans('site.International Week of Innovative Ideas'))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<section class="rt-header-menu hero-wrap-layout1">
  <div class="slider_vedio">
    <video autoplay loop muted plays-inline>
      <source src="{{ asset('/front/video/background inno.mp4h') }}">
    </video>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="inner_slider_content wow fadeInUp animated" data-wow-delay="1s">
          <h2>{!! __('site.InnoWeek Slug') !!}</h2>
          <div class="txbdlist">
            <ul>
              <li><a href="#"><i class="icofont-circled-right"></i>{{ __('site.InnoWeek Date')}} </a></li>
              <li><a href="#"><i class="icofont-circled-right"></i> {{ __('site.Address Location') }}</a>
              </li>
            </ul>
          </div>
          <div class="b_btn">
            <a href="#about">{{__('site.About InnoWeek')}}<i class="icofont-plus"></i></a>
            <a class="active offcanvas-menu-btn style-one menu-status-open" href="#">{{__('site.menus.Registration')}} <i class="icofont-ui-play"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="countdown-wrap-layout1 wow fadeInUp animated" data-wow-delay="1.7s" data-wow-duration="1s">
  <div class="event-countdown ec-1">
    <div class="event-countdown-wrap">
      <div data-countdown="2025/10/09" class="event-countdown"></div>
    </div>
    <div class="event-countdown-text">
      <span>INNOWEEK</span>
    </div>
  </div>
</section>

<section id="about">
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
              <span class="site-title-tagline">INNOWEEK</span>
              <h2 class="site-title">
                {!! __('site.About.About Title') !!}
              </h2>
              <div class="site-shadow-text wow fadeInRight" data-wow-delay=".35s">2025</div>
            </div>
            <p class="about-text">{{ getSiteInfo('description_'.\App::getLocale())}}</p>
            <a href="{{ route('front.menu.about') }}" class="theme-btn btn-theme mt-3">{{ __('site.About.More')}}<i class="fas fa-arrow-right"></i></a>
            <a target="_blank" href="{{ asset(getSiteInfo('file_2')) }}" class="theme-btn btn-theme mt-3">{{ __('site.About.File 1')}} <i class="fas fa-file-pdf"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid statistika px-0">
    <div class="static-content" style="background-image: url({{ asset('/front/image/sponsor.jpg') }});">
      <div class="container">
        <div class="row mt-3 py-5">
          <div class="col-md-2 col-6 text-center">
            <img src="{{ asset('/front/image/svg/area-oq.svg') }}" width="50" alt="">
            <h4 class="text-white my-4">{{__('site.Stats.Area')}}</h4>
            <h2 class="text-white">10 000 m <sup>2</sup></h2>
          </div>
          <div class="col-md-2 col-6 text-center">
            <img src="{{ asset('/front/image/svg/visitor-oq.svg') }}" width="50" alt="">
            <h4 class="text-white my-4">{{__('site.Stats.Visitors')}}</h4>
            <h2 class="text-white">11k+</h2>
          </div>
          <div class="col-md-2 col-6 text-center">
            <img src="{{ asset('/front/image/svg/startup-oq.svg') }}" width="50" alt="">
            <h4 class="text-white my-4">{{__('site.Stats.Startups')}}</h4>
            <h2 class="text-white">100+</h2>
          </div>
          <div class="col-md-2 col-6 text-center">
            <img src="{{ asset('/front/image/svg/exhibitor-oq.svg') }}" width="50" alt="">
            <h4 class="text-white my-4">{{__('site.Stats.Exhibitors')}}</h4>
            <h2 class="text-white">500+</h2>
          </div>
          <div class="col-md-2 col-6 text-center">
            <img src="{{ asset('/front/image/svg/countries-oq.svg') }}" width="50" alt="">
            <h4 class="text-white my-4">{{__('site.Stats.Countries')}}</h4>
            <h2 class="text-white">10+</h2>
          </div>
          <div class="col-md-2 col-6 text-center">
            <img src="{{ asset('/front/image/svg/media-oq.svg') }}" width="50" alt="">
            <h4 class="text-white my-4">{{__('site.Stats.Media')}}</h4>
            <h2 class="text-white">10+</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- News -->
<div class="blog-area py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
          <h2 class="site-title"><br> <span>{{ __('site.News.News')}}</span></h2>
        </div>
      </div>
    </div>
    <div class="row g-4">
      @foreach ($news as $item)
          <div class="col-md-6 col-lg-4">
            <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
              <span class="blog-date">{{ \Carbon\Carbon::parse($item->created_at)->format('d  M')}}</span>
              <a href="{{ route('front.news.detail', ['id'=> $item->id]) }}">
                <div class="blog-item-img">
                  <img src="{{asset('/upload/news/' . $item->image.'_big_720.png')}}" width='400' height="250" alt="Thumb">
                </div>
              </a>
              <div class="blog-item-info">
                <h4 class="blog-title">
                  <a href="{{ route('front.news.detail', ['id'=> $item->id]) }}">{{$item->title}}</a>
                </h4>
                <a class="theme-btn" href="{{ route('front.news.detail', ['id'=> $item->id]) }}">{{ __('site.News.More')}}<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
      <a class="theme-btn" href="{{ route('front.menu.news') }}">{{__('site.News.All News')}}<i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</div>

<!-- Speakers -->
<div class="team-area py-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
          <span class="site-title-tagline">{{__('site.Speakers.Speakers')}}</span>
          <h2 class="site-title">{!! __('site.Speakers.Speakers Slug') !!}</h2>
          <div class="site-shadow-text">{{__('site.Speakers.Speakers')}}</div>
        </div>
      </div>
    </div>
    <div class="row g-4 wow fadeInUp" data-wow-delay=".25s">
      @foreach ($speakers as $item)
          <div class="col-6 col-md-3 col-lg-3">
            <div class="team-item">
              <div class="team-img">
                <img src="{{ asset($item->image) }}" alt="{{ $item->full_name }}">
              </div>
              <div class="team-content">
                <div class="social">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-x-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="info">
                  <h4><a href="#">{{ $item->full_name }}
                    </a></h4>
                  <span>{{ $item->position }}</span>
                </div>
              </div>
            </div>
          </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
      <a class="theme-btn" href="{{ route('front.speakers.index') }}">{{ __('site.Speakers.All Speakers') }}<i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</div>

<!-- Gallery section-->
<div id="gallery" class="gallery-wrap-layout3">
  <div class="row">
    <div class="col-lg-12">
      <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
        <span class="site-title-tagline">{{ __('site.Gallery.Galleries')}}</span>
        <h2 class="site-title">{!! __('site.Gallery.Gallery Slug') !!}</h2>
        <div class="site-shadow-text wow fadeInRight" data-wow-delay=".35s">{{ __('site.Gallery.Galleries')}}</div>
      </div>
    </div>
  </div>
  <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{__('site.Gallery.Photos')}}</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('site.Gallery.Videos')}}</button>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <div class="container ps-0 pe-0">
        <div class="row">
          @foreach ($photo_galleries as $item)
              <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                <div class="gallery-box-layout3 has-animation">
                  <a href="{{ asset($item->image) }}" class="rt-mfp-gallery-item"><img class="galery-img" src="{{ asset($item->image) }}" alt="Foto" width="900" height="780"></a>
                </div>
              </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <div class="container ps-0 pe-0">
        <div class="row">
          @foreach ($video_galleries as $item)
          <div class="col-xl-3 col-md-4 col-sm-6 col-12">
            <div class="gallery-box-layout3 has-animation">
              <a target="_blank" href="{{'https://www.youtube.com/watch?v='. $item->youtube_url}}" class="rt-video">
                <img class="galery-img" src="https://img.youtube.com/vi/{{$item->youtube_url}}/hqdefault.jpg" alt="Video galereya" width="900" height="780">
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
  </div>
</div>

<!-- Events -->
<div class="schedule-area py-120" id="events">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
          <span class="site-title-tagline">{{ __('site.Schedule.Schedules')}}</span>
          <h2 class="site-title">{!! __('site.Schedule.Schedule Slug') !!}</h2>
          <div class="site-shadow-text">{{ __("site.Schedule.Schedule")}}</div>
        </div>
      </div>
    </div>
    <div class="schedule-nav wow fadeInUp" data-wow-delay=".25s">
      <ul class="nav nav-pills" id="pills-tab-schedule" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-schedule-tab1" data-bs-toggle="pill" data-bs-target="#pills-schedule1" type="button" role="tab" aria-controls="pills-schedule1" aria-selected="true">
            <span class="icon" style="border: none;">
              <i class="fa-regular fa-calendar-days"></i>
            </span>
            <span class="content">
              <span class="day">{{ __('site.Schedule.Day 1')}}</span>
              <span class="date">{{ __('site.Schedule.November')}} 9, 2025</span>
            </span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-schedule-tab2" data-bs-toggle="pill" data-bs-target="#pills-schedule2" type="button" role="tab" aria-controls="pills-schedule2" aria-selected="false">
            <span class="icon" style="border: none;">
              <i class="fa-regular fa-calendar-days"></i>
            </span>
            <span class="content">
              <span class="day">{{ __('site.Schedule.Day 2')}}</span>
              <span class="date">{{ __('site.Schedule.November')}} 10, 2025</span>
            </span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-schedule-tab3" data-bs-toggle="pill" data-bs-target="#pills-schedule3" type="button" role="tab" aria-controls="pills-schedule3" aria-selected="false">
            <span class="icon" style="border: none;">
              <i class="fa-regular fa-calendar-days"></i>
            </span>
            <span class="content">
              <span class="day">{{ __('site.Schedule.Day 3')}}</span>
              <span class="date">{{ __('site.Schedule.November')}} 11, 2025</span>
            </span>
          </button>
        </li>
      </ul>
    </div>
    <div class="tab-content wow fadeInUp" data-wow-delay=".25s" id="pills-tabContent-schedule">

      <div class="tab-pane fade show active" id="pills-schedule1" role="tabpanel" aria-labelledby="pills-schedule-tab1" tabindex="0">
        <div class="row g-4">
          @foreach ($schedule_day_1 as $k => $item)
              <div class="col-lg-12">
                <div class="schedule-item @if(($k+1) == count($schedule_day_1)) last @endif">
                  <span class="schedule-count">@if($k <= 10) 0{{ $k+1}} @else {{ $k+1}} @endif</span>
                  <div class="schedule-content-wrap">
                    <div class="schedule-content">
                      <div class="schedule-info">
                        <div class="schedule-meta">
                          <ul>
                            <li><i class="far fa-clock"></i> {{ $item->started_at }} - {{ $item->stopped_at}}</li>
                            <li><i class="fa-solid fa-location-dot"></i>{{ $item->address }}</li>
                          </ul>
                        </div>
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->description }}</p>
                      </div>
                      <div class="schedule-bottom">
                        <a href="javascript::void(0);" onclick="storeEventMember({{ $item->id }})" class="theme-btn">{{ __('site.Registration.Participation')}}<i class="fas fa-arrow-right"></i></a>
                      </div>
                      {{-- speakers here --}}
                    </div>
                  </div>
                </div>
              </div>
          @endforeach
        </div>
      </div>

      <div class="tab-pane fade" id="pills-schedule2" role="tabpanel" aria-labelledby="pills-schedule-tab2" tabindex="0">
        <div class="row g-4">
          @foreach ($schedule_day_2 as $k => $item)
          <div class="col-lg-12">
            <div class="schedule-item @if(($k+1) == count($schedule_day_1)) last @endif">
              <span class="schedule-count">@if($k >= 10) {{ $k+1}} @else 0{{ $k+1}} @endif</span>
              <div class="schedule-content-wrap">
                <div class="schedule-content">
                  <div class="schedule-info">
                    <div class="schedule-meta">
                      <ul>
                        <li><i class="far fa-clock"></i> {{ $item->started_at }} - {{ $item->stopped_at}}</li>
                        <li><i class="fa-solid fa-location-dot"></i>{{ $item->address }}</li>
                      </ul>
                    </div>
                    <h4>{{ $item->title }}</h4>
                    <p>{{ $item->description }}</p>
                  </div>
                  <div class="schedule-bottom">
                    {{-- <a href="javascript::void(0);" onclick="storeEventMember({{ $item->id }})" class="theme-btn">{{ __('site.Registration.Participation')}}<i class="fas fa-arrow-right"></i></a> --}}
                  </div>
                  {{-- speakers here --}}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="tab-pane fade" id="pills-schedule3" role="tabpanel" aria-labelledby="pills-schedule-tab3" tabindex="0">
        <div class="row g-4">
          @foreach ($schedule_day_3 as $k => $item)
              <div class="col-lg-12">
                <div class="schedule-item @if(($k+1) == count($schedule_day_1)) last @endif">
                  <span class="schedule-count">0{{ $k+1}}</span>
                  <div class="schedule-content-wrap">
                    <div class="schedule-content">
                      <div class="schedule-info">
                        <div class="schedule-meta">
                          <ul>
                            <li><i class="far fa-clock"></i> {{ $item->started_at }} - {{ $item->stopped_at}}</li>
                            <li><i class="fa-solid fa-location-dot"></i>{{ $item->address }}</li>
                          </ul>
                        </div>
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->description }}</p>
                      </div>
                      <div class="schedule-bottom">
                        {{-- <a href="javascript::void(0);" onclick="storeEventMember({{ $item->id }})" class="theme-btn">{{ __('site.Registration.Participation')}}<i class="fas fa-arrow-right"></i></a> --}}
                      </div>
                      {{-- speakers here --}}
                    </div>
                  </div>
                </div>
              </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<div class="counter-area pt-80 pb-80">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-5">
        <div class="counter-info">
          <div class="site-heading mb-3">
            <span class="site-title-tagline text-white">{{ __('site.Stats.Fact')}}</span>
            <h2 class="site-title text-white">
              {{ __('site.Stats.Fact Slug')}}
            </h2>
          </div>
          <p class="text-white">
            {{ __('site.Stats.Fact Desc')}}
          </p>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="row g-4 justify-content-center">
          <div class="col-md-6">
            <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
              <div class="icon">
                <img src="{{ asset('/front/image/icon/workshop.svg') }}" alt>
              </div>
              <div class="counter-content">
                <div class="counter-info">
                  <span class="counter" data-count="+" data-to="150" data-speed="3000">800</span>
                  <span class="counter-unit">+</span>
                </div>
                <h6 class="title">{{ __('site.Stats.Unique Projects')}}</h6>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
              <div class="icon">
                <img src="{{ asset('/front/image/icon/participant.svg') }}" alt>
              </div>
              <div class="counter-content">
                <div class="counter-info">
                  <span class="counter" data-count="+" data-to="260" data-speed="3000">10000</span>
                  <span class="counter-unit">+</span>
                </div>
                <h6 class="title">{{ __('site.Stats.Event Exhibitors')}}</h6>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
              <div class="icon">
                <img src="{{ asset('/front/image/icon/speaker-2.svg') }}" alt>
              </div>
              <div class="counter-content">
                <div class="counter-info">
                  <span class="counter" data-count="+" data-to="120" data-speed="3000">50</span>
                  <span class="counter-unit">+</span>
                </div>
                <h6 class="title">{{ __('site.Stats.Skilled Speakers')}}</h6>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
              <div class="icon">
                <img src="{{ asset('/front/image/icon/award.svg') }}" alt>
              </div>
              <div class="counter-content">
                <div class="counter-info">
                  <span class="counter" data-count="+" data-to="50" data-speed="3000">50</span>
                  <span class="counter-unit">+</span>
                </div>
                <h6 class="title">{{ __('site.Stats.Winners')}}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Application -->
<div class="faq-area py-120">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <img src="{{ asset('/front/image/phone/mobile-black.png') }}" alt="">
      </div>
      <div class="col-lg-7">
        <div class="accordion wow fadeInRight" data-wow-delay=".25s" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseTwo">
                <span><img src="{{ asset('/front/image/phone/1.registration.png') }}" alt=""></span>
                {{ __('site.Register Online')}}
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                {{ __('site.Register Online Desc')}}
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <span><img src="{{ asset('/front/image/phone/2.pass.png') }}" alt=""></span>{{ __('site.Get Electronic Ticket')}}
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                {{__('site.Get Electronic Ticket Desc')}}
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <span><img src="{{ asset('/front/image/phone/3.360-degree.png') }}" alt=""></span>
                {{ __('site.Online 360 Events')}}
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                {{ __('site.Online 360 Events Desc')}}
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <span><img src="{{ asset('/front/image/phone/4.notifications.png') }}" alt=""></span>{{ __('site.Push Notifications')}}
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                {{ __('site.Push Notifications Desc')}}
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFour">
                <span><img src="{{ asset('/front/image/phone/5.app-store.png') }}" alt=""></span>{{__('site.For Mobile')}}
              </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                {{__('site.For Mobile Desc')}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 d-flex align-items-center mt-7 flex-column">
        <img src="{{ asset('/front/image/phone/QR_icon.svg.png') }}" alt="">
        <img src="{{ asset('/front/image/phone/googleplay.png') }}" alt="">
      </div>
    </div>
  </div>
</div>

<!-- Contact -->
<div class="contact-area mt-5">
  <div class="container">
    <div class="contact-content">
      <div class="row">
        <div class="col-md-4">
          <div class="contact-info">
            <div class="contact-info-icon">
              <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div class="contact-info-content">
              <h5>{{__('site.Address')}}</h5>
              <p>{{__('site.Address Location')}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="contact-info">
            <div class="contact-info-icon">
              <i class="fa-solid fa-phone-volume"></i>
            </div>
            <div class="contact-info-content">
              <h5>{{__('site.Contact')}}</h5>
              <p>{{__('site.Contact Phone')}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="contact-info">
            <div class="contact-info-icon">
              <i class="fa-regular fa-envelope"></i>
            </div>
            <div class="contact-info-content">
              <h5>{{__('site.Email')}}</h5>
              <p><a href="email:info@innoweek.uz" class="__cf_email__" data-cfemail="721b1c141d32170a131f021e175c111d1f">info@innoweek.uz</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Become a sponsor -->
<div class="container-fluid px-0">
  <div class="bannerr-content" style="background-image: url({{ asset('/front/image/sponsor.jpg') }});">
    <div class="container">
      <div class="row align-items-center py-5">
        <div class="bannerr-wrapper">
          <p class="bannerr-title text-white text-center">{{ __('site.Sponsor Us')}}</p>
          <p class="bannerr-desc text-white text-center mt-5">{{ __('site.Sponsor Us Desc')}}</p>
          <div class="d-flex justify-content-center">
            <button type="button" class="bannerr-btn btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
              {{ __('site.Become A Sponsor')}}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Partners -->
<!-- <div class="partner-area partner-bg py-80">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
          <span class="site-title-tagline">{{__('site.Sponsors')}}</span>
          <h2 class="site-title">{!! __('site.Sponsors Slug') !!}</h2>
        </div>
      </div>
    </div>
    <div class="partner-wrapper wow fadeInUp" data-wow-delay=".25s">
      <div class="row g-5 justify-content-center">
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/1.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/11.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/13.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/14.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/16.png') }}" alt="thumb">
        </div>

        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/4.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/5.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/6.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/15.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/18.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/19.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/20.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/21.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/22.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/23.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/7.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/8.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/9.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/24.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/10.png') }}" alt="thumb">
        </div>
        <div class="col-6 col-md-2">
          <img src="{{ asset('/upload/partners/12.png') }}" alt="thumb">
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hamkor bo'lish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Email: info@innoweek.uz</p>
        <p>Tel: +998 89 820 11 10</p>
      </div>
      <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
    </div>
  </div>
</div>
@endsection
