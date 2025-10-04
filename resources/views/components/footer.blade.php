<footer class="w-full bg-[#4FC9EE] p-0 {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
    <div class="w-full max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] mx-auto px-2">
        <ul class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 xl:justify-center xl:items-start xl:gap-[1vw] list-none py-5">

            {{-- Logo & Donate --}}
            <li class="space-y-3">
                <img src="{{ asset('assets/images/icons/logo_black.png') }}" alt="logo"
                    class="w-[100px] h-[100px] mx-auto" />
                <h1 class="text-[20px] text-[#ffffff] text-center font-bold my-1">
                    {{ __('messages.actnow') }}
                </h1>
                <a href="{{ url('/#home') }}"
                    class="flex space-x-[3rem] w-[50%] md:w-fit mx-auto bg-[#ffffff] rounded-full justify-between items-center ps-3 pe-2 py-1">
                    <span
                        class="w-fit text-[16px] text-[#4FC9EE] text-center font-bold ms-1 {{ app()->getLocale() === 'km' ? 'font-krasar' : 'font-gotham' }}">
                        {{ app()->getLocale() === 'km' ? 'បរិច្ចាក' : 'Donate' }}
                    </span>
                    <span class="w-[40px] h-[40px] md:w-full md:h-full bg-[#4FC9EE] rounded-full p-2">
                        <svg width="24" height="24" viewBox="0 0 13 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clipPath="url(#clip0_1_148)">
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
            </li>

            {{-- Address & Office Hours --}}
            <li class="space-y-2 py-5 xl:py-0">
                <h1 class="text-[20px] text-[#000] text-start font-semibold my-1">
                    {{ __('messages.bsf') }}
                </h1>
                <p class="text-[14px] text-[#fff]">{{ __('messages.address') }}</p>
                <p class="text-[14px] text-[#fff]">
                    {{ __('messages.office_hour') }}<br>
                    {{ __('messages.date_1') }}<br>
                    {{ __('messages.date_2') }}
                </p>
            </li>

            {{-- Navigation Links & Social Media --}}
            <li class="space-y-2 list-none py-5 xl:py-0">
                <h1 class="text-[20px] text-[#000] text-start font-semibold my-1">{{ __('messages.information') }}</h1>
                <ul class="flex flex-col space-y-1 text-white">
                    @php
                        $routes = [
                            ['name' => 'home', 'label' => 'messages.home'],
                            ['name' => 'about', 'label' => 'messages.about'],
                            ['name' => 'mission', 'label' => 'messages.mission'],
                            ['name' => 'cata', 'label' => 'messages.catalogues'],
                            ['name' => 'contact', 'label' => 'messages.contact'],
                            ['name' => 'vlogs', 'label' => 'messages.vlogs'],
                        ];
                    @endphp

                    @foreach ($routes as $route)
                        <a href="{{ route($route['name']) }}"
                            class="relative inline-block text-[14px] font-semibold whitespace-nowrap
                    {{ request()->routeIs($route['name']) ? 'text-[#000]' : 'text-[#fff]' }}">
                            {{ __($route['label']) }}
                        </a>
                    @endforeach
                </ul>

                <h1 class="text-[20px] text-[#000] text-start font-semibold my-1">{{ __('messages.follow_us') }}</h1>
                <ul class="flex space-x-2 pb-5 pt-2">
                    <li><a href="https://www.youtube.com/@BibleSocietyInCambodia/featured"
                            class="shadow-sm drop-shadow-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                                strokeLinejoin="round"
                                className="icon icon-tabler icons-tabler-outline icon-tabler-brand-youtube">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8z" />
                                <path d="M10 9l5 3l-5 3z" />
                            </svg>
                        </a></li>
                    <li><a href="https://www.tiktok.com/@biblesocietyincambodia"
                            class="shadow-sm drop-shadow-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                                strokeLinejoin="round"
                                className="icon icon-tabler icons-tabler-outline icon-tabler-brand-tiktok">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M21 7.917v4.034a9.948 9.948 0 0 1 -5 -1.951v4.5a6.5 6.5 0 1 1 -8 -6.326v4.326a2.5 2.5 0 1 0 4 2v-11.5h4.083a6.005 6.005 0 0 0 4.917 4.917z" />
                            </svg>
                        </a></li>
                    <li><a href="https://www.facebook.com/BibleSocietyInCambodia/"
                            class="shadow-sm drop-shadow-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                                strokeLinejoin="round"
                                className="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                            </svg>
                        </a></li>
                    <li><a href="https://t.me/biblesocietyincambodia" class="shadow-sm drop-shadow-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                                strokeLinejoin="round"
                                className="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                            </svg>
                        </a></li>
                    <li><a href="https://www.pinterest.com/biblesocietyincambodia"
                            class="shadow-sm drop-shadow-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                                strokeLinejoin="round"
                                className="icon icon-tabler icons-tabler-outline icon-tabler-brand-pinterest">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 20l4 -9" />
                                <path
                                    d="M10.7 14c.437 1.263 1.43 2 2.55 2c2.071 0 3.75 -1.554 3.75 -4a5 5 0 1 0 -9.7 1.7" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            </svg>
                        </a></li>
                </ul>
            </li>

            {{-- Contact Information --}}
            <li class="space-y-[1rem] list-none py-5 xl:py-0">
                <h1 class="text-[20px] text-[#000] text-start font-semibold my-1">{{ __('messages.information') }}
                </h1>
                <ul class="space-y-[1rem] text-[#fff]">
                    <li>
                        <p>www.biblecambodia.org</p>
                        <p>Email: info@biblecambodia.org</p>
                    </li>
                    <li>
                        <p class="text-[16px] font-semibold">{{ __('messages.siem_reap') }}</p>
                        <p>{{ __('messages.sr_address') }}</p>
                    </li>
                    <li>
                        <p class="text-[16px] font-semibold">{{ __('messages.Bible_Distribution_Center') }}</p>
                        <p>{{ __('messages.bdc_address') }}</p>
                    </li>
                </ul>
            </li>

        </ul>
    </div>

    <div class="w-full bg-[#292929] py-3">
        <h1 class="text-[14px] text-white text-center">
            © Bible Society in Cambodia {{ date('Y') }}
        </h1>
    </div>
</footer>
