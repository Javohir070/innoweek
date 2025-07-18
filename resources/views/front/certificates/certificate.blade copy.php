<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('/certificate/style.css') }}">
    @php
    $isLatin = false;
    if (preg_match("/^[\w\d\s.,-]*$/", $full_name)) {
        $isLatin = true;
    }
    @endphp
    <title>{{ __('Certificate')}}</title>
</head>
<body>
    <div class="content">
        {{-- <h1>sertifikat</h1> --}}
        {{-- <p>Yangi O‘zbekiston taraqqiyotining kreativ ta’lim va innovatsiyalar asosiga qo‘shgan hissasi uchun</p> --}}
        <p>"Barqaror rivojlanish uchun innovatsiyalar” shiori ostida bo‘lib o‘tgan “InnoWeek-2024”
        – xalqaro innovatsion g‘oyalar haftaligi doirasida faol ishtiroki uchun</p>
        <h2
        @if ($isLatin)
            style="font-family: 'Inter', sans-serif; src: url({{ asset('/certificate/fonts/Inter-Medium.ttf') }}) format('truetype'); margin: -435px 0 0 600px;"
        @endif
        >{{ $full_name ?? "abdug'afforov muhammadjon mutalibjonovich" }}</h2>
        <h6>bilan taqdirlanadi.</h6>
        <div class="footer__text">
            {{-- <h4>i. abdurahmonov</h4> --}}
            <img src="{{ $imagePath }}" alt="">
            <div class="date">
                <h5>{{ $date }}</h5>
                {{-- <h5>Sana</h5> --}}
            </div>
        </div>
    </div>
</body>
</html>