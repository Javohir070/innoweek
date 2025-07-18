@extends('layouts.front')
@section('head_title', trans("site.Speakers.Speakers"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{__('site.Speakers.Speakers')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{__('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{ __('site.Speakers.Speakers List')}}</li>
    </ul>
  </div>
</div>

<div class="team-area py-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
          <span class="site-title-tagline">{{ __('site.Speakers.Speakers')}}</span>
          <h2 class="site-title">{!! __('site.Speakers.Our Speakers Slug') !!}</h2>
          <div class="site-shadow-text">{{ __('site.Speakers.Speakers List')}}</div>
        </div>
      </div>
    </div>
    <div class="row g-4 wow fadeInUp" data-wow-delay=".25s">
      @foreach ($speakers as $item)
          <div class="col-6 col-md-3 col-lg-3">
            <div class="team-item">
              <div class="team-img">
                <img src="{{ asset($item->image) }}"  alt="{{$item->full_name}}">
              </div>
              <div class="team-content">
                <div class="social">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-x-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="info">
                  <h4><a href="javascript:void(0)">{{ $item->full_name }}</a></h4>
                  <span>{{ $item->position }}</span>
                </div>
              </div>
            </div>
          </div>
      @endforeach
    </div>
  </div>
</div>
@endsection