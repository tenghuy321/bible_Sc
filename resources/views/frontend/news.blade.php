@extends('layouts.master')
@section('content')
    @php
        $locale = app()->getLocale();
    @endphp

    <section class="w-full h-[60vh] md:h-screen big-hight flex items-center justify-center overflow-hidden"
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

    {{-- <div
        class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full my-[1rem] {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }} flex flex-wrap gap-[1rem] justify-center">
        <div class="w-full lg:w-[48%]">
            <h1 data-aos="fade-right" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="500"
                class="font-bold text-wrap text-[#50c9ee] md:whitespace-pre-line {{ app()->getLocale() === 'km' ? 'font-krasar text-[20px]' : 'font-gotham text-[20px] leading-[20px]' }}">
                {{ __('messages.siem_reap') }}
            </h1>
            <iframe class="w-full h-[30vh] md:h-[50vh] my-3"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5271.460803358791!2d103.8543079!3d13.376731399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31101703918716ff%3A0x2871b10be0d842dd!2sThe%20Bible%20Society%20in%20Cambodia%2C%20Siem%20Reap!5e1!3m2!1sen!2skh!4v1753933203503!5m2!1sen!2skh"
                loading="lazy"></iframe>
        </div>

        <div class="w-full lg:w-[48%]">
            <h1 data-aos="fade-right" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="500"
                class="font-bold text-wrap text-[#50c9ee] md:whitespace-pre-line {{ app()->getLocale() === 'km' ? 'font-krasar text-[20px]' : 'font-gotham text-[20px] leading-[20px]' }}">
                {{ __('messages.Bible_Distribution_Center') }}
            </h1>
            <iframe class="w-full h-[30vh] md:h-[50vh] my-3"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d663.5346877170442!2d104.8583901!3d11.574516!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951e8cd21db71%3A0xd83eb18e9b850632!2sThe%20Bible%20Society%20in%20Cambodia!5e1!3m2!1sen!2skh!4v1753933347744!5m2!1sen!2skh"
                loading="lazy"></iframe>
        </div>
    </div> --}}

    <section id="news" class="w-full max-w-7xl mx-auto px-4 py-4 md:py-10">
        <div class="mb-10">
            <h1 class="text-gradient text-[20px] md:text-[25px] font-[600] max-w-[250px] md:max-w-full">{{ app()->getLocale() === 'km' ? 'ព័ត៌មាន' : 'News' }}</h1>
            <hr class="w-full h-[2px] bg-[#000]">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($news as $item)
                @php
                    $images = json_decode($item->image, true) ?? [];
                @endphp
                <div class="relative w-full h-[300px] group overflow-hidden rounded-lg">

                    <img src="{{ asset($images[0]) }}" alt=""
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <div
                        class="absolute inset-0 flex flex-col justify-end group-hover:bg-[#000]/50 p-4">

                        <h1
                            class="text-white text-[16px] md:text-[18px] font-semibold drop-shadow-md mb-2 transition-all duration-300">
                            {{ app()->getLocale() === 'km' ? $item->title_kh : $item->title_en }}
                        </h1>

                        <div
                            class="max-h-0 overflow-hidden opacity-0 group-hover:max-h-[100px] group-hover:opacity-100 transition-all duration-500 ease-in-out rounded">
                            <div
                                class="text-[13px] text-white line-clamp-2 prose prose-p:text-white prose-li:m-0 prose-strong:text-white">
                                {!! app()->getLocale() === 'km' ? $item->content_kh : $item->content_en !!}
                            </div>

                            <div
                                class="mt-2 inline-block px-4 py-1.5 bg-white text-black text-[13px] rounded-full font-medium hover:bg-[#4FC9EE] hover:text-white transition-all duration-300">
                                <a href="{{ route('more_details', ['id' => $item->id]) }}">
                                    {{ app()->getLocale() === 'km' ? 'ព័ត៌មានបន្ថែម' : 'Read More' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
