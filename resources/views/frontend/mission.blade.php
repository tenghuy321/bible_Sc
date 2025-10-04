@extends('layouts.master')

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="w-full h-[60vh] md:h-screen bg-gray-100 flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/ms_banner.png') }}'); background-size: cover; background-position: center;">
        <div
            class="relative flex justify-between items-center max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] md:space-x-[8rem] xl:space-x-[14rem]">
            <div class="w-full">
                <p data-aos="fade-right" data-aos-duration="400"
                    class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-krasar">
                    សមាគមព្រះគម្ពីរនៅកម្ពុជា
                </p>
                <h1 data-aos="fade-right" data-aos-duration="500"
                    class="font-bold text-wrap text-[#ffffff] text-[20px] md:text-[50px] xl:text-[5rem]">
                    {{ __('messages.welcome') }}
                </h1>
            </div>
            <p data-aos="fade-left" data-aos-duration="600"
                class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400]">
                {{ __('messages.quote') }}
            </p>
        </div>
    </div>

    <div class="w-full h-fit bg-[#292929] p-5">
        <div class="flex gap-2 md:gap-[1rem] p-3 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden">
            <div class="w-[30%] md:w-[40%]">
                <img data-aos="fade-right" data-aos-duration="400"
                    src="{{ asset('assets/images/Banners/ms.png') }}" alt="banner"
                    class="w-[30vh] h-[20vh] md:w-full md:h-full object-cover object-center" />
            </div>
            <div data-tip="Scroll For Read More" class="tooltip w-[70%] md:w-[60%] pe-2">
                <h1 data-aos="fade-left" data-aos-duration="400"
                    class="text-[16px] md:text-[24px] text-[#4FC9EE] font-bold">
                    {{ __('messages.title') }}
                </h1>
                <p data-aos="fade-right" data-aos-duration="600"
                    class="text-[12px] md:text-[18px] text-pretty text-[#fff] whitespace-pre-line w-full h-[14vh] lg:h-[20vh] overflow-y-auto">
                    {{ __('messages.content') }}
                </p>
            </div>
        </div>

        <div class="flex gap-2 md:gap-[1rem] p-3 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden">
            <div data-tip="Scroll For Read More" class="tooltip w-[70%] md:w-[60%] pe-2">
                <h1 data-aos="fade-right" data-aos-duration="400"
                    class="text-[16px] md:text-[24px] text-[#4FC9EE] font-bold">
                    {{ __('messages.title_1') }}
                </h1>
                <p data-aos="fade-right" data-aos-duration="600"
                    class="text-[12px] md:text-[18px] text-pretty text-[#fff] whitespace-pre-line w-full h-[14vh] lg:h-[20vh] overflow-y-auto">
                    {{ __('messages.content_1') }}
                </p>
            </div>
            <div class="w-[30%] md:w-[40%]">
                <img data-aos="fade-left" data-aos-duration="400"
                    src="{{ asset('assets/images/Banners/ms_1.png') }}" alt="banner"
                    class="w-[30vh] h-[20vh] md:w-full md:h-full object-cover object-center" />
            </div>
        </div>
    </div>

    <div class="w-full h-fit bg-[#446EB6] overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div data-aos="fade-right" data-aos-duration="400"
                class="w-full md:w-[50%]">
                <img src="{{ asset('assets/images/Banners/ms_2.png') }}" alt="banner"
                    class="w-full h-full object-cover object-center" />
            </div>
            <div class="w-full md:w-[50%] p-4 md:max-w-[720px] xl:max-w-[1200px] mx-auto">
                <h1 data-aos="fade-right" data-aos-duration="400"
                    class="text-[16px] md:text-[24px] text-[#4FC9EE] font-bold">
                    {{ __('messages.title_2') }}
                </h1>
                <p data-aos="fade-left" data-aos-duration="600"
                    class="text-[12px] md:text-[18px] text-[#fff] whitespace-pre-line">
                    {{ __('messages.content_2') }}
                </p>
            </div>
        </div>
    </div>

    <div class="w-full h-fit bg-[#fff]">
          <div class='w-full p-4 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden'>
              <p data-aos="fade-left" data-aos-duration='400'
               class='text-[12px] md:text-[18px] text-pretty'>
                 {{ __('messages.content_3') }}
              </p>
              <div class='flex items-center justify-between'>
                <span class='text-[50px] font-[700] text-[#4FC9EE]'>“”</span>
                <span class='text-[16px] text-[#4FC9EE] font-bold italic'>{{ __('messages.Revelation') }} 5:13</span>
              </div>
          </div>
      </div>
@endsection
