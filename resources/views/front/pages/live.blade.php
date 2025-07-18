@extends('layouts.front')
@section('head_title', trans("site.About.Title"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">LIVE</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{__('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{ __('LIVE')}}</li>
    </ul>
  </div>
</div>
<div class="team-area py-100 onlinee">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-12 live-static">
                            <div class="row">
                                <div class="col-12">
                                  <iframe width="100%" height="712" src="https://www.youtube.com/embed/x2S8-yaavmQ?si=WozVlK1DwiAXYA4P" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
