<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="author" content="PayWay">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <title>The Bible Society in Cambodia</title>
    <link rel="icon" href="{{ asset('assets/images/logo.svg') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        .prose ul {
            list-style-type: disc;
            padding-left: 1.25rem;
            font-size: 16px;
        }

        .prose ul li::marker {}

        .prose ol {
            list-style-type: decimal;
            padding-left: 1.25rem;
            font-size: 16px;
        }

        .prose p span {
            font-size: 16px;
        }

        .prose strong {
            font-size: 18px;
        }

        .swiper .swiper-pagination-bullet {
            background-color: #000;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .swiper .swiper-pagination .swiper-pagination-bullet-active {
            width: 10px;
            height: 4px;
            border-radius: 10px;
            background-color: #000;
        }

        @media (max-width: 639px) {

            .prose strong {
                font-size: 16px;
            }

            .prose p span{
                font-size: 14px;
            }

            .prose ul {
                list-style-type: disc;
                padding-left: 1.25rem;
                font-size: 14px;
            }
        }
    </style>
    @yield('css')
</head>

<body class="{{ app()->getLocale() === 'km' ? 'font-kantumruy' : 'font-inter' }}">

    @include('components.navbar', ['versions_item' => $versions_item])

    @yield('content')

    @include('components.footer')

    @yield('js')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script> --}}

    <script>
        AOS.init({
            offset: 10,
        });

        var missionSwiper = new Swiper(".MissionSwiper", {
            loop: true,
            autoplay: {
                delay: 2000,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
</body>

</html>
