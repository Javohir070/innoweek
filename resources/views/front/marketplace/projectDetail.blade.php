@extends('layouts.front')
@section('head_title', $project->title. ' | '.trans("site.Marketplace.Title"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')

<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{ __('site.Marketplace.Project Details')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{__('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{__('site.Marketplace.Title')}}</li>
    </ul>
  </div>
</div>

<div class="blog-single py-120">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="row">
          <div class="col-12">
            <div class="gallery-box-layout3 has-animation">
              <a href="{{ asset($project->image->image_url) }}" class="rt-mfp-gallery-item">
                <img src="{{ asset($project->image->image_url) }}" alt="Gallery">
              </a>
            </div>
          </div>
          @foreach ($project->gallery as $item)
          <div class="col-2">
            <div class="gallery-box-layout2 has-animation">
              <a href="{{ asset($item->image_url) }}" class="rt-mfp-gallery-item">
                <img src="{{ asset($item->image_url) }}" style="clip-margin: content-box; content-box; clip;" alt="Gallery">
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-12">
        <h3 class="blog-details-title mb-20">{{ $project->title }}</h3>
        <div class="blog-meta">
          <div class="blog-meta-left">
            <ul>
              <li><i class="far fa-user"></i>{{ $project->author->company_name }}</li>
            </ul>
            <ul>
              <li><i class="fa-brands fa-font-awesome"></i>{{ $project->category->name_uz}}</li>
            </ul>
            <ul>
              <li><i class="fa-solid fa-filter"></i>{{ $project->project_type->name_uz}}</li>
            </ul>
            @if ($project->is_engineering == 1)
                <ul>
                  <li><i class="fa-solid fa-diagram-project"></i> Muhandislik loyiha</li>
                </ul>
            @endif
            
          </div>
        </div>

      </div>
      
      <div class="col-lg-8">
        <div class="event-single-box">
      
          <div class="content-box">
    
            {!! $project->description !!}

            <div class="event-speaker wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="1s">
              <div class="row">
                <div class="col-lg-5 col-12">
                  <div class="speaker-figure-box">
                    <img src="{{ asset($project->author->company_logo) }}" alt="{{$project->author->company_name}}">
                  </div>
                </div>
                <div class="col-lg-7 col-12">
                  <div class="speaker-content-box">
                    <div>
                      <h2 class="speaker-title">{{ $project->author->company_name }}</h2>
                      <div class="speaker-sub-title">{{ $project->author->address }}</div>
                      <div class="blog-meta">
                        <div class="blog-meta-left">
                          <ul>
                            <li><i class="far fa-envelope"></i>{{ $project->author->email }}</li>
                            <li><i class="fa-solid fa-phone"></i> {{ $project->author->phone }}</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>
@endsection