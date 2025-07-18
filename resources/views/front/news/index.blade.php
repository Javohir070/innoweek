@extends('layouts.front')
@section('head_title', trans("site.News.News"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{ __('site.News.News')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{ __('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{__('site.News.News')}}</li>
    </ul>
  </div>
</div>

<div class="blog-area py-120">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
          <div class="site-shadow-text wow fadeInRight" data-wow-delay=".35s">{{__('site.News.News')}}</div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="row g-4">
            @foreach ($news as $item)
                <div class="col-md-6 col-lg-6">
                  <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                    <span class="blog-date">{{ \Carbon\Carbon::parse($item->created_at)->format('d  M')}}</span>
                    <a href="{{ route('front.news.detail', ['id'=> $item->id]) }}">
                      <div class="blog-item-img">
                        <img src="{{asset('/upload/news/' . $item->image.'_big_720.png')}}" width='400' height="250" alt="{{$item->title}}">
                      </div>
                    </a>
                    <div class="blog-item-info">
                      <h4 class="blog-title">
                        <a href="{{ route('front.news.detail', ['id'=> $item->id]) }}">{{$item->title}}</a>
                      </h4>
                      <a class="theme-btn" href="{{ route('front.news.detail', ['id'=> $item->id]) }}">{{__('site.News.More')}}<i class="fas fa-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
            @endforeach
          </div>
          <div class="pagination-area">
            
          </div>
        </div>
        <div class="col-lg-4">
          <aside class="sidebar">

            <div class="widget category">
              <h5 class="widget-title">{{__('site.News.Categories')}}</h5>
              <div class="category-list">
                @foreach ($categories as $item)
                    <a href="{{ route('front.menu.news', ['category'=> $item->id ]) }}"><i class="fa-solid fa-arrow-right"></i>{{ $item->title }}<span></span></a>
                @endforeach
              </div>
            </div>
            
            
          </aside>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection