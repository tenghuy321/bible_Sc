<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<nav class="absolute top-0 left-0 right-0 max-w-[1200px] mx-auto ">

    @php
        $locale = app()->getLocale();
    @endphp

    <div class="flex xl:hidden items-center justify-between px-3 py-4">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="" />

        <div class="flex w-full items-center justify-end gap-2 py-4 me-6 text-[14px] lg:text-[16px]">
            <!-- Clickable flag to switch language -->
            <img src="{{ $locale === 'km' ? asset('assets/images/icons/kh-flag.png') : asset('assets/images/icons/usa-flag.png') }}"
                alt="Flag" class="w-8 h-8 rounded-full">

            <!-- Language links -->
            <a href="{{ route('lang.switch', 'km') }}"
                class="{{ $locale === 'km' ? 'text-[#4FC9EE] font-bold' : 'text-[#fff]' }}">
                {{ $locale === 'km' ? 'ភាសាខ្មែរ' : 'Khmer' }}
            </a>

            <a href="{{ route('lang.switch', 'en') }}"
                class="{{ $locale === 'en' ? 'text-[#4FC9EE] font-bold' : 'text-[#fff]' }}">
                {{ $locale === 'km' ? 'ភាសាអង់គ្លេស' : 'English' }}
            </a>
        </div>
    </div>


    <div x-data="{ open: false }">
        <!-- Button -->
        <div
            class="fixed xl:hidden w-fit left-[4%] md:left-[2%] lg:left-[1.8%] top-[30%] -translate-x-1/2 bg-black/50 p-2 rounded transition-all duration-300 hover:bg-black/70 rounded-r-md z-40">
            <button @click="open = !open" class="flex w-full items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="transition-all duration-300">
                    <path d="M4 6l16 0" />
                    <path d="M4 12l16 0" />
                    <path d="M4 18l16 0" />
                </svg>
            </button>
        </div>

        <!-- Sliding Menu -->
        <div x-show="open" x-cloak x-transition:enter="transition transform duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed top-0 left-0 h-full w-64 lg:w-[40%] bg-[linear-gradient(85.15deg,_rgba(30,_30,_30,_0.8)_0.43%,_rgba(7,_32,_39,_0.64)_98.29%)] shadow-sm backdrop-blur-[10px] z-50 p-2">

            <!-- Close Button -->
            <div class="flex items-center justify-between">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="" />

                <button @click="open = false" class="p-4 text-white">
                    ✕
                </button>
            </div>

            <!-- Menu Links -->
            <nav class="flex flex-col p-2 gap-6 mt-6">
                @php
                    $routes = [
                        ['name' => 'home', 'label' => 'messages.home'],
                        ['name' => 'about', 'label' => 'messages.about'],
                        ['name' => 'mission', 'label' => 'messages.mission'],
                        ['name' => 'cata', 'label' => 'messages.catalogues'],
                        ['name' => 'news_item', 'label' => 'messages.news'],
                        ['name' => 'vlogs', 'label' => 'messages.vlogs'],
                    ];
                @endphp

                @foreach ($routes as $route)
                    <a href="{{ route($route['name']) }}"
                        class="relative inline-block text-[20px] font-semibold whitespace-nowrap
                    {{ request()->routeIs($route['name']) ? 'text-[#32CDF0] before:scale-x-100' : 'text-[#fff] before:scale-x-0' }}
                    before:absolute before:left-0 before:-bottom-1 before:w-full before:h-[3px] before:bg-[#32CDF0] before:rounded-full
                    before:origin-bottom-left hover:before:scale-x-100 before:transition-all before:duration-300">
                        {{ __($route['label']) }}
                    </a>
                @endforeach
            </nav>

        </div>
    </div>


    <div class="hidden xl:flex w-full items-center justify-end gap-2 py-4 -ms-6" data-aos="fade-left"
        data-aos-duration="1000">
        <!-- Clickable flag to switch language -->
        <img src="{{ $locale === 'km' ? asset('assets/images/icons/kh-flag.png') : asset('assets/images/icons/usa-flag.png') }}"
            alt="Flag" class="w-8 h-8 rounded-full">

        <!-- Language links -->
        <a href="{{ route('lang.switch', 'km') }}"
            class="{{ $locale === 'km' ? 'text-[#4FC9EE] font-bold' : 'text-[#fff]' }}">
            {{ $locale === 'km' ? 'ភាសាខ្មែរ' : 'Khmer' }}
        </a>

        <a href="{{ route('lang.switch', 'en') }}"
            class="{{ $locale === 'en' ? 'text-[#4FC9EE] font-bold' : 'text-[#fff]' }}">
            {{ $locale === 'km' ? 'ភាសាអង់គ្លេស' : 'English' }}
        </a>
    </div>

    <div
        class="hidden xl:flex items-center justify-between border-b border-gray-900/10 py-6 lg:border-none h-[5rem] px-10 bg-[#fff] rounded-full">
        <div class="flex flex-1 items-center gap-4" data-aos="fade-right" data-aos-duration="1000">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="">
            <a href="{{ url('/#home') }}" class="flex items-center gap-6 bg-[#50bbed] ps-6 pe-2 py-1 rounded-full">
                <span class="text-[16px] text-white font-bold">
                    {{ app()->getLocale() === 'km' ? 'បរិច្ចាគ' : 'Donate' }}
                </span>

                <span class="flex items-center justify-center w-10 h-10 bg-[#4FC9EE] rounded-full">
                    <svg width="24" height="24" viewBox="0 0 13 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_148)">
                            <path
                                d="M7.83925 5.63095C8.35246 6.06624 8.41765 6.12675 8.64351 6.32125C8.80899 6.17931 8.95098 6.05019 9.55282 5.54548C10.6574 4.61796 11.4555 3.94826 11.4555 2.95899C11.4555 2.02119 10.7666 1.28662 9.88714 1.28662C9.29638 1.28662 8.90439 1.61994 8.65827 1.95942C8.4252 1.61891 8.04623 1.28662 7.45377 1.28662C6.57433 1.28662 5.88574 2.02121 5.88574 2.95899C5.88572 3.97333 6.66289 4.63273 7.83925 5.63095Z"
                                fill="#FEFBF8" />
                            <path
                                d="M2.19469 11.4098C3.11563 10.7842 4.12329 10.5451 5.21997 10.7279L6.97748 11.0302C7.65239 11.1427 8.27098 11.1075 8.80527 10.9318C9.91057 10.5634 11.0171 9.40323 11.3103 8.96336C11.7181 8.35175 11.9421 7.68389 12.0827 7.36054C12.2163 7.05121 12.2163 6.83328 12.0757 6.70674C11.914 6.55909 11.6398 6.63642 11.4359 6.74892C11.1126 6.9317 10.769 7.45896 10.4175 7.96509C9.96058 8.62592 9.17791 9.0196 8.37646 9.0196H5.83156V8.3166H6.88607C8.75603 8.3166 9.59261 7.96509 9.59261 7.61359C9.59261 7.31836 9.00914 7.18476 8.81227 7.1426C8.04602 6.96685 6.31661 6.88249 5.13559 6.35524C4.9226 6.26205 4.68115 6.20974 4.4256 6.20759C4.02494 6.20419 3.5895 6.32902 3.17419 6.65048C3.16721 6.65048 3.16721 6.65048 3.16015 6.65751C2.88598 6.86841 2.51105 7.17773 2.00488 7.62062C1.57603 8.00022 1.16128 8.48529 0.437163 9.10396L0.184082 9.32189L1.91349 11.5996L2.19469 11.4098Z"
                                fill="#FEFBF8" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_148">
                                <rect width="11.9979" height="11.9979" fill="white"
                                    transform="translate(0.184082 0.444336)" />
                            </clipPath>
                        </defs>
                    </svg>
                </span>
            </a>

        </div>
        <div class="hidden lg:flex lg:gap-x-8" data-aos="fade-left" data-aos-duration="1000">
            <a href="{{ route('home') }}"
                class="relative text-[20px] {{ request()->routeIs('home') ? 'text-[#32CDF0] before:scale-x-100' : 'text-[#000]' }}
                    before:absolute before:-bottom-9 before:w-full before:h-[4px] before:bg-[#32CDF0]
                    before:rounded-full before:scale-x-0 before:origin-bottom-right
                    hover:before:scale-x-100 hover:before:origin-bottom-left before:transition-all before:duration-300">
                {{ __('messages.home') }}
            </a>

            <a href="{{ route('about') }}"
                class="relative text-[20px] {{ request()->routeIs('about') ? 'text-[#32CDF0] before:scale-x-100' : 'text-[#000]' }}
                    before:absolute before:-bottom-9 before:w-full before:h-[4px] before:bg-[#32CDF0]
                    before:rounded-full before:scale-x-0 before:origin-bottom-right
                    hover:before:scale-x-100 hover:before:origin-bottom-left before:transition-all before:duration-300">
                {{ __('messages.about') }}
            </a>

            <a href="{{ route('mission') }}"
                class="relative text-[20px] {{ request()->routeIs('mission') ? 'text-[#32CDF0] before:scale-x-100' : 'text-[#000]' }}
                    before:absolute before:-bottom-9 before:w-full before:h-[4px] before:bg-[#32CDF0]
                    before:rounded-full before:scale-x-0 before:origin-bottom-right
                    hover:before:scale-x-100 hover:before:origin-bottom-left before:transition-all before:duration-300">
                {{ __('messages.mission') }}
            </a>

            <a href="{{ route('cata') }}"
                class="relative text-[20px] {{ request()->routeIs('cata') ? 'text-[#32CDF0] before:scale-x-100' : 'text-[#000]' }}
                    before:absolute before:-bottom-9 before:w-full before:h-[4px] before:bg-[#32CDF0]
                    before:rounded-full before:scale-x-0 before:origin-bottom-right
                    hover:before:scale-x-100 hover:before:origin-bottom-left before:transition-all before:duration-300">
                {{ __('messages.catalogues') }}
            </a>
            <a href="{{ route('news_item') }}"
                class="relative text-[20px] {{ request()->routeIs('news_item') ? 'text-[#32CDF0] before:scale-x-100' : 'text-[#000]' }}
                    before:absolute before:-bottom-9 before:w-full before:h-[4px] before:bg-[#32CDF0]
                    before:rounded-full before:scale-x-0 before:origin-bottom-right
                    hover:before:scale-x-100 hover:before:origin-bottom-left before:transition-all before:duration-300">
                {{ __('messages.news') }}
            </a>
            <a href="{{ route('vlogs') }}"
                class="relative text-[20px] {{ request()->routeIs('vlogs') ? 'text-[#32CDF0] before:scale-x-100' : 'text-[#000]' }}
                    before:absolute before:-bottom-9 before:w-full before:h-[4px] before:bg-[#32CDF0]
                    before:rounded-full before:scale-x-0 before:origin-bottom-right
                    hover:before:scale-x-100 hover:before:origin-bottom-left before:transition-all before:duration-300">
                {{ __('messages.vlogs') }}
            </a>
        </div>

        <div class="pl-6" data-aos="fade-left" data-aos-duration="1000">
            <a href="{{ url(app()->getLocale() . '/' . $versions_item->slug) }}"
                class="w-fit bg-[#50bbed] text-[12px] xl:text-[24px] text-black rounded-full px-[15px] py-[2px] xl:px-[24px] mt-2">
                {{ __('messages.read') }}
            </a>
        </div>
    </div>


</nav>
