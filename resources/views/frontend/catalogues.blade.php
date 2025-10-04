@extends('layouts.master')
@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="w-full h-[60vh] md:h-screen bg-gray-100 flex items-center justify-center "
        style="background-image: url('{{ asset('assets/images/Banners/cata_banner.png') }}'); background-size: cover; background-position: center;">

        <div class="relative flex justify-between items-center max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] md:space-x-[8rem] xl:space-x-[14rem] overflow-hidden">
            <div class="w-full">
                <p data-aos="fade-right" data-aos-duration="400"
                    class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">
                    សមាគមព្រះគម្ពីរនៅកម្ពុជា
                </p>

                <h1 data-aos="fade-right" data-aos-duration="500"
                    class="font-bold text-wrap text-[#ffffff]
                    {{ $locale === 'km'
                        ? 'text-[20px] md:text-[50px] xl:text-[5rem]'
                        : 'text-[20px] leading-[20px] md:text-[50px] md:leading-[50px] xl:text-[5rem] xl:leading-[5rem]' }}">
                    {{ __('messages.welcome') }}
                </h1>
            </div>

            <p data-aos="fade-left" data-aos-duration="600"
                class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400]">
                {{ __('messages.quote') }}
            </p>
        </div>
    </div>

    <div
        class="w-full max-w-7xl mx-auto min-h-[50vh] bg-[linear-gradient(85.15deg,_rgba(30,_30,_30,_0.8)_0.43%,_rgba(7,_32,_39,_0.64)_98.29%)] backdrop-blur-[10px] shadow-[0px_50px_50px_-40px_rgba(0,_0,_0,_0.25)] rounded-[30px] border-[2px] border-solid border-[#575757] translate-y-[-20%] md:translate-y-[-25%] xl:translate-y-[-35%] p-6 md:p-12">
        <h1
            class="text-[16px] md:text-[24px] font-medium text-[#4FC9EE] {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
            {{ __('messages.cata_title') }}
        </h1>

        <div
            class="w-full h-full md:h-fit flex flex-wrap justify-center gap-2 md:gap-[1rem] mt-4 overflow-y-auto overflow-x-hidden">
            @foreach ($catalogue as $cata)
                <a href="{{ route('catalogue.show', $cata->slug) }}">
                    <div
                        class="w-[150px] h-[110px] md:w-[180px] md:h-[120px] xl:w-[200px] xl:h-[150px] mx-auto bg-white shadow drop-shadow-lg p-4 rounded-[20px]">
                        <img src="{{ $cata->image ? asset($cata->image) : 'https://ui-avatars.com/api/?name=' . urlencode($cata->name_en) }}"
                            alt="{{ $cata->name_en }}" class="w-full h-full object-contain object-center">
                    </div>
                    <h1
                        class="w-[120px] mx-auto text-center text-[12px] text-[#fff] uppercase text-wrap my-2 {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
                        {{ app()->getLocale() === 'km' ? $cata->name_km : $cata->name_en }}
                    </h1>
                </a>
            @endforeach
        </div>
    </div>
@endsection
