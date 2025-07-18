<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- font-family: "IBM Plex Sans", sans-serif; -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('head_title')</title>
        <!-- Open Graph meta tags -->
    <meta property="og:title" content="@yield('head_title', 'INNOWEEK.UZ')" />
    <meta property="og:description" content="InnoWeek.Uz - bu mahalliy va xorijiy tadqiqot markazlari, investitsion fondlar, texnologik agentlik, texnoparklar va biznes-inkubatorlar uchun yagona platforma bo’lib xizmat qiladi desak adashmaymiz. 2021 yildan buyon doimiy o'tkazlib kelinmoqda..." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('head_image', asset('/config/main.jpg'))" />
    <meta property="og:site_name" content="INNOWEEK.UZ - Week Of Innovative Ideas" />

    <!-- Additional meta tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('head_title', 'INNOWEEK.UZ')" />
    <meta name="twitter:description" content="InnoWeek.Uz - bu mahalliy va xorijiy tadqiqot markazlari, investitsion fondlar, texnologik agentlik, texnoparklar va biznes-inkubatorlar uchun yagona platforma bo’lib xizmat qiladi desak adashmaymiz. 2021 yildan buyon doimiy o'tkazlib kelinmoqda..." />
    <meta name="twitter:image" content="@yield('head_image', asset('/config/main.jpg'))" />

    <!-- Favicons -->
    <link href="{{ asset('/front/image/favicon.ico') }}" rel="icon">
    <link href="{{ asset('/front/image/apple-touch-icon.ico') }}" rel="apple-touch-icon">

    <!-- flatpickr -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('/front/assets/flatpicker/flatpickr.min.css') }}">
    <script src="{{ asset('/front/assets/flatpicker/flatpickr.js') }}"></script>

    <!-- Dependency Styles -->
    <link rel="stylesheet" href="{{ asset('/front/assets/wow/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/magnific-popup/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/swiper/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/select2/css/select2.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@magicbruno/swalstrap5@1.0.8/dist/css/swalstrap.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('/front/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="wrapper" id="wrapper">
      <div id="main_content">
        @yield('content')

        <!-- footer area start -->
        <section class="footer_area wow fadeInUp " data-wow-delay=".5s" style="background-image: url({{ asset('/front/image/sponsor.jpg') }});">
          <div class="container">
            <div class="row footer_middle">
              <!-- footer widget -->
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="footer_logo_area">
                  <div class="footer_content">
                    <div class="footer_logo">
                      <img src="{{ asset('/front/image/logo.webp') }}" width="120" alt="logo">
                    </div>
                    <div class="footer_socail_icons">
                      <a href="#"><i class="fa-brands fa-facebook"></i></a>
                      <a href="#"><i class="fa-brands fa-google"></i></a>
                      <a href="#"><i class="fa-brands fa-telegram"></i></a>
                      <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                  </div>
                  <p>{{ __('site.Footer Desc')}} </p>
                </div>
              </div>
              <!-- footer item2 -->
              <div class="col-lg-2 col-md-6 col-sm-12">
                <div class="footer_widget">
                  <i class="icofont-spinner-alt-2"></i>
                  <h4>{{__('site.Address')}}: </h4>
                  <!-- content -->
                  <p>{{ __('site.Address Location')}}</p>
                </div>
              </div>
              <!-- footer item 3 -->
              <div class="col-lg-2 col-md-6 col-sm-12">
                <div class="footer_widget fi_email">
                  <i class="icofont-email"></i>
                  <h4>{{ __('site.Email')}}: </h4>
                  <!-- content -->
                  <p>info@innoweek.uz <br> info@ilmiy.uz </p>
                </div>
              </div>
              <!-- footer item 4 -->
              <div class="col-lg-2 col-md-6 col-sm-12">
                <div class="footer_widget fi_phone">
                  <i class="icofont-ui-call"></i>
                  <h4>{{ __('site.Contact')}} : </h4>
                  <!-- content -->
                  <p>+998 71 203 32 00 </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <footer class="footer-wrap-layout1">
          <div class="footer1 footer-bottom">
            <div class="copyright-text wow fadeInLeftBig animated p-xl-1" data-wow-delay="1s" data-wow-duration="1s">
              &copy; <span id="currentYear"></span> {{ __('site.Footer Copyright')}}</span>
            </div>
        </footer>
        <!-- footer area end -->
      </div>

      {{-- 2025 uchun ochildi -closed --}}
      <div class="offcanvas-menu-wrap" id="offcanvas-wrap" data-position="right">
        <div class="offcanvas-header">
          <span class="header-text">{{ __('site.Registration.Close')}}</span>
          <button type="button" class="offcanvas-menu-btn menu-status-close offcanvas-close">
            <span class="menu-btn-icon">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </button>
        </div>
        <div class="offcanvas-content">

          <div class="tab-content">
            <h5 class="top-content">{{ __('site.Registration.Fill All Fields')}}</h5>
            <div class="tab">
              <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'res')">{{ __('site.Registration.Local')}}</button>
              <button class="tablinks" onclick="openCity(event, 'nores')">{{ __('site.Registration.International')}}</button>
            </div>

            <div id="res" class="tabcontent">
              <form class="box" id="registrationForm" enctype="multipart/form-data">
                @csrf
                <div class="input-names">
                  <input class="name" name="first_name" type="text" placeholder="{{ __('site.Registration.First Name')}} *" autocomplete="off" required>
                  <input class="surname" name="last_name" type="text" placeholder="{{ __('site.Registration.Last Name')}} *" autocomplete="off" required>
                </div>
                <input id="emailOrNumber" type="text" name="phone" placeholder="{{ __('site.Registration.Phone')}} *" autocomplete="off" required>
                <div class="mt-3">
                  <select class="js-example-basic-singlee form-control " name="profession_id" required>
                    <option selected value="{{null}}">{{ __('site.Registration.Profession')}} *</option>
                    @foreach (_getProfessions() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="d-block d-sm-none mb-2 mt-2 text-center">
                  <label  for="birth_date">{{ __('site.Registration.Date of birth')}} *</label>
                </div>
                <input class="form-control" name="birth_date" type="datetime-local" autocomplete="off" required placeholder="{{ __('site.Registration.Date of birth')}} *" />

                <div class="input-radio">
                  <label for="gender">{{ __('site.Registration.Gender')}}:</label>
                  <div class="d-flex-radio">
                    <input type="radio" name="Gender" value="1" id="gender"><label for="gender">{{ __('site.Registration.Male')}}</label>
                    <input type="radio" name="Gender" value="2"id="gender"><label for="gender">{{ __('site.Registration.Female')}}</label>
                  </div>
                </div>
                {{-- <button type="button" class="btn btn-primary btn-lg rounded-0" data-example="8">Try me!</button> --}}
                <button type="submit" class="btnB btn-input">{{ __('site.Registration.Sign Up')}}</button>
              </form>
              <p class="text-center mt-3 text-white"> {{__('site.Registration.Are you registered')}}
                <a href="javascript:void(0)" id="checkTicketLink" class="mx-2">{{__('site.Registration.Check your ticket')}} </a>
              </p>
            </div>

            <div id="nores" class="tabcontent" style="display: block;">
              <form class="box " id="registrationFormEmail" enctype="multipart/form-data">
                @csrf
                <div class="input-names">
                  <input name="first_name" class="name" name="first_name" type="text" placeholder="{{__('site.Registration.First Name')}} *" autocomplete="on" required="" autofocus="">
                  <input name="last_name" class="surname" name="last_name" type="text" placeholder="{{__('site.Registration.Last Name')}} *" autocomplete="on" required="">
                </div>
                <input id="emailOrNumber" type="email" name="email" placeholder="{{__('site.Registration.Email')}} *" autocomplete="on" required>

                <select class="js-example-basic-single form-control" name="country_id" required>
                  <option value="{{ null }}">{{__('site.Registration.Country')}} *</option>
                  @foreach (_getCountries() as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>

                <div class="mt-3">
                  <select class="js-example-basic-singlee form-control " name="profession_id" required>
                    <option selected value="{{null}}">{{__('site.Registration.Profession')}} *</option>
                    @foreach (_getProfessions() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                <input id="organization" type="text" name="organization" placeholder="{{ __('site.Registration.Organization') }} *" autocomplete="off">
                <input class="form-control" name="birth_date" type="datetime-local" autocomplete="off" required placeholder="{{ __('site.Registration.Date of birth')}} *" />
                <div class="input-radio">
                  <label for="gender">{{__('site.Registration.Gender')}}:</label>
                  <div class="d-flex-radio">
                    <input type="radio" name="gender" id="gender" value="1"><label for="gender">{{__('site.Registration.Male')}}</label>
                    <input type="radio" name="gender" id="gender" value="2"><label for="gender">{{__('site.Registration.Female')}}</label>
                  </div>
                </div>
                <button type="submit" class="btnB btn-input">{{__('site.Registration.Sign Up')}}</button>
              </form>
              <p class="text-center mt-3 text-white"> {{__('site.Registration.Are you registered')}}
                <a href="javascript:void(0)" id="checkTicketLink" class="mx-2">{{__('site.Registration.Check your ticket')}} </a>
              </p>
            </div>
          </div>

        </div>
      </div>

      <div id="template-search" class="template-search">
        <button type="button" class="close">×</button>
        <form class="search-form">
          <input type="search" value="" placeholder="Search" />
          <button type="submit" class="search-btn btn-ghost style-1">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>

    </div>

    <form id="myForm">
      <!-- Ko'rinmaydigan yashirin input -->
      <input type="hidden" id="hiddenInputId" name="event_id" value="">
    </form>
    <a href="#" id="scroll-top"><i class="fa-solid fa-arrow-up"></i></a>

    <!-- Dependency Scripts -->
    <script src="{{ asset('/front/assets/jquery/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('/front/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/front/assets/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('/front/assets/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('/front/assets/magnific-popup/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/front/assets/wow/wow.min.js') }}"></script>
    <script src="{{ asset('/front/assets/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('/front/assets/countdown/countdown.min.js') }}"></script>
    <!-- Custom Script -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@magicbruno/swalstrap5@1.0.8/dist/js/swalstrap5.min.js"></script> --}}
    <script src="{{ asset('/alert/js/swalstrap5_all.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#registrationForm').on('submit', function(event) {
                event.preventDefault();  // Formning default action'ini to'xtatish

                let csrfToken = $('meta[name="csrf-token"]').attr('content');  // CSRF token olish
                let formData = new FormData(this);  // Formni barcha ma'lumotlari bilan olish

                $.ajax({
                    url: "{{ route('front.members.validate') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,  // jQuery ga ma'lumotlarni avtomatik qayta ishlashni o'chirish
                    contentType: false,  // Jquery ga ma'lumotlarni `multipart/form-data` qilishni aytish
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // CSRF tokenni jo'natish
                    },
                    success: function(response) {
                      Swal.fire({
                            title: "{{ __('site.Registration.Verify Code Title')}}",
                            input: 'number',
                            inputPlaceholder: "XXXXXX",
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            confirmButtonText: "{{ __('site.Registration.Approve')}}",
                            cancelButtonText: "{{ __('site.Registration.Cancel') }}",
                            preConfirm: (login) => {

                              let _url = "{{ route('front.members.register') }}?verify_code=" + login;
                              console.log(_url);

                              let csrfToken = $('meta[name="csrf-token"]').attr('content'); // CSRF token olish
                              // FormData obyektini yaratib, formdan ma'lumotlarni olish
                              var formData = new FormData($('#registrationForm')[0]);

                              return $.ajax({
                                url: _url,
                                type: 'POST',
                                data: formData,
                                processData: false, // jQuery ga ma'lumotlarni avtomatik qayta ishlashni o'chirish
                                contentType: false, // Jquery ga ma'lumotlarni `multipart/form-data` qilishni aytish
                                headers: {
                                  'X-CSRF-TOKEN': csrfToken // CSRF tokenni jo'natish
                                },
                                success: function(response) {
                                  if (typeof response.data.id !== 'undefined') {
                                    console.log(response.data);
                                    window.location.replace("{{ route('front.members.getTicket') }}?data_id=" + response.data.ticket.ticket_id);
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

                    },
                    error: function(response) {
                      let _msg = "";

                      if (typeof response.responseJSON.error !== 'undefined' && typeof response.responseJSON.error.phone !== 'undefined') {
                        _msg += response.responseJSON.error.phone[0];
                      }
                      else if (typeof response.responseJSON.error !== 'undefined' && typeof response.responseJSON.error.email !== 'undefined') {
                        _msg += response.responseJSON.error.email[0];
                      }
                      else {
                          _msg += response.responseJSON.message;
                      }

                      Swal.fire({
                            icon: 'error',
                            title: "{{ __('site.Registration.Error')}}",
                            //text: "Ro'yxatdan o'tishda xatolik yuz berdi!",
                            html: '<div class="alert alert-danger" role="alert"> ' + _msg + '</div>',
                            //footer: '<a href="">Why do I have this issue?</a>'
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#registrationFormEmail').on('submit', function(event) {
                event.preventDefault();  // Formning default action'ini to'xtatish

                let csrfToken = $('meta[name="csrf-token"]').attr('content');  // CSRF token olish
                let formData = new FormData(this);  // Formni barcha ma'lumotlari bilan olish

                $.ajax({
                    url: "{{ route('front.members.validate') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,  // jQuery ga ma'lumotlarni avtomatik qayta ishlashni o'chirish
                    contentType: false,  // Jquery ga ma'lumotlarni `multipart/form-data` qilishni aytish
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // CSRF tokenni jo'natish
                    },
                    success: function(response) {
                      Swal.fire({
                            title: "{{ __('site.Registration.Verify Code Title')}}",
                            input: 'number',
                            inputPlaceholder: "XXXXXX",
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            confirmButtonText: "{{ __('site.Registration.Approve')}}",
                            cancelButtonText: "{{ __('site.Registration.Cancel') }}",
                            preConfirm: (login) => {

                              let _url = "{{ route('front.members.register') }}?verify_code=" + login;
                              console.log(_url);

                              let csrfToken = $('meta[name="csrf-token"]').attr('content'); // CSRF token olish
                              // FormData obyektini yaratib, formdan ma'lumotlarni olish
                              var formData = new FormData($('#registrationFormEmail')[0]);

                              return $.ajax({
                                url: _url,
                                type: 'POST',
                                data: formData,
                                processData: false, // jQuery ga ma'lumotlarni avtomatik qayta ishlashni o'chirish
                                contentType: false, // Jquery ga ma'lumotlarni `multipart/form-data` qilishni aytish
                                headers: {
                                  'X-CSRF-TOKEN': csrfToken // CSRF tokenni jo'natish
                                },
                                success: function(response) {
                                  if (typeof response.data.id !== 'undefined') {
                                    console.log(response.data);
                                    window.location.replace("{{ route('front.members.getTicket') }}?data_id=" + response.data.ticket.ticket_id);
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

                    },
                    error: function(response) {
                      let _msg = "";

                      if (typeof response.responseJSON.error !== 'undefined' && typeof response.responseJSON.error.phone !== 'undefined') {
                        _msg += response.responseJSON.error.phone[0];
                      }
                      else if (typeof response.responseJSON.error !== 'undefined' && typeof response.responseJSON.error.email !== 'undefined') {
                        _msg += response.responseJSON.error.email[0];
                      }
                      else {
                          _msg += response.responseJSON.message;
                      }

                      Swal.fire({
                            icon: 'error',
                            title: "{{ __('site.Registration.Error')}}",
                            //text: "Ro'yxatdan o'tishda xatolik yuz berdi!",
                            html: '<div class="alert alert-danger" role="alert"> ' + _msg + '</div>',
                            //footer: '<a href="">Why do I have this issue?</a>'
                        });
                    }
                });
            });
        });
    </script>

    <script>
      $(document).ready(function() {
                $('#checkTicketLink').on('click', function(event) {
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

                        let _url = "{{ route('front.members.checkTicket') }}";
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
                            if (typeof response.data.id !== 'undefined') {
                              console.log(response.data);
                              window.location.replace("{{ route('front.members.getTicket') }}?data_id=" + response.data.ticket.ticket_id);
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



  <script>
  function storeEventMember(eventId) {
    document.getElementById('hiddenInputId').value = eventId;

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

        let _url = "{{ route('front.members.eventStore') }}";
        let csrfToken = $('meta[name="csrf-token"]').attr('content'); // CSRF token olish
        let eventDataID = document.getElementById('hiddenInputId').value;

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
            event_id: eventDataID,
            phone_or_email: login
          },
          success: function(response) {
            if (typeof response.data.id !== 'undefined') {
              Swal.fire({
                icon: 'success',
                title: "{{ __('site.Registration.Completed')}}!",
                html: '<div class="alert alert-danger" role="alert">{{ __("site.Registration.Completed Application")}}</div>',
              });
            }
            else
            {
              Swal.showValidationMessage(`${response.message}`);
            }
          },
          error: function(response) {
            Swal.showValidationMessage(`${response.responseJSON.message}`);
          }
        });
      }
    }
  );
}
</script>

@yield('s-script')

    <!-- flatpickr -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    <script src="{{ asset('/front/js/app.js') }}"></script>

    <script>
      $(document).ready(function () {
          $('.js-example-basic-single').select2();
        });

        $(document).ready(function () {
          $('.js-example-basic-singlee').select2();
        });
    </script>
    @yield('scripts')
  </body>
</html>
