@extends('layouts.front')
@section('head_title', trans("site.Marketplace.Title"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{__('site.Marketplace.Marketplace')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{__('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{__('site.Marketplace.Title')}}</li>
    </ul>
  </div>
</div>
<div class="blog-single py-120">
  <div class="container">
    <div class="blog-single-wrapper">
      <div class="market-box mt-4">
        
        <div class="blog-meta">
          <div class="blog-meta-left">
            <ul>
              <li><i class="fas fa-tags"></i> <strong>{{__('site.Marketplace.Startup Projects')}}</strong> </li>
            </ul>
          </div>
          <div class="blog-meta-right">
            <a href="{{ route('front.marketplace.projectTypeList', ['type_id'=> 1]) }}" class="share-link">{{__('site.Marketplace.Show More')}} <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="row mt-4">
          @foreach ($startup_projects as $item)
          <div class="col-md-3">
            <img src="{{ asset($item->image->image_url) }}" alt="{{ $item->title }}" style="width: 400px; height: 250px; overflow-clip-margin: content-box; content-box; clip; border: #041A57 solid 1px; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);">
            <a href="{{ route('front.marketplace.projectInfo', ['id'=> $item->id]) }}" title="{{ $item->title }}">
              <h4 class="mt-2">{{ Str::limit($item->title, 57, '...') }}</h4>
            </a>
            <div class="row">
              <div class="col-md-1">
                <i class="fa-regular fa-user"></i>
                <i class="fa-brands fa-font-awesome"></i>
                <i class="fa-solid fa-calendar-days"></i>
              </div>
              <div class="col-md-11">
                <p>{{ Str::limit($item->author->company_name ?? "Tashkilot ko'rsatilmagan", 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->category->name_uz, 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->project_type->name_uz, 22, '...') }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="blog-meta mt-4">
          <div class="blog-meta-left">
            <ul>
              <li><i class="fas fa-tags"></i> <strong>{{__('site.Marketplace.Commercialization Projects')}}</strong> </li>
            </ul>
          </div>
          <div class="blog-meta-right">
            <a href="{{ route('front.marketplace.projectTypeList', ['type_id'=> 2]) }}" class="share-link">{{__('site.Marketplace.Show More')}} <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="row mt-4">
          @foreach ($commercial_projects as $item)
          <div class="col-md-3">
            <img src="{{ asset($item->image->image_url) }}" alt="{{ $item->title }}" style="width: 400px; height: 250px; overflow-clip-margin: content-box; content-box; clip; border: #041A57 solid 1px; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);">
            <a href="{{ route('front.marketplace.projectInfo', ['id'=> $item->id]) }}" title="{{ $item->title }}">
              <h4 class="mt-2">{{ Str::limit($item->title, 57, '...') }}</h4>
            </a>
            <div class="row">
              <div class="col-md-1">
                <i class="fa-regular fa-user"></i>
                <i class="fa-brands fa-font-awesome"></i>
                <i class="fa-solid fa-calendar-days"></i>
              </div>
              <div class="col-md-11">
                <p>{{ Str::limit($item->author->company_name ?? "Tashkilot ko'rsatilmagan", 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->category->name_uz, 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->project_type->name_uz, 22, '...') }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="blog-meta mt-4">
          <div class="blog-meta-left">
            <ul>
              <li><i class="fas fa-tags"></i> <strong>{{__('site.Marketplace.Scientific projects')}}</strong> </li>
            </ul>
          </div>
          <div class="blog-meta-right">
            <a href="{{ route('front.marketplace.projectTypeList', ['type_id'=> 4]) }}" class="share-link">{{__('site.Marketplace.Show More')}} <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="row mt-4">
          @foreach ($science_projects as $item)
          <div class="col-md-3">
            <img src="{{ asset($item->image->image_url) }}" alt="{{ $item->title }}" style="width: 400px; height: 250px; overflow-clip-margin: content-box; content-box; clip; border: #041A57 solid 1px; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);">
            <a href="{{ route('front.marketplace.projectInfo', ['id'=> $item->id]) }}" title="{{ $item->title }}">
              <h4 class="mt-2">{{ Str::limit($item->title, 57, '...') }}</h4>
            </a>
            <div class="row">
              <div class="col-md-1">
                <i class="fa-regular fa-user"></i>
                <i class="fa-brands fa-font-awesome"></i>
                <i class="fa-solid fa-calendar-days"></i>
              </div>
              <div class="col-md-11">
                <p>{{ Str::limit($item->author->company_name ?? "Tashkilot ko'rsatilmagan", 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->category->name_uz, 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->project_type->name_uz, 22, '...') }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="blog-meta mt-4">
          <div class="blog-meta-left">
            <ul>
              <li><i class="fas fa-tags"></i> <strong>{{ __('site.Marketplace.Local Projects')}}</strong> </li>
            </ul>
          </div>
          <div class="blog-meta-right">
            <a href="{{ route('front.marketplace.projectTypeList', ['type_id'=> 10]) }}" class="share-link">{{__('site.Marketplace.Show More')}} <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="row mt-4">
          @foreach ($local_projects as $item)
          <div class="col-md-3">
            <img src="{{ asset($item->image->image_url) }}" alt="{{ $item->title }}" style="width: 400px; height: 250px; overflow-clip-margin: content-box; content-box; clip; border: #041A57 solid 1px; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);">
            <a href="{{ route('front.marketplace.projectInfo', ['id'=> $item->id]) }}" title="{{ $item->title }}">
              <h4 class="mt-2">{{ Str::limit($item->title, 57, '...') }}</h4>
            </a>
            <div class="row">
              <div class="col-md-1">
                <i class="fa-regular fa-user"></i>
                <i class="fa-brands fa-font-awesome"></i>
                <i class="fa-solid fa-calendar-days"></i>
              </div>
              <div class="col-md-11">
                <p>{{ Str::limit($item->author->company_name ?? "Tashkilot ko'rsatilmagan", 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->category->name_uz, 22, '...') }}</p>
                <p class="mt-1">{{ Str::limit($item->project_type->name_uz, 22, '...') }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        

          
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
    <script>
      $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });
            $(document).ready(function () {
                $('.jss-example-basic-single').select2();
            });
    
    </script>
@endsection