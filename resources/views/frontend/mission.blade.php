@extends('layouts.master')
@section('css')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #4FC9EE;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background-color: #2a2a2a;
        }
    </style>
@endsection

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="w-full h-[60vh] md:h-screen bg-gray-100 flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/ms_banner.png') }}'); background-size: cover; background-position: center;">
        <div
            class="relative flex justify-between items-center max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] md:space-x-[8rem] xl:space-x-[14rem]">
            <div class="w-full">
                <p class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">{{ __('messages.title-1') }}
                </p>
                <h1 data-aos="fade-right" data-aos-duration="500"
                    class="font-bold text-wrap text-[#ffffff] text-[20px] md:text-[50px] xl:text-[5rem] leading-none">
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
        {{-- <div class="flex gap-2 md:gap-[1rem] p-3 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden">
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

        <div class="flex gap-2 md:gap-[1rem] p-3 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden">
            <div class="w-[30%] md:w-[40%]">
                <img data-aos="fade-right" data-aos-duration="400"
                    src="{{ asset('assets/images/Banners/ms_2.png') }}" alt="banner"
                    class="w-[30vh] h-[20vh] md:w-full md:h-full object-cover object-center" />
            </div>
            <div data-tip="Scroll For Read More" class="tooltip w-[70%] md:w-[60%] pe-2">
                <h1 data-aos="fade-right" data-aos-duration="400"
                    class="text-[16px] md:text-[24px] text-[#4FC9EE] font-bold">
                    {{ __('messages.title_2') }}
                </h1>
                <p data-aos="fade-left" data-aos-duration="600"
                    class="text-[12px] md:text-[18px] text-[#fff] whitespace-pre-line">
                    {{ __('messages.content_2') }}
                </p>
            </div>
        </div> --}}

        <section id="mission" class="w-full max-w-7xl mx-auto px-4 pb-4 pt-10 md:py-10">

            @forelse ($missions as $index => $mission)
                @php
                    $images = json_decode($mission->image, true) ?? [];
                    $isOdd = ($index + 1) % 2 === 1;
                @endphp

                <div x-data="{ open: false }"
                    class="flex flex-col md:flex-row gap-2 md:gap-[1rem] p-3 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden">
                    {{-- Image --}}
                    <div class="w-full md:w-[40%] {{ $isOdd ? 'order-1' : 'order-2' }}">
                        <div class="swiper MissionSwiper w-full h-full">
                            <div class="swiper-wrapper w-full h-full">
                                @foreach ($images as $img)
                                    <div class="swiper-slide w-full h-full">
                                        <img src="{{ asset($img) }}" alt="" loading="lazy"
                                            class="w-full h-[250px] object-cover object-top">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div
                        class="tooltip w-full md:w-[60%] pb-10 md:pb-0 md:pe-2 relative {{ $isOdd ? 'order-1 md:order-2' : 'order-2 md:order-1' }}">
                        <h1 class="text-[16px] md:text-[24px] text-[#4FC9EE] font-bold">
                            {{ app()->getLocale() === 'km' ? $mission->title_kh : $mission->title_en }}
                        </h1>

                        <div class="text-[12px] md:text-[18px] text-pretty text-[#fff] line-clamp-4">
                            {!! app()->getLocale() === 'km' ? $mission->content_kh : $mission->content_en !!}
                        </div>

                        <button @click="open = true"
                            class="mt-2 text-sm text-[#4FC9EE] underline hover:text-[#38bdf8] transition absolute right-0 bottom-0">
                            {{-- Read Details --}}
                            {{ $locale === 'km' ? 'ព័ត៌មានបន្ថែម' : 'Read More' }}
                        </button>

                        <div x-show="open" x-cloak x-transition
                            class="fixed inset-0 flex items-center justify-center z-50">
                            <div @click.away="open = false"
                                class="bg-[#1E1E1E] rounded-2xl max-w-2xl w-[90%] p-6 text-white relative">
                                {{-- Close button --}}
                                <button @click="open = false"
                                    class="absolute top-2 right-3 text-gray-400 hover:text-white text-xl">&times;</button>

                                {{-- Title --}}
                                <h2 class="text-[18px] md:text-[24px] text-[#4FC9EE] font-bold mb-3 pr-6">
                                    {{ app()->getLocale() === 'km' ? $mission->title_kh : $mission->title_en }}
                                </h2>

                                {{-- Scrollable Content --}}
                                <div
                                    class="text-[14px] md:text-[18px] text-pretty max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                                    {!! app()->getLocale() === 'km' ? $mission->content_kh : $mission->content_en !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="md:col-span-12 text-center py-10">
                    <p>No projects found</p>
                </div>
            @endforelse
        </section>
    </div>

    {{-- <div class="w-full h-fit bg-[#446EB6] overflow-hidden">
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
    </div> --}}

    <div class="w-full h-fit bg-[#fff]">
        <div class='w-full p-4 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden'>
            <p data-aos="fade-left" data-aos-duration='400' class='text-[12px] md:text-[18px] text-pretty'>
                {{ __('messages.content_3') }}
            </p>
            <div class='flex items-center justify-between'>
                <span class='text-[50px] font-[700] text-[#4FC9EE]'>“”</span>
                <span class='text-[16px] text-[#4FC9EE] font-bold italic'>{{ __('messages.Revelation') }} 5:13</span>
            </div>
        </div>
    </div>
@endsection
