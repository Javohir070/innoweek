@extends('layouts.front')
@section('content')
@livewire('front.navbar')

<section class="rt-header-menu hero-wrap-layout1">
  <div class="slider_vedio">
    <div class="header_login"></div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
      
        <div class="regpanel">
          <div class="qrcode pt-2">
            <div class="d-flex justify-content-around">
              <img src="{{ asset('/front/image/logo/minin 1.png') }}" alt="">
              <img src="{{ asset('/front/image/logo/innoweek 1.png') }}" alt="">
              <img src="{{ asset('/front/image/logo/MO123 1.png') }}" alt="">
            </div>
            <h1 class="mt-3 text-center text-white"> ELECTRONIC TICKET </h1>
            <p class="text-center text-white"> Ticket to enter innoweek-2024 </p>
            <div class="d-flex justify-content-around userinf mt-3">
              <h1 class="d-flex align-items-center text-white text-center">{{ $data->user->last_name }} {{ $data->user->first_name}}</h1>
              {!! QrCode::size(170)->generate(route('front.members.getTicket', ['data_id'=> $data->ticket_id])) !!}
              
            </div>
            <div class="grid-container">
              <p class="d-flex align-items-center space-x-2 text-white">
                <img class="flex-shrink-0" src="{{ asset('/front/image/icon/Group 3.png') }}" width="20px" alt="">
                <span class="text-white ms-2">Validity period:</span>
                <span class="ml-autoi text-white ms-3">14.11.2024</span>
              </p>

              <p class="d-flex align-items-center space-x-2 mt-2">
                <img class="flex-shrink-0" src="{{ asset('/front/image/icon/Group 1.png') }}" width="20px" alt="">
                <span class="ms-2">Date and time of visit: </span>
                <span class="ml-autoi ms-3">14.11.2024 10:00</span>

              </p>

              <p class="d-flex align-items-center space-x-2 mt-2">
                <img class="flex-shrink-0" src="{{ asset('/front/image/icon/Group 2.png') }}" width="20px" alt="">
                <span class="ms-2">Tashkent, Amir Temur St. 1</span>
              </p>
            </div>
            <p class="footer text-white text-center mt-4"> It is strictly forbidden for another person to use this pass. </p>
            {{-- <div class="inves-footer">
              <p class="inveestor text-white text-center mt-77">INVESTOR</p>
            </div> --}}
          </div>
          <div class="boxes">
            <form class="reg-box">

              <h3>Download this app to access or use our system.</h3>

              <div class="qrsvg mx-auto d-block">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="170" height="170" viewBox="0 0 170 170">
                  <rect x="0" y="0" width="170" height="170" fill="#ffffff"></rect>
                  <g transform="scale(5.152)">
                    <g transform="translate(0,0)">
                      <path fill-rule="evenodd" d="M9 0L9 1L8 1L8 2L9 2L9 3L8 3L8 4L10 4L10 7L11 7L11 4L12 4L12 8L13 8L13 10L12 10L12 9L11 9L11 8L6 8L6 9L5 9L5 8L0 8L0 10L2 10L2 9L3 9L3 10L4 10L4 9L5 9L5 10L6 10L6 11L4 11L4 12L5 12L5 13L3 13L3 14L0 14L0 16L1 16L1 17L0 17L0 20L1 20L1 21L0 21L0 25L1 25L1 21L2 21L2 20L4 20L4 22L5 22L5 21L7 21L7 20L6 20L6 19L10 19L10 20L9 20L9 21L8 21L8 22L6 22L6 23L5 23L5 25L7 25L7 24L8 24L8 23L9 23L9 24L10 24L10 25L8 25L8 27L9 27L9 28L8 28L8 33L9 33L9 32L10 32L10 33L11 33L11 32L12 32L12 33L15 33L15 32L16 32L16 31L17 31L17 30L21 30L21 29L18 29L18 28L19 28L19 27L18 27L18 26L20 26L20 28L24 28L24 29L23 29L23 30L22 30L22 31L20 31L20 32L22 32L22 33L25 33L25 32L26 32L26 33L28 33L28 32L27 32L27 30L26 30L26 31L25 31L25 30L24 30L24 29L28 29L28 30L30 30L30 31L29 31L29 32L31 32L31 33L32 33L32 32L31 32L31 31L32 31L32 30L30 30L30 29L29 29L29 28L31 28L31 27L32 27L32 29L33 29L33 27L32 27L32 26L33 26L33 24L32 24L32 26L31 26L31 25L30 25L30 24L31 24L31 23L32 23L32 22L33 22L33 21L32 21L32 20L31 20L31 19L32 19L32 18L33 18L33 17L32 17L32 16L31 16L31 15L32 15L32 14L33 14L33 13L31 13L31 15L30 15L30 16L31 16L31 19L30 19L30 17L29 17L29 16L27 16L27 15L26 15L26 14L27 14L27 13L30 13L30 12L31 12L31 11L32 11L32 10L33 10L33 9L32 9L32 8L31 8L31 9L30 9L30 8L29 8L29 9L30 9L30 10L28 10L28 12L27 12L27 9L28 9L28 8L27 8L27 9L26 9L26 8L25 8L25 9L26 9L26 10L25 10L25 11L23 11L23 10L24 10L24 9L23 9L23 10L22 10L22 11L20 11L20 12L19 12L19 13L18 13L18 12L15 12L15 11L16 11L16 10L18 10L18 9L19 9L19 10L21 10L21 8L23 8L23 5L24 5L24 7L25 7L25 5L24 5L24 4L25 4L25 3L24 3L24 2L23 2L23 3L22 3L22 2L21 2L21 1L24 1L24 0L16 0L16 1L15 1L15 0L14 0L14 1L15 1L15 4L16 4L16 5L14 5L14 3L12 3L12 2L13 2L13 1L11 1L11 2L10 2L10 0ZM17 1L17 3L18 3L18 4L17 4L17 8L16 8L16 6L15 6L15 7L14 7L14 6L13 6L13 8L15 8L15 9L14 9L14 10L13 10L13 12L12 12L12 10L11 10L11 9L10 9L10 11L11 11L11 12L10 12L10 13L9 13L9 10L8 10L8 11L6 11L6 12L8 12L8 13L6 13L6 14L7 14L7 15L6 15L6 16L7 16L7 17L6 17L6 18L8 18L8 17L9 17L9 18L10 18L10 19L11 19L11 21L9 21L9 22L11 22L11 23L10 23L10 24L14 24L14 23L12 23L12 22L13 22L13 21L12 21L12 20L15 20L15 21L14 21L14 22L16 22L16 20L18 20L18 21L22 21L22 20L26 20L26 21L24 21L24 22L22 22L22 24L21 24L21 25L22 25L22 24L23 24L23 23L24 23L24 24L25 24L25 22L26 22L26 24L27 24L27 23L29 23L29 21L30 21L30 23L31 23L31 20L30 20L30 19L29 19L29 21L28 21L28 22L26 22L26 21L27 21L27 20L28 20L28 19L25 19L25 18L26 18L26 17L27 17L27 18L29 18L29 17L27 17L27 16L26 16L26 17L25 17L25 18L22 18L22 20L21 20L21 19L20 19L20 18L18 18L18 19L17 19L17 18L16 18L16 17L17 17L17 16L18 16L18 17L19 17L19 16L20 16L20 17L22 17L22 16L21 16L21 15L20 15L20 14L19 14L19 15L17 15L17 16L16 16L16 15L13 15L13 12L14 12L14 11L15 11L15 10L16 10L16 9L17 9L17 8L18 8L18 6L19 6L19 7L20 7L20 8L19 8L19 9L20 9L20 8L21 8L21 7L22 7L22 6L21 6L21 7L20 7L20 5L21 5L21 4L22 4L22 5L23 5L23 4L22 4L22 3L21 3L21 4L20 4L20 5L18 5L18 4L19 4L19 2L20 2L20 1L19 1L19 2L18 2L18 1ZM10 3L10 4L11 4L11 3ZM8 5L8 7L9 7L9 5ZM6 9L6 10L7 10L7 9ZM30 10L30 11L29 11L29 12L30 12L30 11L31 11L31 10ZM0 11L0 13L2 13L2 12L3 12L3 11ZM20 12L20 13L22 13L22 15L24 15L24 16L25 16L25 14L26 14L26 13L27 13L27 12L26 12L26 13L25 13L25 12L23 12L23 13L22 13L22 12ZM8 13L8 14L9 14L9 15L10 15L10 16L9 16L9 17L10 17L10 18L12 18L12 17L13 17L13 19L15 19L15 20L16 20L16 18L14 18L14 17L16 17L16 16L13 16L13 15L12 15L12 17L11 17L11 14L12 14L12 13L10 13L10 14L9 14L9 13ZM14 13L14 14L16 14L16 13ZM17 13L17 14L18 14L18 13ZM23 13L23 14L24 14L24 13ZM4 14L4 15L2 15L2 16L3 16L3 19L4 19L4 20L5 20L5 19L4 19L4 18L5 18L5 17L4 17L4 15L5 15L5 14ZM28 14L28 15L29 15L29 14ZM1 17L1 18L2 18L2 17ZM1 19L1 20L2 20L2 19ZM11 21L11 22L12 22L12 21ZM2 22L2 23L3 23L3 22ZM17 22L17 23L16 23L16 25L14 25L14 26L13 26L13 25L12 25L12 26L11 26L11 25L10 25L10 26L11 26L11 27L10 27L10 29L9 29L9 31L10 31L10 32L11 32L11 31L12 31L12 30L13 30L13 29L12 29L12 30L11 30L11 28L12 28L12 27L13 27L13 28L14 28L14 26L16 26L16 25L17 25L17 24L19 24L19 25L20 25L20 23L21 23L21 22ZM6 23L6 24L7 24L7 23ZM2 24L2 25L3 25L3 24ZM23 25L23 26L21 26L21 27L23 27L23 26L24 26L24 25ZM25 25L25 28L28 28L28 25ZM29 25L29 27L30 27L30 25ZM26 26L26 27L27 27L27 26ZM17 27L17 28L15 28L15 29L14 29L14 30L16 30L16 29L17 29L17 28L18 28L18 27ZM10 30L10 31L11 31L11 30ZM23 30L23 32L25 32L25 31L24 31L24 30ZM13 31L13 32L14 32L14 31ZM17 32L17 33L18 33L18 32ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM26 0L26 7L33 7L33 0ZM27 1L27 6L32 6L32 1ZM28 2L28 5L31 5L31 2ZM0 26L0 33L7 33L7 26ZM1 27L1 32L6 32L6 27ZM2 28L2 31L5 31L5 28Z" fill="#000000"></path>
                    </g>
                  </g>
                </svg>

              </div>
              <div class="my-3" style="margin-left: 27%">
                <a href="https://play.google.com/store/apps/details?id=com.mimaxgroup.innomobileapp"><img class="downloads playM" width="200" src="{{ asset('/front/image/icon/googleplay.png') }}" alt=""></a>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection