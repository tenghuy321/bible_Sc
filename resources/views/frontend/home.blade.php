@extends('layouts.master')
@section('css')
@endsection
@section('content')
    @include('components.loading')

    <section class="w-full h-[60vh] md:h-screen flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/banner.jpg') }}'); background-size: cover; background-position: center;">
        <div class="w-full max-w-7xl mx-auto text-center">
            <div class="text-[#fff] w-full" data-aos="fade-right" data-aos-duration="1000">
                <p class="text-[20px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">{{ __('messages.bible') }}</p>
                <h1 class="text-[30px] md:text-[50px] xl:text-[5rem] font-[600] leading-none">
                    {{ __('messages.everyone') }}
                </h1>
            </div>
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
            class="w-full xl:max-w-[70%] mx-auto flex flex-col md:flex-row items-stretch justify-center md:space-x-4 space-y-4 md:space-y-0">
            @csrf

            <div class="flex flex-1 items-stretch space-x-2">

                <!-- Currency Selection -->
                <label @click="currency='usd'"
                    class="w-full sm:flex-1 flex items-center justify-center rounded-full cursor-pointer transition-all px-4 py-3 md:py-2"
                    :class="currency === 'usd' ? 'bg-[#4FC9EE] text-white' : 'bg-white text-[#4FC9EE]'">
                    <h1 class="text-[15px] xl:text-[20px] font-[600] text-center">
                        {{ __('messages.usd') }}
                    </h1>
                    <input type="radio" name="currency" value="usd" class="hidden" :checked="currency === 'usd'">
                </label>

                <!-- Donation Amount -->
                <input type="number" name="amount" placeholder="{{ __('messages.amount') }}" value="{{ old('amount') }}"
                    required step="0.01" :min="currency === 'usd' ? 0.01 : 100"
                    class="w-full sm:flex-[2] text-white placeholder:text-white bg-[#4FC9EE] rounded-full px-6 py-3 md:py-2 outline-none text-[15px] xl:text-[20px]">
            </div>

            <!-- Right side: Submit Button -->
            <button type="submit"
                class="flex items-center justify-center flex-none md:w-[30%] rounded-full bg-[#4FC9EE] py-3 md:py-2">
                <div class="flex items-center justify-center space-x-3">
                    <img src="{{ asset('assets/images/donate.svg') }}" alt="Donate"
                        class="w-[30px] md:w-[40px] object-contain">
                    <p class="text-white text-[15px] xl:text-[20px] font-medium">
                        {{ __('messages.donate') }}
                    </p>
                </div>
            </button>
        </form>

    </section>


    <div class="w-full h-fit bg-[linear-gradient(85.15deg,_rgba(30,_30,_30,_0.8)_0.43%,_rgba(7,_32,_39,_0.64)_98.29%)]">
        <div
            class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full -translate-y-[8%] md:-translate-y-[28%]">
            <div
                class="w-full h-fit md:h-[35vh] lg:h-[50vh] 2xl:h-[40vh] flex flex-col md:flex-row pb-5 overflow-hidden">
                <div class="w-full max-sm:h-[32vh] md:w-[40%] md:h-full">
                    <img src="{{ asset('assets/images/Banners/banner_1.png') }}" alt="banner" data-aos="fade-right"
                        data-aos-duration="400"
                        class="w-full h-full object-cover object-center max-sm:rounded-t-[30px] md:rounded-l-[30px]" />
                </div>

                <div data-aos="fade-left" data-aos-duration="400"
                    class="flex flex-col lg:flex-row w-full md:w-[60%] md:h-full gap-1 lg:gap-[1rem] bg-[#4FC9EE] p-5 md:p-3 max-sm:rounded-b-[30px] md:rounded-r-[30px]">
                    <div
                        class="w-[100%] lg:w-[40%] xl:w-[30%] flex lg:flex-col lg:justify-between items-center lg:items-start xl:ps-5 xl:py-5">
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
                    <div class="w-[100%] lg:w-[60%] xl:w-[70%]">
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
            class="flex flex-col md:flex-row w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto gap-4 pb-10 xl:pb-0 md:-translate-y-[30%] lg:-translate-y-[20%] xl:translate-x-0 overflow-hidden">

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

    {{-- <div class="w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto py-10 px-5 overflow-hidden">
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
    </div> --}}

    <section class="w-full h-fit lg:max-w-[1200px] mx-auto py-10 px-2">
        <div class="my-5">
            <h1 class="text-gradient text-[20px] md:text-[25px] font-[600] max-w-[250px] mb-2 md:max-w-full">
                {{ app()->getLocale() === 'km' ? 'បច្ចុប្បន្នភាពចុងក្រោយ' : 'Latest Update' }}</h1>
            <hr class="w-full h-[2px] bg-[#000]">
        </div>
        <div class="w-full  grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 text-[#000] overflow-hidden">
            <div>
                @php
                    $mission_images = json_decode($latestMission->image, true) ?? [];
                @endphp
                <div class="relative w-full h-[300px] group overflow-hidden">
                    <div class="absolute left-0 top-4 bg-[#4FC9EE] px-4 py-1 z-10">
                        <h1 class="text-gradient text-[16px] md:text-[20px] font-[600] max-w-[250px] md:max-w-full">
                            {{ app()->getLocale() === 'km' ? 'បេសកកម្ម' : 'Mission' }}
                        </h1>
                    </div>

                    <img src="{{ asset($mission_images[0]) }}" alt=""
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 group-hover:bg-[#000]/50">
                        <h1 class="text-white text-[16px] md:text-[18px] font-semibold drop-shadow-md mb-2 z-10">
                            {{ app()->getLocale() === 'km' ? $latestMission->title_kh : $latestMission->title_en }}
                        </h1>

                        <div
                            class="max-h-0 overflow-hidden opacity-0 group-hover:max-h-[100px] group-hover:opacity-100 transition-all duration-500 ease-in-out rounded">
                            <div
                                class="text-[13px] text-white line-clamp-2 prose prose-p:text-white prose-li:m-0 prose-strong:text-white">
                                {!! app()->getLocale() === 'km' ? $latestMission->content_kh : $latestMission->content_en !!}
                            </div>

                            <div
                                class="mt-2 inline-block px-4 py-1.5 bg-white text-black text-[13px] rounded-full font-medium hover:bg-[#4FC9EE] hover:text-white transition-all duration-300">
                                <a href="{{ route('mission') }}">
                                    {{ app()->getLocale() === 'km' ? 'បេសកកម្មផ្សេងៗ' : 'More Mission' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                @php
                    $news_images = json_decode($latestNews->image, true) ?? [];
                @endphp
                <div class="relative w-full h-[300px] group overflow-hidden">
                    <div class="absolute left-0 top-4 bg-[#4FC9EE] px-4 py-1 z-10">
                        <h1 class="text-gradient text-[16px] md:text-[20px] font-[600] max-w-[250px] md:max-w-full">
                            {{ app()->getLocale() === 'km' ? 'ព័ត៌មាន' : 'News' }}
                        </h1>
                    </div>

                    <img src="{{ asset($news_images[0]) }}" alt=""
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 group-hover:bg-[#000]/50">
                        <h1 class="text-white text-[16px] md:text-[18px] font-semibold drop-shadow-md mb-2 z-10">
                            {{ app()->getLocale() === 'km' ? $latestNews->title_kh : $latestNews->title_en }}
                        </h1>

                        <div
                            class="max-h-0 overflow-hidden opacity-0 group-hover:max-h-[100px] group-hover:opacity-100 transition-all duration-500 ease-in-out rounded">
                            <div
                                class="text-[13px] text-white line-clamp-2 prose prose-p:text-white prose-li:m-0 prose-strong:text-white">
                                {!! app()->getLocale() === 'km' ? $latestNews->content_kh : $latestNews->content_en !!}
                            </div>

                            <div>
                                <div
                                    class="mt-2 inline-block px-4 py-1.5 bg-white text-black text-[13px] rounded-full font-medium hover:bg-[#4FC9EE] hover:text-white transition-all duration-300">
                                    <a href="{{ route('more_details', ['id' => $latestNews->id]) }}">
                                        {{ app()->getLocale() === 'km' ? 'ព័ត៌មានបន្ថែម' : 'Read More' }}
                                    </a>
                                </div>

                                <div
                                    class="mt-2 inline-block px-4 py-1.5 bg-white text-black text-[13px] rounded-full font-medium hover:bg-[#4FC9EE] hover:text-white transition-all duration-300">
                                    <a href="{{ route('news_item') }}">
                                        {{ app()->getLocale() === 'km' ? 'ព័ត៌មានផ្សេងៗ' : 'More News' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                @php
                    preg_match(
                        '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]+)/',
                        $latestVlog->video_Url,
                        $matches,
                    );
                    $videoId = $matches[1] ?? null;

                    $thumbnailUrl = $videoId
                        ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"
                        : asset('images/default-thumbnail.jpg');
                @endphp

                <div class="relative w-full h-[300px] group overflow-hidden cursor-pointer"
                    onclick="openVideoModal('{{ $videoId }}')">
                    <div class="absolute left-0 top-4 bg-[#4FC9EE] px-4 py-1 z-10">
                        <h1 class="text-gradient text-[16px] md:text-[20px] font-[600] max-w-[250px] md:max-w-full">
                            {{ app()->getLocale() === 'km' ? 'វិដេអូ' : 'Vlog' }}
                        </h1>
                    </div>

                    <img src="{{ $thumbnailUrl }}" alt="Vlog Thumbnail"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 group-hover:bg-[#000]/50">
                        <h1 class="text-white text-[16px] md:text-[18px] font-semibold drop-shadow-md mb-2 z-10">
                            {{ app()->getLocale() === 'km' ? $latestVlog->title_km : $latestVlog->title_en }}
                        </h1>

                        <div
                            class="max-h-0 overflow-hidden opacity-0 group-hover:max-h-[100px] group-hover:opacity-100 transition-all duration-500 ease-in-out rounded">
                            <div
                                class="text-[13px] text-white line-clamp-2 prose prose-p:text-white prose-li:m-0 prose-strong:text-white">
                                {!! app()->getLocale() === 'km' ? $latestVlog->paragraph_km : $latestVlog->paragraph_en !!}
                            </div>

                            <div
                                class="mt-2 inline-block px-4 py-1.5 bg-white text-black text-[13px] rounded-full font-medium hover:bg-[#4FC9EE] hover:text-white transition-all duration-300">
                                <a href="{{ route('vlogs') }}">
                                    {{ app()->getLocale() === 'km' ? 'វីដេអូផ្សេងៗ' : 'More Video' }}
                                </a>
                            </div>
                        </div>


                    </div>
                </div>

                {{-- YouTube Video Modal --}}
                <div id="videoModal"
                    class="fixed inset-0 z-50 hidden bg-black/70 flex items-center justify-center transition-opacity duration-300">
                    <div
                        class="relative bg-black rounded-lg overflow-hidden w-[90%] max-w-3xl aspect-video transform scale-90 opacity-0 transition-all duration-300">
                        <iframe id="videoFrame" class="w-full h-full" src="" frameborder="0"
                            allowfullscreen></iframe>
                        <button onclick="closeVideoModal()"
                            class="absolute top-2 right-2 text-white text-2xl font-bold hover:text-gray-300">&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div
        class="w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto my-[1.5rem] px-3 py-[2rem] overflow-hidden {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
        <div class="grid grid-flow-col grid-rows-3 xl:grid-rows-2 gap-5 w-full h-full">

            <div class="w-full h-full flex flex-col md:flex-row row-span-1 xl:col-span-2">
                <img src="{{ asset('assets/images/Banners/banner_3.png') }}" alt="banner" data-aos="fade-right"
                    data-aos-duration='500' class="w-full md:w-[50%] h-full object-cover object-center" />
                <div data-aos="fade-left" data-aos-duration='600'
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
                    data-aos-duration='500' class="w-full md:w-[50%] h-full object-cover object-center" />
                <div data-aos="fade-left" data-aos-duration='600'
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
                    data-aos-duration='500' class="w-full md:w-[50%] xl:w-full h-full object-cover object-center" />
                <div data-aos="fade-up" data-aos-duration='600'
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

    <script>
        const modal = document.getElementById('videoModal');
        const modalContent = modal.querySelector('div');
        const iframe = document.getElementById('videoFrame');

        function openVideoModal(videoId) {
            if (!videoId) return;
            iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-90', 'opacity-0');
            }, 10);
        }

        function closeVideoModal() {
            modalContent.classList.add('scale-90', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                iframe.src = '';
            }, 200);
        }

        // Close on background click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeVideoModal();
        });

        // Close on ESC key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeVideoModal();
        });
    </script>
@endsection
