@extends('layouts.master')

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
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

    <div class="max-w-7xl mx-auto py-10 px-4 grid grid-cols-1 lg:grid-cols-3 gap-6">
        @php
            $images = json_decode($news->image, true) ?? [];
        @endphp

        <div
            class="w-full lg:col-span-2 relative pl-0 lg:pl-10 mt-4 md:mt-0 lg:before:content-[''] lg:before:absolute lg:before:right-0 before:top-0 lg:before:h-full lg:before:w-[2px] lg:before:bg-[#4FC9EE]">
            <div>
                <div class="columns-1 sm:columns-2 gap-4">
                    @foreach ($images as $index => $img)
                        <div class="break-inside-avoid overflow-hidden rounded-[5px] mb-0 md:mb-4 pr-0 md:pr-6">
                            <img src="{{ asset($img) }}" alt="" loading="lazy"
                                class="w-full h-[250px] mb-4 rounded-md object-cover" />
                        </div>
                    @endforeach
                </div>
            </div>

            <h1 class="text-[16px] md:text-[18px] font-[700]">
                {{ app()->getLocale() === 'km' ? $news->title_kh : $news->title_en }}
            </h1>
            <div class="text-[14px] prose prose-lg max-w-none mt-4 pr-0 md:pr-6">
                {!! app()->getLocale() === 'km' ? $news->content_kh : $news->content_en !!}
            </div>

            <a href="{{ route('news_item') }}"
                class="inline-block mt-6 px-4 py-2 bg-[#4FC9EE] text-white rounded hover:bg-[#38bdf8] transition-all duration-300 hover:tracking-[0.5px]">
                ← {{ $locale === 'km' ? 'ត្រលប់ក្រោយ' : 'Back' }}
            </a>
        </div>

        <div>
            <div class="mb-4">
                <h1 class="text-gradient text-[16px] md:text-[20px] font-[600] max-w-[250px] md:max-w-full">
                    {{ app()->getLocale() === 'km' ? 'ព័ត៌មានផ្សេងៗ' : 'News' }}</h1>
                <hr class="w-full h-[2px] bg-[#000]">
            </div>
            <div class="flex flex-wrap flex-row lg:flex-col gap-4" x-data="{ showAll: false }">
                @foreach ($newsItem as $index => $item)
                    @php
                        $images = json_decode($item->image, true) ?? [];
                    @endphp

                    <div x-show="showAll || {{ $index }} < 2" x-transition
                        class="relative w-[46%] lg:w-full h-[200px] group overflow-hidden">
                        <img src="{{ asset($images[0]) }}" alt=""
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        <div
                            class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/70 via-black/40 to-transparent transition-all duration-500 p-4">

                            <h1
                                class="text-white text-[14px] md:text-[16px] font-semibold drop-shadow-md mb-2 transition-all duration-300">
                                {{ app()->getLocale() === 'km' ? $item->title_kh : $item->title_en }}
                            </h1>

                            <div
                                class="max-h-0 overflow-hidden opacity-0 group-hover:max-h-[100px] group-hover:opacity-100 transition-all duration-500 ease-in-out">
                                <div
                                    class="text-[13px] md:text-[14px] text-white line-clamp-2 prose prose-p:text-white prose-li:m-0 prose-strong:text-white">
                                    {!! app()->getLocale() === 'km' ? $item->content_kh : $item->content_en !!}
                                </div>

                                <div
                                    class="mt-2 inline-block px-4 py-1.5 bg-white text-black text-[13px] rounded-full font-medium hover:bg-[#966927] hover:text-white transition-all duration-300">
                                    <a href="{{ route('more_details', ['id' => $item->id]) }}">
                                        {{ app()->getLocale() === 'km' ? 'ព័ត៌មានបន្ថែម' : 'Read More' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (count($newsItem) > 2)
                    <div class="text-center mt-4">
                        <button @click="showAll = !showAll"
                            class="bg-[#4FC9EE] text-white px-4 py-2 rounded-full hover:bg-[#38bdf8] transition font-medium"
                            x-text="showAll ? '{{ $locale === 'km' ? 'បង្ហាញតិច' : 'Show Less' }}' : '{{ $locale === 'km' ? 'បង្ហាញបន្ថែម' : 'Show More' }}'">
                        </button>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
