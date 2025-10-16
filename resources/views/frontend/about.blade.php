@extends('layouts.master')
@section('content')
    @include('components.loading')

    @php
        $locale = app()->getLocale();
        $Experience = [
            ['id' => 1, 'year' => 'messages.1804', 'content' => 'messages.1804_content'],
            ['id' => 2, 'year' => 'messages.1892', 'content' => 'messages.1892_content'],
            ['id' => 3, 'year' => 'messages.1899', 'content' => 'messages.1899_content'],
            ['id' => 4, 'year' => 'messages.1923', 'content' => 'messages.1923_content'],
            ['id' => 5, 'year' => 'messages.1954', 'content' => 'messages.1954_content'],
            ['id' => 6, 'year' => 'messages.1955', 'content' => 'messages.1955_content'],
            ['id' => 7, 'year' => 'messages.1962', 'content' => 'messages.1962_content'],
            ['id' => 8, 'year' => 'messages.1968', 'content' => 'messages.1968_content'],
            ['id' => 9, 'year' => 'messages.1975_1992', 'content' => 'messages.1975_1992_content'],
        ];
    @endphp
    <section class="w-full h-[60vh] md:h-screen flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/aboutus.png') }}'); background-size: cover; background-position: center;">
        <div class="flex items-center justify-between gap-2 w-full max-w-7xl mx-auto px-4 md:px-20 ">
            <div class="text-[#fff] w-full" data-aos="fade-right" data-aos-duration="1000">
                <p class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">{{ __('messages.title-1') }}
                </p>
                <h1 class="text-[20px] md:text-[50px] xl:text-[5rem] font-[600] leading-none">
                    {!! nl2br(__('messages.welcome')) !!}
                </h1>
            </div>

            <p data-aos="fade-left" data-aos-duration="1000"
                class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400] flex justify-end">
                {{ __('messages.quote') }}</p>
        </div>
    </section>

    <div
        class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full translate-y-[-15%] xl:translate-y-[-30%] shadow-sm drop-shadow-md">
        <div class="w-full h-full md:h-[45vh] lg:h-[50vh] xl:h-[60vh] 2xl:h-[50vh] flex flex-col md:flex-row overflow-hidden">
            <div class="w-full md:w-[50%] h-[25vh] md:h-full">
                <img src="{{ asset('assets/images/Banners/about_1.png') }}" alt="banner"
                    class="w-full h-full object-cover object-center max-sm:rounded-t-[30px] md:rounded-l-[30px]" />
            </div>
            <div
                class="flex flex-col w-full md:w-[50%] h-full gap-[1rem] bg-[linear-gradient(0deg,#4FC9EE,#4FC9EE)] p-5 max-sm:rounded-b-[30px] md:rounded-r-[30px]">
                <h1 class="text-[16px] md:text-[18px] xl:text-[24px] text-[#000000] font-[700] text-wrap">
                    {{ __('messages.about_us_title') }}
                </h1>
                <p class="text-[12px] md:text-[14px] xl:text-[16px]">
                    {{ __('messages.about_us_content') }}
                </p>
            </div>
        </div>
    </div>

    <div
        class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto px-3 flex flex-wrap pb-[8rem] overflow-hidden">
        <div class="w-full md:w-[30%]">
            <span>
                <img data-aos="fade-down" data-aos-duration="400" src="{{ asset('assets/images/icons/mission.svg') }}"
                    alt="banner" class="w-[50px] h-[50px] xl:w-[100px] xl:h-[100px] object-cover object-center p-2">
            </span>
            <h1 data-aos="fade-right" data-aos-duration="500"
                class="text-[20px] md:text-[30px] xl:text-[40px] text-[#4FC9EE] font-[700] text-wrap">
                {{ __('messages.sop') }}
            </h1>
        </div>

        <div data-aos="fade-left" data-aos-duration="500" class="w-full md:w-[70%]">
            <p class="text-[10px] md:text-[14px] xl:text-[20px] text-justify text-[#000]">
                {{ __('messages.sop_content') }}
            </p>
        </div>
    </div>

    <div class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full pb-10 px-2" x-data="{ expandedIndex: null }">
        <ul class="space-y-[1rem] md:space-y-0 md:flex gap-5 flex-wrap items-start">
            @foreach ($Experience as $index => $item)
                <li class="w-full md:w-[48%] flex flex-col items-end">
                    <div class="flex flex-col xl:flex-row gap-2">
                        <h1 class="text-[#3cc2f8] text-[18px] text-nowrap lg:w-[25%] leading-5 text-start xl:text-end">
                            {{ __($item['year']) }}
                        </h1>
                        <p :class="expandedIndex === {{ $index }} ? 'line-clamp-none' : 'line-clamp-3'"
                            class="text-[14px] text-balance lg:w-[75%] leading-5">
                            {{ __($item['content']) }}
                        </p>
                    </div>

                    <button x-show="expandedIndex !== {{ $index }}" @click="expandedIndex = {{ $index }}"
                        class="w-fit bg-white text-[12px] px-3 py-1 text-black rounded-full mt-2">
                        {{ $locale === 'km' ? 'ព័ត៌មានបន្ថែម' : 'Read More' }}
                    </button>
                    <button x-show="expandedIndex === {{ $index }}" @click="expandedIndex = null"
                        class="w-fit bg-white text-[12px] px-3 py-1 text-black rounded-full mt-2">
                        {{ $locale === 'km' ? 'បិទព័ត៌មាន' : 'Show Less' }}
                    </button>
                </li>
            @endforeach
        </ul>

    </div>

    <div class="w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto py-10 px-5 overflow-hidden">
        <div class="flex flex-col xl:flex-row space-y-5 xl:space-x-5">
            <div class="w-full xl:w-[20%]">
                <div
                    class="flex flex-row xl:flex-col space-x-2 justify-center items-center xl:justify-start xl:items-start">
                    <span>
                        <img src="{{ asset('assets/images/icons/fb.svg') }}" alt="banner" data-aos="fade-right" data-aos-duration='300'
                            class="w-[50px] h-[50px] xl:w-[150px] xl:h-[150px] object-cover object-center p-2" />
                    </span>
                    <h1 class="text-[16px] xl:text-[34px] text-[#4FC9EE] font-[700]" data-aos="fade-right" data-aos-duration='400'>
                        {{ __('messages.ofb') }}
                    </h1>
                </div>
            </div>

            <div class="w-full xl:w-[80%]">
                <ul class="grid grid-cols-2 xl:grid-cols-3 justify-center gap-4 md:gap-[3rem] text-[#000]">
                    <li data-aos="fade-left" data-aos-duration='200'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_1') }}
                    </li>
                    <li data-aos="fade-left" data-aos-duration='300'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_2') }}
                    </li>
                    <li data-aos="fade-left" data-aos-duration='400'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_3') }}
                    </li>
                    <li data-aos="fade-left" data-aos-duration='500'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_4') }}
                    </li>
                    <li data-aos="fade-left" data-aos-duration='600'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_5') }}
                    </li>
                    <li data-aos="fade-left" data-aos-duration='700'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_6') }}
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="w-full md:h-full flex flex-col md:flex-row">
        <div class="w-full md:w-[40%]">
            <img src="{{ asset('assets/images/Banners/about_2.png') }}" alt="banner"
                class="w-full h-full object-cover object-center" />
        </div>
        <div class="w-full md:w-[60%] h-full bg-[#50c9ee]">
            <div class="flex flex-col gap-3 xl:gap-[5rem] p-3 md:p-10 xl:p-28">

                <div class="w-full h-full xl:flex xl:gap-3">
                    <span class="w-[20%] mx-auto xl:mx-0">
                        <img src="{{ asset('assets/images/icons/ms.svg') }}" alt="icon"
                            class="w-[46px] h-[46px] mx-auto xl:mx-0 lg:w-[64px] lg:h-[64px] object-cover object-center" />
                    </span>
                    <ul class="w-[80%] mx-auto">
                        <li>
                            <h1
                                class="text-[16px] md:text-[20px] xl:text-[32px] font-semibold text-center xl:text-start leading-none">
                                {{ __('messages.our_mission') }}
                            </h1>
                            <p
                                class="text-[14px] md:text-[16px] xl:text-[20px] text-[#fff] text-center xl:text-start pt-2">
                                {{ __('messages.our_mission_content') }}
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="w-full h-full xl:flex xl:gap-3">
                    <span class="w-[20%] mx-auto xl:mx-0">
                        <img src="{{ asset('assets/images/icons/vision.svg') }}" alt="icon"
                            class="w-[46px] h-[46px] mx-auto xl:mx-0 lg:w-[64px] lg:h-[64px] object-cover object-center" />
                    </span>
                    <ul class="w-[80%] mx-auto">
                        <li>
                            <h1
                                class="text-[16px] md:text-[20px] xl:text-[32px] font-semibold text-center xl:text-start leading-none">
                                {{ __('messages.our_vision') }}
                            </h1>
                            <p
                                class="text-[14px] md:text-[16px] xl:text-[20px] text-[#fff] text-center xl:text-start pt-2">
                                {{ __('messages.our_vision_content') }}
                            </p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="w-full bg-gradient-to-r from-[#1E1E1E] to-[#413F3F] p-3 shadow drop-shadow-2xl {{ $locale === 'km' ? 'font-krasar' : 'font-gotham' }}">
        <div class="p-3 text-center">
            <span>
                <img src="{{ asset('assets/images/icons/core.svg') }}" alt="core icon"
                    class="w-[40px] mx-auto h-[40px] xl:w-[52px] xl:h-[52px] object-cover object-center" />
            </span>
            <h1 class="text-[18px] xl:text-[32px] text-[#4FC9EE] font-bold mt-2">
                {{ __('messages.our_core_value') }}
            </h1>
        </div>

        <ul
            class="w-full max-w-[520px] md:max-w-[720px] xl:max-w-[1200px] mx-auto grid grid-cols-2 md:grid-cols-4 gap-[1vw] justify-center p-10">
            <li class="">
                <h1 class="text-[20px] xl:text-[30px] font-semibold text-[#575757]">
                    {{ __('messages.ocv_01') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_01_content') }}
                </p>
            </li>
            <li class="">
                <h1 class="text-[20px] xl:text-[30px] font-semibold text-[#575757]">
                    {{ __('messages.ocv_02') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_02_content') }}
                </p>
            </li>
            <li class="">
                <h1 class="text-[20px] xl:text-[30px] font-semibold text-[#575757]">
                    {{ __('messages.ocv_03') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_03_content') }}
                </p>
            </li>
            <li class="">
                <h1 class="text-[20px] xl:text-[30px] font-semibold text-[#575757]">
                    {{ __('messages.ocv_04') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_04_content') }}
                </p>
            </li>
        </ul>
    </div>

    <div class="w-full h-[250px] md:h-[400px] xl:h-[1024px] bg-center bg-cover"
        style="background-image: url('{{ asset('assets/images/Banners/about_4.png') }}');">
    </div>

    <div class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto p-3 md:p-8 overflow-hidden">
        <h1 data-aos="fade-right" data-aos-duration="400"
            class="text-[18px] md:text-[24px] text-[#4FC9EE] font-bold capitalize">
            {{ __('messages.our_board') }}
        </h1>
        <p data-aos="fade-left" data-aos-duration="500" class="text-[14px] md:text-[20px] whitespace-pre-line">
            {{ __('messages.our_board_content') }}
        </p>
    </div>

    <div class="w-full h-[250px] md:h-[400px] xl:h-[1024px] bg-center bg-cover"
        style="background-image: url('{{ asset('assets/images/Banners/about_3.png') }}');">
    </div>
@endsection
