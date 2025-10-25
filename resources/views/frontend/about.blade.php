@extends('layouts.master')
@section('content')
    @include('components.loading')

    @php
        $locale = app()->getLocale();
        $Experience = [
            // ['id' => 1, 'year' => 'messages.1804', 'content' => 'messages.1804_content'],
            ['id' => 1, 'year' => 'messages.1892', 'content' => 'messages.1892_content'],
            ['id' => 2, 'year' => 'messages.1955', 'content' => 'messages.1955_content'],
            ['id' => 3, 'year' => 'messages.1899', 'content' => 'messages.1899_content'],
            ['id' => 4, 'year' => 'messages.1962', 'content' => 'messages.1962_content'],
            ['id' => 5, 'year' => 'messages.1923', 'content' => 'messages.1923_content'],
            ['id' => 6, 'year' => 'messages.1968', 'content' => 'messages.1968_content'],
            ['id' => 7, 'year' => 'messages.1954', 'content' => 'messages.1954_content'],
            ['id' => 8, 'year' => 'messages.1975_1992', 'content' => 'messages.1975_1992_content'],
        ];
    @endphp
    <section class="w-full h-[60vh] lg:h-screen big-hight flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/new-banner.jpg') }}'); background-size: cover; background-position: center;">
    </section>

    <div
        class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full translate-y-[-15%] xl:translate-y-[-30%] shadow-sm drop-shadow-md">
        <div class="w-full h-full min-h-[20vh] overflow-hidden">
            <div
                class="text-[#fff] flex flex-col w-full h-full gap-[1rem] p-10 lg:p-20 bg-[linear-gradient(0deg,#4FC9EE,#4FC9EE)] text-center rounded-[30px] lg:rounded-full">
                <h1 data-aos="fade-left" data-aos-duration="400" class="text-[20px] xl:text-[30px] ">
                    {{ __('messages.about_us_title') }}
                </h1>
                <p data-aos="fade-right" data-aos-duration="400" class="text-[12px] md:text-[14px] xl:text-[16px]">
                    {{ __('messages.about_us_content') }}
                </p>
            </div>
        </div>
    </div>


    <div class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full pb-10 px-2" x-data="{ expandedIndex: null }">
        <h1 class="text-[20px] xl:text-[30px] text-[#4FC9EE] text-center pb-16">
            {{ app()->getLocale() === 'km' ? 'កាលប្បវត្តនៃព័ន្ធកិច្ចរបស់សមាគមព្រះគម្ពីរនៅកម្ពុជា' : 'Timeline of The Bible Society in Cambodia’s Ministry' }}
    </h1>

        {{-- <ul class="space-y-[1rem] md:space-y-0 md:flex gap-5 flex-wrap items-start overflow-hidden">
            @foreach ($Experience as $index => $item)
                <li class="w-full md:w-[48%] flex flex-col items-end" data-aos="fade-right" data-aos-duration="500">
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
        </ul> --}}

        <ul class="space-y-[1rem] md:space-y-0 md:flex gap-5 flex-wrap items-start overflow-hidden">
            @foreach ($Experience as $index => $item)
                <li class="w-full md:w-[48%] flex flex-col items-end" data-aos="fade-right" data-aos-duration="500">
                    <div class="w-full flex flex-col xl:flex-row gap-2">
                        <div class="text-[18px] text-nowrap lg:w-[25%] leading-5 text-start lg:text-end text-white">
                            <h1
                                class="inline-block h-fit px-4 py-1 rounded-full
                                {{ $item['id'] == 1 ? 'bg-[#EB5E38]' : '' }}
                                {{ $item['id'] == 2 ? 'bg-[#53BE9E]' : '' }}
                                {{ $item['id'] == 3 ? 'bg-[#38B6AF]' : '' }}
                                {{ $item['id'] == 4 ? 'bg-[#EB5E38]' : '' }}
                                {{ $item['id'] == 5 ? 'bg-[#2284E0]' : '' }}
                                {{ $item['id'] == 6 ? 'bg-[#38B6AF]' : '' }}
                                {{ $item['id'] == 7 ? 'bg-[#EA5454]' : '' }}
                                {{ $item['id'] == 8 ? 'bg-[#E0C722]' : '' }}">
                                {{ __($item['year']) }}</h1>
                        </div>

                        <p class="text-[14px] text-balance lg:w-[75%] leading-5">
                            {{ __($item['content']) }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto py-10">
        <hr clfjlkfjlkfjass="w-full h-[2px] bg-[#000]">
    </div>

    <div class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto px-3 flex flex-wrap pb-10 overflow-hidden">
        <div class="w-full lg:w-[40%] xl:w-[30%] flex items-center gap-2">
            <div>
                <img data-aos="fade-down" data-aos-duration="400" src="{{ asset('assets/images/icons/mission.svg') }}"
                    alt="banner" class="w-[50px] h-[50px] xl:w-[100px] xl:h-[100px] object-cover object-center p-2">
            </div>
            <h1 data-aos="fade-right" data-aos-duration="500"
                class="text-[20px] md:text-[30px] xl:text-[40px] text-[#4FC9EE] text-wrap">
                {{ __('messages.sop') }}
            </h1>
        </div>

        <div data-aos="fade-left" data-aos-duration="500" class="w-full lg:w-[60%] xl:w-[70%]">
            <ul class="list-disc text-[#4FC9EE] text-[14px] md:text-[16px] xl:text-[20px]">
                <li>{{ app()->getLocale() === 'km' ? 'ចង់ឃើញគ្រិស្តបរិស័ទទាំងអស់​ និងមនុស្សគ្រប់រូបមានព្រះគម្ពីរអានផ្ទាល់ខ្លួនដែលជាភាសារបស់គេផ្ទាល់​ និងអាចជ្រើសរើសប្រភេទព្រះគម្ពីរបាន។' : 'To see all Christians and every person have their own Bible to read — in their own language and with the ability to choose the version they prefer.' }}
                </li>
                <li>{{ app()->getLocale() === 'km' ? 'ចង់ឃើញគ្រិស្តបរិស័ទទាំងអស់ និងមនុស្សគ្រប់រូបទទួលបានការអប់រំផ្លូវចិត្ត​ ឱ្យចេះស្រឡាញ់ អត់ឱន អធ្យាស្រ័យគ្នាទៅវិញទៅមក និងរស់នៅក្នុងភាពសុខដុមរមនាជាមួយគ្នាតាមរយៈព្រះគម្ពីរដែលជាព្រះបន្ទូលរបស់ព្រះជាម្ចាស់នៃយើង។' : 'To see all Christians and every person receive spiritual education that teaches them to love, be patient, forgive one another, and live together in harmony — through the Bible, which is the Word of our God.' }}
                </li>
                <li>{{ app()->getLocale() === 'km' ? 'អនុវត្តតាមបេសកម្មដ៏ថ្លៃថ្លារបស់សមាគមព្រះគម្ពីរសកល និងធានានិរន្តភាពនៃបេសកកម្មរបស់សមាគមព្រះគម្ពីរដែលមាននៅព្រះរាជាណាចក្រកម្ពុជាចាប់តាំងពីឆ្នាំ១៨៩២។' : 'To carry out the noble mission of the United Bible Societies and ensure the continuity of the Bible Society’s mission in the Kingdom of Cambodia since 1892.' }}
                </li>
            </ul>
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
                    <ul class="w-[80%] mx-auto pt-2">
                        <li data-aos="fade-right" data-aos-duration="500">
                            <h1
                                class="text-[16px] md:text-[20px] text-[#fff] xl:text-[32px] font-semibold text-center xl:text-start leading-none">
                                {{ __('messages.our_mission') }}
                            </h1>
                            <p class="text-[14px] md:text-[16px] xl:text-[20px] text-[#fff] text-center xl:text-start pt-2">
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
                    <ul class="w-[80%] mx-auto pt-2">
                        <li data-aos="fade-right" data-aos-duration="500">
                            <h1
                                class="text-[16px] md:text-[20px] text-[#fff] xl:text-[32px] font-semibold text-center xl:text-start leading-none">
                                {{ __('messages.our_vision') }}
                            </h1>
                            <p class="text-[14px] md:text-[16px] xl:text-[20px] text-[#fff] text-center xl:text-start pt-2">
                                {{ __('messages.our_vision_content') }}
                            </p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto py-10 px-5 overflow-hidden">
        <div class="flex flex-col xl:flex-row items-center space-y-5 xl:space-x-5">
            <div class="w-full xl:w-[40%]">
                <div class="flex space-x-2 justify-center items-center">
                    <div class="w-[50px] h-[50px] xl:w-[100px] xl:h-[100px]" data-aos="fade-right"
                            data-aos-duration='300'>
                        <img src="{{ asset('assets/images/icons/fb.svg') }}" alt="banner"
                            class="w-full h-full object-cover object-center p-2" />
                    </div>
                    <h1 class="text-[20px] md:text-[30px] xl:text-[40px] text-[#4FC9EE]">
                        {{ __('messages.ofb') }}
                    </h1>
                </div>
            </div>

            <div class="w-full xl:w-[60%]">
                <div data-aos="fade-left" data-aos-duration="200"
                    class="relative w-full text-[14px] md:text-[16px] xl:text-[20px] whitespace-pre-line
                    before:absolute before:content-[''] before:left-[-8px] before:top-0 before:w-[2px] before:h-full before:bg-[#4FC9EE]
                    after:absolute after:content-[''] after:left-[-12px] after:top-0 after:w-[10px] after:h-[10px] after:rounded-full after:bg-[#4FC9EE]
                    ">
                    <ul class="pl-4">
                        <li class="text-[14px] md:text-[16px] bg-[#fff] px-4 pb-5 rounded-r-[50px]">
                            {{ __('messages.ofb_content_1') }}</li>
                        <li class="text-[14px] md:text-[16px] bg-[#D9D9D9] px-4 pb-5 rounded-r-[50px]">
                            {{ __('messages.ofb_content_2') }}</li>
                        <li class="text-[14px] md:text-[16px] bg-[#fff] px-4 pb-5 rounded-r-[50px]">
                            {{ __('messages.ofb_content_3') }}</li>
                        <li class="text-[14px] md:text-[16px] bg-[#D9D9D9] px-4 pb-5 rounded-r-[50px]">
                            {{ __('messages.ofb_content_4') }}</li>
                        <li class="text-[14px] md:text-[16px] bg-[#fff] px-4 pb-5 rounded-r-[50px]">
                            {{ __('messages.ofb_content_5') }}</li>
                        <li class="text-[14px] md:text-[16px] bg-[#D9D9D9] px-4 pb-5 rounded-r-[50px]">
                            {{ __('messages.ofb_content_6') }}</li>
                    </ul>
                    <span
                        class="absolute left-[-12px] bottom-0 w-[10px] h-[10px] bg-[#4FC9EE] rounded-full content-['']"></span>
                </div>
            </div>
        </div>
    </div>

    <div
        class="w-full bg-gradient-to-r from-[#1E1E1E] to-[#413F3F] p-3 shadow drop-shadow-2xl {{ $locale === 'km' ? 'font-krasar' : 'font-gotham' }}">
        <div class="p-3 text-center">
            <h1 class="text-[20px] md:text-[30px] xl:text-[40px] text-[#4FC9EE] font-bold mt-2">
                {{ __('messages.our_core_value') }}
            </h1>
        </div>

        <ul
            class="w-full max-w-[520px] md:max-w-[720px] xl:max-w-[1200px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-[1vw] justify-center p-10">
            <li class="text-center" data-aos="fade-right" data-aos-duration="500">
                <h1 class="text-[20px] xl:text-[30px] text-[#fff]">
                    {{ __('messages.ocv_01') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_01_content') }}
                </p>
            </li>
            <li class="text-center" data-aos="fade-right" data-aos-duration="500">
                <h1 class="text-[20px] xl:text-[30px] text-[#fff]">
                    {{ __('messages.ocv_02') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_02_content') }}
                </p>
            </li>
            <li class="text-center" data-aos="fade-right" data-aos-duration="500">
                <h1 class="text-[20px] xl:text-[30px] text-[#fff]">
                    {{ __('messages.ocv_03') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_03_content') }}
                </p>
            </li>
            <li class="text-center" data-aos="fade-right" data-aos-duration="500">
                <h1 class="text-[20px] xl:text-[30px] text-[#fff]">
                    {{ __('messages.ocv_04') }}
                </h1>
                <p class="text-[14px] xl:text-[20px] text-[#fff]">
                    {{ __('messages.ocv_04_content') }}
                </p>
            </li>
        </ul>
    </div>


    <section class="relative w-full h-full z-10 overflow-hidden">
        <div class="p-0 absolute inset-0 bg-[#D9D9D9] h-[400px] md:h-[400px] lg:h-[600px] z-1"></div>
        <div class="relative w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto my-10">
            @foreach ($stuffs as $index => $stuff)
                @php
                    $images = json_decode($stuff->image, true) ?? [];
                @endphp

                <div class="text-center py-5 md:py-10" data-aos="fade-right" data-aos-duration="500">
                    <h1 class="text-[20px] md:text-[30px] xl:text-[40px] text-[#4FC9EE] font-bold">
                        {{ app()->getLocale() === 'km' ? $stuff->title_kh : $stuff->title_en }}</h1>
                    <div class="text-[14px] md:text-[16px] xl:text-[20px] text-[#000] px-0 md:px-20 py-5">
                        {!! app()->getLocale() === 'km' ? $stuff->content_kh : $stuff->content_en !!}</div>
                </div>

                <div class="w-full" data-aos="fade-right" data-aos-duration="500">
                    <div class="swiper MissionSwiper w-full h-full">
                        <div class="swiper-wrapper w-full h-full">
                            @foreach ($images as $img)
                                <div class="swiper-slide w-full h-full">
                                    <img src="{{ asset($img) }}" alt="" loading="lazy"
                                        class="w-full h-[250px] md:h-[400px] xl:h-[600px] rounded-[30px] object-cover object-bottom">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="px-4">
        <div class="relative w-full h-full bg-[#D9D9D9] rounded-[30px] pb-10 overflow-hidden">
            <div class="relative w-full h-fit max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto my-10">
                @foreach ($boards as $index => $board)
                    @php
                        $images = json_decode($board->image, true) ?? [];
                    @endphp

                    <div class="text-center py-5 md:py-10" data-aos="fade-right" data-aos-duration="500">
                        <h1 class="text-[20px] md:text-[30px] xl:text-[40px] text-[#4FC9EE] font-bold">
                            {{ app()->getLocale() === 'km' ? $board->title_kh : $board->title_en }}</h1>
                        <div class="text-[14px] md:text-[16px] xl:text-[20px] text-[#000] px-0 md:px-20 py-5">
                            {!! app()->getLocale() === 'km' ? $board->content_kh : $board->content_en !!}</div>
                    </div>

                    <div class="w-full" data-aos="fade-right" data-aos-duration="500">
                        <div class="swiper MissionSwiper w-full h-full">
                            <div class="swiper-wrapper w-full h-full">
                                @foreach ($images as $img)
                                    <div class="swiper-slide w-full h-full ">
                                        <img src="{{ asset($img) }}" alt="" loading="lazy"
                                            class="w-full h-[250px] md:h-[400px] xl:h-[600px] rounded-[30px] drop-shadow-xl object-cover object-bottom">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- map --}}
    <section class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full my-[1rem]">
        <div class="p-3 text-center">
            <h1 class="text-[20px] md:text-[30px] xl:text-[40px] text-[#4FC9EE] font-bold mt-2">
                {{-- {{ __('messages.our_core_value') }} --}}
                {{ app()->getLocale() === 'km' ? "ទីតាំងសមាគមព្រះគម្ពីរនៅកម្ពុជា" : "ទីតាំងសមាគមព្រះគម្ពីរនៅកម្ពុជា" }}
            </h1>
        </div>

        <div class="flex flex-wrap gap-[1rem] justify-center py-5 overflow-hidden">

            {{-- Bible Distribution Center --}}
            <div class="w-full lg:w-[48%]" data-aos="fade-right" data-aos-duration="500">
                <h1
                    class="font-bold text-center text-wrap text-[#50c9ee] {{ app()->getLocale() === 'km' ? 'font-krasar text-[20px]' : 'font-gotham text-[20px] leading-[20px]' }}">
                    {{ app()->getLocale() === 'km' ? "សមាគមព្រះគម្ពីរភ្នំពេញ" : "សមាគមព្រះគម្ពីរភ្នំពេញ" }}
                </h1>
                <iframe class="w-full h-[40vh] md:h-[50vh] my-5 rounded-[20px] md:rounded-[50px]"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d663.5346877170442!2d104.8583901!3d11.574516!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951e8cd21db71%3A0xd83eb18e9b850632!2sThe%20Bible%20Society%20in%20Cambodia!5e1!3m2!1sen!2skh!4v1753933347744!5m2!1sen!2skh"
                    loading="lazy"></iframe>
            </div>

            {{-- Siem Reap --}}
            <div class="w-full lg:w-[48%]" data-aos="fade-left" data-aos-duration="500">
                <h1 data-aos="fade-right" data-aos-anchor="#example-anchor" data-aos-offset="500"
                    data-aos-duration="500"
                    class="font-bold text-center text-wrap text-[#50c9ee] {{ app()->getLocale() === 'km' ? 'font-krasar text-[20px]' : 'font-gotham text-[20px] leading-[20px]' }}">
                    {{ app()->getLocale() === 'km' ? "សមាគមព្រះគម្ពីរសៀមរាប" : "សមាគមព្រះគម្ពីរសៀមរាប" }}
                </h1>
                <iframe class="w-full h-[40vh] md:h-[50vh] my-5 rounded-[20px] md:rounded-[50px]"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5271.460803358791!2d103.8543079!3d13.376731399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31101703918716ff%3A0x2871b10be0d842dd!2sThe%20Bible%20Society%20in%20Cambodia%2C%20Siem%20Reap!5e1!3m2!1sen!2skh!4v1753933203503!5m2!1sen!2skh"
                    loading="lazy"></iframe>
            </div>
        </div>
    </section>

    {{-- image --}}
    <section class="relative w-full h-[20vh] sm:h-[30vh] md:h-[40vh]">
        <img src="{{ asset('assets/images/Banners/map_img.png') }}" alt="" class="w-full h-full object-cover object-top">
    </section>
@endsection
