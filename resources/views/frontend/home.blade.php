@extends('layouts.master')
@section('css')
    <style>
        .banner .swiper .swiper-pagination {
            position: absolute;
            bottom: 120px;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 10;
        }

        @media (max-width: 639px) {
            .banner .swiper .swiper-pagination {
                bottom: 60px;
            }
        }
    </style>
@endsection
@section('content')
    @include('components.loading')

    {{-- <section class="w-full h-[60vh] lg:h-screen big-hight flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/banner.jpg') }}'); background-size: cover; background-position: center;">
        <div class="w-full max-w-7xl mx-auto text-center">
            <div class="text-[#fff] w-full" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="text-[30px] md:text-[50px] xl:text-[5rem] font-[600] leading-none">
                    {{ __('messages.everyone') }}
                </h1>
            </div>
        </div>
    </section> --}}

    <section class="relative w-full h-[60vh] lg:h-screen big-hight flex items-center justify-center overflow-hidden z-10">
        <div class="absolute inset-0 w-full h-[60vh] lg:h-screen big-hight z-1">
            @forelse ($banners as $index => $banner)
                @php
                    $images = json_decode($banner->image, true) ?? [];
                @endphp

                <div class="w-full h-full banner">
                    <div class="swiper BannerSwiper w-full h-full">
                        <div class="swiper-wrapper w-full h-full">
                            @foreach ($images as $img)
                                <div class="swiper-slide w-full h-full">
                                    <img src="{{ asset($img) }}" alt="" loading="lazy"
                                        class="w-full h-full object-cover object-top">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-12 text-center py-10">
                    <p>No projects found</p>
                </div>
            @endforelse
        </div>

        <div class="relative w-full max-w-7xl mx-auto text-center z-10">
            <div class="text-[#fff] w-full" data-aos="fade-right" data-aos-duration="1000">
                <h1
                    class="font-[500] leading-10 md:leading-none {{ app()->getLocale() === 'km' ? 'font-fasthand text-[20px] md:text-[40px] xl:text-[60px]' : 'font-aesthetic text-[25px] md:text-[50px] xl:text-[5rem]' }}">
                    {{-- {{ __('messages.everyone') }} --}}
                    {!! app()->getLocale() === 'km' ? $ban->title_kh : $ban->title_en !!}
                </h1>
            </div>
        </div>
    </section>


    <section id="home"
        class="relative z-10 w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full bg-[linear-gradient(85.15deg,_rgba(30,_30,_30,_0.8)_0.43%,_rgba(7,_32,_39,_0.64)_98.29%)] backdrop-blur-[10px] shadow-[0px_50px_50px_-40px_rgba(0,_0,_0,_0.25)] rounded-[30px] border-[2px] border-solid border-[#575757] translate-y-[-23%] p-3 md:p-14 md:translate-y-[-40%] overflow-hidden">

        <h1 class="text-[14px] xl:text-[30px] font-normal text-[#fff] text-center text-wrap mb-4 md:mb-14">
            {{ __('messages.title') }}
        </h1>

        @php
            $locale = app()->getLocale();
        @endphp

        <form method="POST" action="{{ route('donations.create-payment') }}" x-data="{ currency: '{{ old('currency', 'usd') }}' }"
            class="w-full xl:max-w-[90%] mx-auto flex flex-col md:flex-row items-stretch justify-center md:space-x-4 space-y-4 md:space-y-0">
            @csrf

            <div class="flex flex-1 items-stretch space-x-2">

                <!-- Currency Selection -->
                <label @click="currency='usd'"
                    class="w-full sm:flex-[0.6] flex items-center justify-center rounded-full cursor-pointer transition-all py-3 md:py-2"
                    :class="currency === 'usd' ? 'bg-[#4FC9EE] text-white' : 'bg-white text-[#4FC9EE]'">
                    <h1 class="text-[15px] xl:text-[20px] font-[600] text-center">
                        {{ __('messages.usd') }}
                    </h1>
                    <input type="radio" name="currency" value="usd" class="hidden" :checked="currency === 'usd'">
                </label>

                <!-- Donation Amount -->
                <input type="number" name="amount" placeholder="{{ __('messages.amount') }}" value="{{ old('amount') }}"
                    required step="0.01" :min="currency === 'usd' ? 0.01 : 100"
                    class="w-full sm:flex-[2.4] text-white placeholder:text-white bg-[#4FC9EE] rounded-full px-6 py-3 md:py-2 outline-none text-[15px] xl:text-[20px]">
            </div>

            <!-- Right side: Submit Button -->
            <button type="submit"
                class="flex items-center justify-center flex-none w-auto md:w-[20%] rounded-full bg-[#4FC9EE] px-5 py-2 md:py-2">
                <div class="flex items-center justify-center space-x-2">
                    <img src="{{ asset('assets/images/donate.svg') }}" alt="Donate"
                        class="w-[25px] md:w-[30px] object-contain">
                    <p class="text-white text-[15px] xl:text-[18px] font-medium">
                        {{ __('messages.donate') }}
                    </p>
                </div>
            </button>

        </form>

    </section>

    <div class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto h-full pb-10">
        <div class="w-full min-h-[40vh] flex flex-col md:flex-row items-stretch pb-5 overflow-hidden rounded-[30px]">
            <div class="w-full md:w-[40%]">
                <img src="{{ asset($readings->image) }}" alt="banner" data-aos="fade-right" data-aos-duration="400"
                    class="w-full h-full object-cover object-center md:rounded-l-[30px] max-sm:rounded-t-[30px]" />
            </div>

            <div data-aos="fade-left" data-aos-duration="400"
                class="flex flex-col justify-between w-full md:w-[60%] bg-[#4FC9EE] p-5 md:p-6
               md:rounded-r-[30px] max-sm:rounded-b-[30px] flex-1">

                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/icons/time.svg') }}" alt="icon"
                        class="w-[50px] h-[50px] xl:w-[80px] xl:h-[80px] object-cover object-center p-2">
                    <h1
                        class="text-[16px] xl:text-[28px] text-[#000] font-[700]
                                {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
                        {{ __('messages.dsr') }}
                    </h1>
                </div>

                <div aria-atomic="" id="readingText"
                    class="flex-1 flex items-center px-4 md:px-10 text-[14px] xl:text-[16px] text-[#fff] font-kantumruy leading-relaxed text-wrap">
                    {!! app()->getLocale() === 'km' ? $readings->title_km : $readings->title_en !!}

                </div>

                <div class="mt-3 flex flex-wrap gap-3 px-4 md:px-10 text-[14px] xl:text-[16px]">
                    <button onclick="shareContent()"
                        class="bg-black text-white px-5 py-2 rounded-full hover:bg-gray-800 transition">
                        {{ app()->getLocale() === 'km' ? 'ចែករំលែក' : 'Share Now' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div
        class="w-full h-fit bg-[linear-gradient(85.15deg,_rgba(30,_30,_30,_0.8)_0.43%,_rgba(7,_32,_39,_0.64)_98.29%)] py-10">
        <div
            class="flex flex-col md:flex-row w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto gap-4 overflow-hidden">

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
                                    <a href="{{ url(app()->getLocale() . '/' . $category->slug) }}" target="_blank"
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
                    <img src="{{ asset('assets/images/Banners/banner_2.jpg') }}" alt="banner"
                        class="w-full h-full object-cover object-center" />
                </div>
            </div>
        </div>
    </div>

    <section class="w-full h-fit lg:max-w-[1200px] mx-auto py-10 px-2">
        <div class="my-5">
            <h1 class="text-gradient text-[20px] md:text-[25px] font-[600] max-w-[250px] mb-2 md:max-w-full">
                {{ app()->getLocale() === 'km' ? 'បច្ចុប្បន្នភាពចុងក្រោយ' : 'Latest Update' }}</h1>
        </div>
        <div class="w-full  grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 text-[#000] overflow-hidden">
            <div data-aos="fade-up" data-aos-duration="500">
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
                                <a href="{{ route('mission') }}#mission">
                                    {{ app()->getLocale() === 'km' ? 'បេសកកម្មផ្សេងៗ' : 'More Mission' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-duration="500">
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
                                    <a href="{{ route('news_item') }}#news">
                                        {{ app()->getLocale() === 'km' ? 'ព័ត៌មានផ្សេងៗ' : 'More News' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-duration="500">
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
                            {{ app()->getLocale() === 'km' ? 'វីដេអូ' : 'Vlog' }}
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
        class="w-full h-fit xl:max-w-[1200px] mx-auto my-[1.5rem] px-3 py-[2rem] overflow-hidden {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
        <div class="my-5">
            <h1 class="text-gradient text-[20px] md:text-[25px] font-[600] max-w-[250px] mb-2 md:max-w-full">
                {{ app()->getLocale() === 'km' ? 'ប្រវត្តិនៃការបកប្រែព្រះគម្ពីរជាភាសាខ្មែរ' : 'Khmer Bible Translation History' }}
            </h1>
            <hr class="w-full h-[2px] bg-[#000]">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 overflow-hidden rounded-[50px]">
            @php
                $history_images = json_decode($history->image, true) ?? [];
            @endphp
            {{-- <img src="{{ asset('assets/images/Banners/history.jpg') }}" alt="banner" data-aos="fade-right"
                data-aos-duration='500' class="w-full h-full object-cover object-center" /> --}}
            <div class="swiper MissionSwiper w-full">
                <div class="swiper-wrapper w-full">
                    @foreach ($history_images as $img)
                        <div class="swiper-slide w-full">
                            <img src="{{ asset($img) }}" alt="" loading="lazy"
                                class="w-full h-full object-cover object-center">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="bg-[#00AFD7] py-5 px-4 md:px-10 text-white relative" data-aos="fade-left"
                data-aos-duration='500'>
                <div class="text-[#fff]">
                    <h1 class="text-[20px] lg:text-[25px] font-[600]">
                        {{ app()->getLocale() === 'km' ? $history->title_kh : $history->title_en }}
                    </h1>

                    <div class="text-[16px] lg:text-[18px] pt-4">
                        {!! app()->getLocale() === 'km' ? $history->content_kh : $history->content_en !!}
                    </div>
                </div>

                <button id="previewPdfBtn"
                    class="bg-white text-[#000] font-semibold px-4 py-2 rounded-full transition mt-10">
                    {{ app()->getLocale() === 'km' ? 'អានបន្ថែម' : 'Read More' }}
                </button>
            </div>

            <!-- PDF Modal -->
            <div id="pdfModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg overflow-hidden w-[90%] max-w-3xl h-[80%] flex flex-col">
                    <!-- PDF Preview -->
                    <iframe id="pdfIframe" class="flex-1 w-full" src="" frameborder="0"></iframe>

                    <!-- Actions -->
                    <div class="px-4 py-2 flex justify-end gap-2 border-t border-gray-200 text-[14px]">
                        <a id="downloadPdf" href="" download class="bg-[#00AFD7] text-white px-4 py-2 rounded">
                            {{ app()->getLocale() === 'km' ? 'ទាញយក' : 'Download' }}
                        </a>
                        <button id="closePdf" class="bg-[#000] text-white px-4 py-2 rounded">
                            {{ app()->getLocale() === 'km' ? 'បិទ' : 'Close' }}
                        </button>
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
        function shareContent() {
            const elem = document.getElementById('readingText');

            if (!elem) {
                alert('❌ Element not found.');
                return;
            }

            // Use textContent for better reliability
            let text = elem.textContent || '';
            text = text.replace(/\u200B/g, '').trim(); // remove invisible zero-width spaces

            if (!text) {
                alert('❌ No text found to copy or share.');
                return;
            }

            // Copy to clipboard
            navigator.clipboard.writeText(text)
                .then(() => showToast('✅ Text copied'))
                .catch(err => {
                    console.error('Copy failed:', err);
                    showToast('❌ Failed to copy text');
                });

            // Web Share API
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: text,
                    url: window.location.href,
                }).catch(err => console.log('Share cancelled', err));
            }
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.innerText = message;
            toast.className =
                'fixed bottom-5 right-5 bg-black text-white px-4 py-2 rounded-lg shadow-lg text-sm animate-fade-in-out z-50';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const previewBtn = document.getElementById('previewPdfBtn');
            const pdfModal = document.getElementById('pdfModal');
            const pdfIframe = document.getElementById('pdfIframe');
            const closePdf = document.getElementById('closePdf');
            const downloadPdf = document.getElementById('downloadPdf');

            // Detect current Laravel locale
            const currentLocale = "{{ app()->getLocale() }}";

            // Choose the correct PDF file based on language
            const pdfUrl = currentLocale === 'km' ?
                "{{ asset('assets/history_kh.pdf') }}" :
                "{{ asset('assets/history_en.pdf') }}";

            // Open preview
            previewBtn.addEventListener('click', () => {
                pdfIframe.src = pdfUrl;
                downloadPdf.href = pdfUrl;
                pdfModal.classList.remove('hidden');
                pdfModal.classList.add('flex');
            });

            // Close preview
            closePdf.addEventListener('click', () => {
                pdfModal.classList.add('hidden');
                pdfModal.classList.remove('flex');
                pdfIframe.src = ''; // Stop streaming
            });
        });
    </script>
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
