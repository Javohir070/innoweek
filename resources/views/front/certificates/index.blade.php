@extends('layouts.front')
@section('head_title', trans("site.Certificate.Title"))
@section('content')
@livewire('front.navbar')
@livewire('front.mobile-navbar')
<div class="site-breadcrumb" style="background: url({{ asset('/front/image/blog/news-1.png') }})">
  <div class="container">
    <h2 class="breadcrumb-title">{{ __('site.Certificate.Title')}}</h2>
    <ul class="breadcrumb-menu">
      <li><a href="{{ route('front.home') }}">{{ __('site.menus.Home')}}</a></li>
      <i class="fa-solid fa-angles-right"></i>
      <li class="active">{{ __('site.Certificate.Title')}}</li>
    </ul>
  </div>
</div>

<div class="team-area py-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
          <span class="site-title-tagline">{{ __('site.Certificate.Certificate')}}</span>
          <h2 class="site-title">{!! __('site.Certificate.Steps') !!}</h2>
          <div class="site-shadow-text">{{ __('site.Certificate.Certifcate')}}</div>
        </div>
      </div>
    </div>
    <div class="row g-5">
      <div class="col-md-6 col-lg-4">
        <div class="pricing-item wow fadeInUp" data-wow-delay=".25s">
          <div class="pricing-shape">
            <img src="{{ asset('/front/image/shape/03.png') }}" alt>
          </div>
          <div class="pricing-header">
            <h5>1</h5>
          </div>
          <div class="pricing-amount">
            <strong>{{ __('site.Certificate.Register')}}</strong>
          </div>
          <div class="pricing-feature">
            <ul>
              <li><i class="fas fa-check-circle"></i>{{ __('site.Certificate.Register Desc')}}</li>
            </ul>
          </div>
          <!-- <div class="pricing-btn-wrap">
                                    <a href="#" class="theme-btn">Purchase Now <i class="fas fa-arrow-right"></i></a>
                                </div> -->
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="pricing-item wow fadeInDown" data-wow-delay=".25s">
          <div class="pricing-shape">
            <img src="{{ asset('/front/image/shape/03.png') }}" alt>
          </div>
          <div class="pricing-header">
            <h5>2</h5>
          </div>
          <div class="pricing-amount">
            <strong>{{ __('site.Certificate.Visit to event')}}</strong>
          </div>
          <div class="pricing-feature">
            <ul>
              <li><i class="fas fa-check-circle"></i>{{ __('site.Certificate.Visit to event desc')}}</li>
            </ul>
          </div>
          <!-- <div class="pricing-btn-wrap">
                                    <a href="#" class="theme-btn">Purchase Now <i class="fas fa-arrow-right"></i></a>
                                </div> -->
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="pricing-item wow fadeInUp" data-wow-delay=".25s">
          <div class="pricing-shape">
            <img src="{{ asset('/front/image/shape/03.png') }}" alt>
          </div>
          <div class="pricing-header">
            <h5>3</h5>
          </div>
          <div class="pricing-amount">
            <strong>{{ __('site.Certificate.Get Certificate')}}</strong>
          </div>
          <div class="pricing-feature">
            <ul>
              <li><i class="fas fa-check-circle"></i>{{ __('site.Certificate.Get Certificate Desc')}}</li>
            </ul>
          </div>
          <!-- <div class="pricing-btn-wrap">
                                    <a href="#" class="theme-btn">Purchase Now <i class="fas fa-arrow-right"></i></a>
                                </div> -->
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
      <a class="theme-btn" href="javascript:void(0)" id="checkCertificate">{{ __('site.Certificate.Get Certificate') }}<i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</div>
@endsection
@section('s-script')
    <script>
      $(document).ready(function() {
        $('#checkCertificate').on('click', function(event) {
          event.preventDefault();  // Formning default action'ini to'xtatish
          Swal.fire({
            title: "{{ __('site.Registration.Enter Email or Phone')}}",
            input: 'text',
            inputPlaceholder: "{{ __('site.Registration.Email or Phone')}}",
            inputAttributes: {
              autocapitalize: 'on'
            },
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "{{__('site.Registration.Approve')}}",
            cancelButtonText: "{{__('site.Registration.Cancel')}}",
            preConfirm: (login) => {
              let _url = "{{ route('front.certificate.check') }}";
              let csrfToken = $('meta[name="csrf-token"]').attr('content'); // CSRF token olish
              return $.ajax({
                url: _url,
                type: 'POST',
                //processData: false, // jQuery ga ma'lumotlarni avtomatik qayta ishlashni o'chirish
                //contentType: false, // Jquery ga ma'lumotlarni `multipart/form-data` qilishni aytish
                headers: {
                  'X-CSRF-TOKEN': csrfToken // CSRF tokenni jo'natish
                },
                data: {
                  _token: csrfToken, //"{{ csrf_token() }}",
                  phone_or_email: login
                },
                success: function(response) {
                  if (typeof response.data.file_path !== 'undefined') {
                    //console.log(response.data);
                    window.location.replace("{{ route('front.home') }}" + response.data.file_path);
                  }
                  else
                  {
                    Swal.showValidationMessage(
                    `${response.message}`
                  );
                }
              },
              error: function(response) {
                Swal.showValidationMessage(
                `${response.responseJSON.message}`
              );
            }
          });
        }
      });
    });
  });
</script>
@endsection
