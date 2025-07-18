@extends('layouts.front')
@section('head_title', trans("site.News.News"). ' | '. $news->title)
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{__('site.News.News')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{__('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{__('site.News.News')}}</li>
    </ul>
  </div>
</div>

<div class="blog-single py-120">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="blog-single-wrapper">
          <div class="blog-single-content">
            <div class="blog-thumb-img">
              <img src="{{asset('/upload/news/' . $news->image.'_big_720.png')}}" height="350px" width="100%" alt="{{ $news->title }}">
            </div>
            <div class="blog-info">
              <div class="blog-meta">
                
              </div>
              <div class="blog-details">
                <h3 class="blog-details-title mb-20">{{ $news->title }}</h3>
               {!! $news->text !!}
              </div>
            </div>
          </div>
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
@endsection