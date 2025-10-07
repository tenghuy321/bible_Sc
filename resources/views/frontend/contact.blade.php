@extends('layouts.master')
@section('content')
    <section class="w-full h-[60vh] md:h-screen flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/read_banner.png') }}'); background-size: cover; background-position: center;">
        <div class="flex items-center justify-between gap-2 w-full max-w-7xl mx-auto px-4 md:px-20 ">
            <div class="text-[#fff] w-full" data-aos="fade-right" data-aos-duration="1000">
                <p class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">{{ __('messages.title-1') }}</p>
                <h1 class="text-[20px] md:text-[50px] xl:text-[5rem] font-[600] leading-none">
                    {!! nl2br(__('messages.welcome')) !!}
                </h1>
                <p data-aos="fade-left" data-aos-duration="1000"
                    class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400] pt-4">
                    {{ __('messages.quote') }}</p>
            </div>

            <div>
                <p data-aos="fade-left" data-aos-duration="1000"
                class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400] flex justify-end">
                {{ __('messages.quote') }}</p>
            </div>
        </div>
    </section>

    <div
        class="w-full max-w-[420px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full my-[1rem] {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }} flex flex-wrap gap-[1rem] justify-center">

        {{-- Siem Reap --}}
        <div class="w-full lg:w-[48%]">
            <h1 data-aos="fade-right" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="500"
                class="font-bold text-wrap text-[#50c9ee] md:whitespace-pre-line {{ app()->getLocale() === 'km' ? 'font-krasar text-[20px]' : 'font-gotham text-[20px] leading-[20px]' }}">
                {{ __('messages.siem_reap') }}
            </h1>
            <iframe class="w-full h-[30vh] md:h-[50vh] my-3"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5271.460803358791!2d103.8543079!3d13.376731399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31101703918716ff%3A0x2871b10be0d842dd!2sThe%20Bible%20Society%20in%20Cambodia%2C%20Siem%20Reap!5e1!3m2!1sen!2skh!4v1753933203503!5m2!1sen!2skh"
                loading="lazy"></iframe>
        </div>

        {{-- Bible Distribution Center --}}
        <div class="w-full lg:w-[48%]">
            <h1 data-aos="fade-right" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="500"
                class="font-bold text-wrap text-[#50c9ee] md:whitespace-pre-line {{ app()->getLocale() === 'km' ? 'font-krasar text-[20px]' : 'font-gotham text-[20px] leading-[20px]' }}">
                {{ __('messages.Bible_Distribution_Center') }}
            </h1>
            <iframe class="w-full h-[30vh] md:h-[50vh] my-3"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d663.5346877170442!2d104.8583901!3d11.574516!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951e8cd21db71%3A0xd83eb18e9b850632!2sThe%20Bible%20Society%20in%20Cambodia!5e1!3m2!1sen!2skh!4v1753933347744!5m2!1sen!2skh"
                loading="lazy"></iframe>
        </div>
    </div>
@endsection
