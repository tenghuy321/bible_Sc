@extends('layouts.master')
@section('content')
    <section class="w-full h-[60vh] md:h-screen big-hight flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/read_banner.png') }}'); background-size: cover; background-position: center;">
        <div class="flex items-center justify-between gap-2 w-full max-w-7xl mx-auto px-4 md:px-20 ">
            <div class="text-[#fff] w-full" data-aos="fade-right" data-aos-duration="1000">
                <p class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">{{ __('messages.title-1') }}</p>
                <h1 class="text-[20px] md:text-[50px] xl:text-[5rem] font-[600] leading-none">
                    {!! nl2br(__('messages.welcome')) !!}
                </h1>
            </div>

            <p data-aos="fade-left" data-aos-duration="1000"
                class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400] flex justify-end">
                {{ __('messages.quote') }}</p>
        </div>
    </section>

    <section class="w-full h-fit">
        <x-vlogs-card :vlogs="$vlogs" :locale="app()->getLocale()" />
    </section>

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
