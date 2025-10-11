@extends('layouts.master')
@section('css')
@endsection
@section('content')
    @include('components.loading')

    <section class="w-full h-[60vh] md:h-screen flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/banner.jpg') }}'); background-size: cover; background-position: center;">
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

    <section id="home"
        class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full bg-[linear-gradient(85.15deg,_rgba(30,_30,_30,_0.8)_0.43%,_rgba(7,_32,_39,_0.64)_98.29%)] backdrop-blur-[10px] shadow-[0px_50px_50px_-40px_rgba(0,_0,_0,_0.25)] rounded-[30px] border-[2px] border-solid border-[#575757] translate-y-[-23%] p-3 md:p-14 md:translate-y-[-40%] overflow-hidden">

        <h1 class="text-[14px] xl:text-[30px] font-normal text-[#4FC9EE] text-center text-wrap mb-4 md:mb-14">
            {{ __('messages.title') }}
        </h1>

        @php
            $locale = app()->getLocale();
        @endphp

        <form method="POST" action="{{ route('donations.create-payment') }}" x-data="{ currency: '{{ old('currency', 'usd') }}' }"
            class="w-full md:flex md:gap-2">
            @csrf

            <!-- Left side: Currency & Amount -->
            <div class="w-full md:w-[60%] space-y-4">

                <!-- Currency Selection -->
                <div class="flex items-center justify-center space-x-2">
                    <label @click="currency='usd'"
                        class="w-full p-2 md:p-3 rounded-full cursor-pointer transition-all"
                        :class="currency === 'usd' ? 'bg-[#4FC9EE] text-white' : 'bg-white text-[#4FC9EE]'">
                        <h1 class="text-[15px] xl:text-[24px] font-[600] text-center">
                            {{ __('messages.usd') }}
                        </h1>
                        <input type="radio" name="currency" value="usd" class="hidden"
                            :checked="currency === 'usd'">
                    </label>
                </div>

                <!-- Donation Amount -->
                <div>
                    <input type="number" name="amount" placeholder="{{ __('messages.amount') }}"
                        value="{{ old('amount') }}" required step="0.01" :min="currency === 'usd' ? 0.01 : 100"
                        class="w-full xl:text-[30px] py-2 rounded-full text-white placeholder:text-white bg-[#4FC9EE] px-6 outline-none">
                    <p x-text="error" class="text-red-500 text-sm mt-1"></p>
                </div>

            </div>

            <!-- Right side: Submit Button -->
            <button type="submit"
                class="w-full md:w-[40%] h-full rounded-full bg-[#4FC9EE] shadow-sm drop-shadow-lg py-5 xl:py-9 mt-4 md:mt-0">
                <div class="flex items-center justify-center space-x-4 h-[48px] md:h-[60px]">
                    <div>
                        <img src="{{ asset('assets/images/donate.svg') }}" alt="Donate"
                            class="w-[50px] mx-auto object-contain">
                    </div>
                    <p class="xl:text-[30px] text-white font-[400] tracking-normal">
                        {{ __('messages.donate') }}
                    </p>
                </div>
            </button>
        </form>

    </section>

    <div
        class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto px-3 flex flex-wrap pb-[10rem] xl:pb-[12rem] overflow-hidden">
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

    <div class="w-full h-fit bg-[linear-gradient(85.15deg,_rgba(30,_30,_30,_0.8)_0.43%,_rgba(7,_32,_39,_0.64)_98.29%)]">
        <div
            class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full -translate-y-[20%] md:-translate-y-[28%]">
            <div
                class="w-full h-fit md:h-[35vh] lg:h-[30vh] xl:h-[50vh] 2xl:h-[40vh] flex flex-col md:flex-row pb-5 overflow-hidden">
                <div class="w-full max-sm:h-[32vh] md:w-[40%] md:h-full">
                    <img src="{{ asset('assets/images/Banners/banner_1.png') }}" alt="banner" data-aos="fade-right"
                        data-aos-duration="400"
                        class="w-full h-full object-cover object-center max-sm:rounded-t-[30px] md:rounded-l-[30px]" />
                </div>

                <div data-aos="fade-left" data-aos-duration="400"
                    class="flex flex-col xl:flex-row w-full md:w-[60%] md:h-full gap-1 lg:gap-[1rem] bg-[#4FC9EE] p-5 md:p-3 max-sm:rounded-b-[30px] md:rounded-r-[30px]">
                    <div
                        class="w-[100%] xl:w-[30%] flex xl:flex-col xl:justify-between items-center xl:items-start xl:ps-5 xl:py-5">
                        <span>
                            <img src="{{ asset('assets/images/icons/time.svg') }}" alt="icon"
                                class="w-[50px] h-[50px] xl:w-[100px] xl:h-[100px] object-cover object-center p-2">
                        </span>
                        <h1
                            class="text-[16px] xl:text-[30px] text-[#000000] font-[700] text-wrap {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
                            {{ __('messages.dsr') }}
                        </h1>
                    </div>

                    {{-- Dynamic List --}}
                    <div class="w-[100%] xl:w-[70%]">
                        <ul class="text-[#fff] space-y-1">
                            @foreach ($readings as $item)
                                <li data-aos="fade-left" data-aos-duration="600"
                                    class="text-[14px] xl:text-[23px] hover:bg-[#00AFD7]/70 py-1 lg:py-2 px-5 xl:px-10 font-kantumruy rounded-full">
                                    {{ app()->getLocale() === 'km' ? $item->title_km : $item->title_en }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Second Section --}}
        <div
            class="flex flex-col md:flex-row w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto gap-4 pb-10 xl:pb-0 md:-translate-y-[30%] xl:translate-x-0 overflow-hidden">

            <div class="max-sm:-translate-y-[40%] xl:w-[30%] overflow-hidden">
                <h1 data-aos="fade-right" data-aos-duration="200"
                    class="text-[20px] xl:text-[40px] xl:w-[300px] text-[#fff] font-bold mt-20 sm:mt-0">
                    {{ __('messages.rkbo') }}
                </h1>
                <p data-aos="fade-right" data-aos-duration="300" class="text-[12px] xl:text-[18px] text-[#fff]">
                    {{ __('messages.rkbo_content') }}
                </p>

                {{-- App Links --}}
                <div class="flex gap-2 mt-2">
                    <a href="https://play.google.com/store/apps/details?id=khmerbible.khm.org&hl=en&pli=1">
                        <img data-aos="fade-right" data-aos-duration="500"
                            src="{{ asset('assets/images/icons/android.png') }}" alt="android"
                            class="w-[10vh] h-full object-cover object-center" />
                    </a>
                    <a href="https://apps.apple.com/kh/app/khmer-bible-app/id1409575588">
                        <img data-aos="fade-right" data-aos-duration="400"
                            src="{{ asset('assets/images/icons/appstore.png') }}" alt="ios"
                            class="w-[10vh] h-full object-cover object-center" />
                    </a>
                </div>
            </div>

            {{-- Right Dynamic Section --}}
            <div
                class="flex xl:w-[70%] shadow-sm drop-shadow-lg {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
                <div class="w-[60%]">
                    <ul class="grid grid-cols-2 justify-center w-full h-full items-center">
                        @foreach ($versions as $index => $category)
                            @php
                                $bgColor = 'bg-[#71C6A5] col-span-1';
                                if ($category->slug === 'you-version-app') {
                                    $bgColor = 'bg-[#446EB6] col-span-2';
                                } elseif ($category->slug === 'khmer-old-version-khov') {
                                    $bgColor = 'bg-[#4FC9EE] col-span-1';
                                }
                            @endphp

                            <li data-aos="fade-right" data-aos-duration="{{ 300 + $index * 100 }}"
                                class="{{ $bgColor }} w-full h-full p-3">
                                <div class="flex flex-col">
                                    <h1 class="text-[16px] md:text-[14px] xl:text-[20px] text-white min-h-[60px]">
                                        {{ app()->getLocale() === 'en' ? $category->titleEn : $category->titleKm }}
                                    </h1>
                                    <a href="{{ url(app()->getLocale() . '/' . $category->slug) }}"
                                        class="w-fit bg-white text-[12px] xl:text-[24px] text-black rounded-full px-[15px] py-[2px] xl:px-[24px] mt-2">
                                        {{ __('messages.read') }}
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Right Image --}}
                <div data-aos="fade-left" data-aos-duration="600" class="w-[40%]">
                    <img src="{{ asset('assets/images/Banners/banner_2.png') }}" alt="banner"
                        class="w-full h-full object-cover object-center" />
                </div>
            </div>
        </div>
    </div>

    <div class="w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto py-10 px-5 overflow-hidden">
        <div class="flex flex-col xl:flex-row space-y-5 xl:space-x-5">
            <div class="w-full xl:w-[20%]">
                <div
                    class="flex flex-row xl:flex-col space-x-2 justify-center items-center xl:justify-start xl:items-start">
                    <span>
                        <img src="{{ asset('assets/images/icons/fb.svg') }}" alt="banner" data-aos="fade-right"
                            data-aos-offset="500" data-aos-duration='300'
                            class="w-[50px] h-[50px] xl:w-[150px] xl:h-[150px] object-cover object-center p-2" />
                    </span>
                    <h1 class="text-[16px] xl:text-[34px] text-[#4FC9EE] font-[700]" data-aos="fade-right"
                        data-aos-offset="500" data-aos-duration='400'>
                        {{ __('messages.ofb') }}
                    </h1>
                </div>
            </div>

            <div class="w-full xl:w-[80%]">
                <ul class="grid grid-cols-2 xl:grid-cols-3 justify-center gap-4 md:gap-[3rem] text-[#000]">
                    <li data-aos="fade-left" data-aos-offset="500" data-aos-duration='200'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_1') }}
                    </li>
                    <li data-aos="fade-left" data-aos-offset="500" data-aos-duration='300'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_2') }}
                    </li>
                    <li data-aos="fade-left" data-aos-offset="500" data-aos-duration='400'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_3') }}
                    </li>
                    <li data-aos="fade-left" data-aos-offset="500" data-aos-duration='500'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_4') }}
                    </li>
                    <li data-aos="fade-left" data-aos-offset="500" data-aos-duration='600'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_5') }}
                    </li>
                    <li data-aos="fade-left" data-aos-offset="500" data-aos-duration='700'
                        class="relative w-full text-[12px] xl:text-[16px] before:absolute before:content-[''] before:left-[-10px] before:top-0 before:right-0 before:w-[3px] before:h-full before:rounded-full before:bg-[#4FC9EE] whitespace-pre-line">
                        {{ __('messages.ofb_content_6') }}
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div
        class="w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto my-[1.5rem] px-3 py-[2rem] overflow-hidden {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
        <div class="grid grid-flow-col grid-rows-3 xl:grid-rows-2 gap-5 w-full h-full">

            <div class="w-full h-full flex flex-col md:flex-row row-span-1 xl:col-span-2">
                <img src="{{ asset('assets/images/Banners/banner_3.png') }}" alt="banner" data-aos="fade-right"
                    data-aos-offset="500" data-aos-duration='500'
                    class="w-full md:w-[50%] h-full object-cover object-center" />
                <div data-aos="fade-left" data-aos-offset="500" data-aos-duration='600'
                    class="w-full md:w-[50%] p-4 bg-[#00AFD7] space-y-[1rem] transition-all duration-300">
                    <h1 class="text-[16px] text-[#ffffff] text-balance font-semibold">
                        {{ __('messages.ofb_title') }}
                    </h1>
                    <div class="w-full h-[120px] md:h-[130px] xl:h-[200px] overflow-x-hidden overflow-y-auto">
                        <p class="text-[14px] text-[#ffffff] text-balance my-3">
                            {{ __('messages.ofb_content_7') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="w-full h-full flex flex-col md:flex-row row-span-1 xl:col-span-2">
                <img src="{{ asset('assets/images/Banners/banner_5.png') }}" alt="banner" data-aos="fade-right"
                    data-aos-offset="500" data-aos-duration='500'
                    class="w-full md:w-[50%] h-full object-cover object-center" />
                <div data-aos="fade-left" data-aos-offset="500" data-aos-duration='600'
                    class="w-full md:w-[50%] md:order-first xl:order-last p-4 bg-[#71c7a5] space-y-[1rem] transition-all duration-300">
                    <h1 class="text-[16px] text-[#ffffff] text-balance font-semibold">
                        {{ __('messages.ofb_title_1') }}
                    </h1>
                    <div class="w-full h-[120px] md:h-[130px] xl:h-[200px] overflow-x-hidden overflow-y-auto">
                        <p class="text-[14px] text-[#ffffff] text-balance my-3">
                            {{ __('messages.ofb_content_8') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="w-full md:h-[30vh] xl:h-full row-span-1 xl:row-span-2 flex flex-col md:flex-row xl:flex-col">
                <img src="{{ asset('assets/images/Banners/banner_4.png') }}" alt="banner" data-aos="fade-down"
                    data-aos-offset="500" data-aos-duration='500'
                    class="w-full md:w-[50%] xl:w-full h-full object-cover object-center" />
                <div data-aos="fade-up" data-aos-offset="500" data-aos-duration='600'
                    class="w-full md:w-[50%] xl:w-full h-full xl:h-[30vh] p-4 bg-[#456eb6] space-y-[1rem] transition-all duration-300">
                    <h1 class="text-[16px] text-[#ffffff] text-balance font-semibold">
                        {{ __('messages.ofb_title_2') }}
                    </h1>
                    <div class="w-full h-[120px] md:h-[130px] xl:h-[200px] overflow-x-hidden overflow-y-auto">
                        <p class="text-[14px] text-[#ffffff] text-balance my-3">
                            {{ __('messages.ofb_content_9') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
@endsection
