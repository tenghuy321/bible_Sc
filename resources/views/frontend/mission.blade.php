@extends('layouts.master')
@section('css')
    <style>
        .prose strong {
            font-size: 16px;
            color: #4FC9EE;
        }

        .prose p,
        .prose ul {
            font-size: 16px;
            color: #fff;
        }

        .prose ol {
            list-style-type: decimal;
            font-size: 16px;
            color: #fff;
        }

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

        @media (max-width: 768px) {
            .prose strong {
                font-size: 14px;
                color: #4FC9EE;
            }

            .prose ol {
                list-style-type: decimal;
                font-size: 14px;
                color: #fff;
            }

            .prose p,
            .prose ul {
                font-size: 14px;
                color: #fff;
            }

        }
    </style>
@endsection

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="w-full h-[60vh] lg:h-screen big-hight bg-gray-100 flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/ms_banner.jpg') }}'); background-size: cover; background-position: center;">
    </div>

    <div class="w-full h-fit bg-[#292929] p-5">

        <section id="mission" class="w-full max-w-7xl mx-auto px-4 pb-4 pt-10 md:py-10 overflow-hidden">

            @forelse ($missions as $index => $mission)
                @php
                    $images = json_decode($mission->image, true) ?? [];
                    $isOdd = ($index + 1) % 2 === 1;
                @endphp

                <div data-aos="fade-left" data-aos-duration="500"
                    class="flex flex-col md:flex-row gap-2 md:gap-[1rem] p-3 md:max-w-[720px] xl:max-w-[1200px] mx-auto overflow-hidden">
                    {{-- Image --}}
                    <div class="w-full md:w-[40%] {{ $isOdd ? 'order-1' : 'order-2' }}">
                        <div class="w-full">
                            <div class="swiper MissionSwiper w-full h-full">
                                <div class="swiper-wrapper w-full h-full">
                                    @foreach ($images as $img)
                                        <div class="swiper-slide w-full h-full">
                                            <img src="{{ asset($img) }}" alt="" loading="lazy"
                                                class="w-full h-[250px] md:h-[300px] object-cover object-top rounded-[30px]">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>

                        <div class="text-pretty text-[14px] md:text-[16px] text-[#fff] mt-4 text-center">
                            {!! app()->getLocale() === 'km' ? $mission->description_kh : $mission->description_en !!}
                        </div>
                    </div>

                    <div
                        class="tooltip w-full md:w-[60%] pb-10 md:pb-0 md:pe-2 relative {{ $isOdd ? 'order-1 md:order-2' : 'order-2 md:order-1' }}">
                        <h1 class="text-[16px] md:text-[24px] text-[#4FC9EE] font-bold">
                            {{ app()->getLocale() === 'km' ? $mission->title_kh : $mission->title_en }}
                        </h1>

                        <div class="text-pretty text-[14px] md:text-[16px] text-[#fff] mt-4">
                            {!! app()->getLocale() === 'km' ? $mission->content_kh : $mission->content_en !!}
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

    <div class="w-full h-fit bg-[#446EB6] overflow-hidden">
        @php
            $mission_images = json_decode($mission_image->image, true) ?? [];
        @endphp

        <div class="flex flex-col md:flex-row">
            <div data-aos="fade-right" data-aos-duration="400" class="w-full md:w-[40%]">
                <div class="swiper MissionSwiper w-full">
                    <div class="swiper-wrapper w-full">
                        @foreach ($mission_images as $img)
                            <div class="swiper-slide w-full">
                                <img src="{{ asset($img) }}" alt="" loading="lazy"
                                    class="w-full h-[300px] md:h-[400px] object-cover object-top">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="w-full md:w-[60%] p-4 md:px-20 md:py-10 md:max-w-[720px] xl:max-w-[1200px] mx-auto">
                <h1 data-aos="fade-right" data-aos-duration="400" class="text-[16px] md:text-[24px] text-[#fff] font-bold">
                    {!! app()->getLocale() === 'km' ? $mission_image->title_kh : $mission_image->title_en !!}
                </h1>
                <div data-aos="fade-left" data-aos-duration="600"
                    class="text-[14px] md:text-[16px] text-[#fff] whitespace-pre-line">
                    {!! app()->getLocale() === 'km' ? $mission_image->content_kh : $mission_image->content_en !!}
                </div>
            </div>
        </div>
    </div>

    <div class="w-full h-fit bg-[#fff]">
        <div class="relative max-w-3xl mx-auto p-8 md:p-10">
            <div class="text-[#00aef0] text-[100px] leading-none absolute left-2 lg:-left-16">
                <img src="{{ asset('assets/images/icons/new-icon.svg') }}" alt="" class="w-2/3 lg:w-full">
            </div>

            <div class="relative mt-16">
                <p class="text-center text-[#000] text-[16px] md:text-[18px] font-[500] leading-relaxed">
                    {{ app()->getLocale() === 'km' ? '«ចូរ​ចេញ​ទៅ​នាំ​មនុស្សគ្រប់​ជាតិ​សាសន៍ឲ្យ​ធ្វើ​ជា​សិស្ស ហើយធ្វើ​ពិធី​ជ្រមុជ​ទឹក​ឲ្យ​គេក្នុងព្រះ‌នាម​ព្រះ‌បិតាព្រះ‌បុត្រា និង​ព្រះ‌វិញ្ញាណ​ដ៏​វិសុទ្ធ»' : '«Go, then, to all peoples everywhere and make them my disciples: baptize them in the name of the Father, the Son, and the Holy Spirit,»' }}
                </p>

                <p class="text-right text-[#000] mt-6 italic">
                    {{ app()->getLocale() === 'km' ? 'ម៉ាថាយ ២៨.១៩' : 'Matthew 28:19' }}
                </p>
            </div>
        </div>
    </div>
@endsection
