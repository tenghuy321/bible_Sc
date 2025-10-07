@extends('layouts.master')
@section('content')
    <section class="w-full h-[90vh] sm:h-[80vh] md:h-screen flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/read_banner.png') }}'); background-size: cover; background-position: center;">
        <div class="flex flex-col md:flex-row items-center justify-between gap-2 w-full max-w-7xl mx-auto px-4 md:px-16 lg:px-20 mt-10 md:mt-0">
            <div class="text-[#fff] w-full" data-aos="fade-right" data-aos-duration="1000">
                <p class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">{{ __('messages.title-1') }}
                </p>
                <h1 class="text-[20px] md:text-[50px] xl:text-[5rem] font-[600] leading-none">
                    {!! nl2br(__('messages.welcome')) !!}
                </h1>
                <p data-aos="fade-left" data-aos-duration="1000"
                    class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400] pt-4">
                    {{ __('messages.quote') }}</p>
            </div>

            <div data-aos="fade-left" data-aos-duration="1000"
                class="relative w-full lg:w-[80%] pl-4 lg:pl-10 mt-4 md:mt-0 before:content-[''] before:absolute before:left-0 before:top-0 before:h-full before:w-[2px] before:bg-[#4FC9EE]">
                <!-- Text -->
                <p class="text-[20px] xl:text-[24px] text-white font-[600]">
                    {{ __('messages.contact') }}
                </p>
                <div class="text-[13px] sm:text-[14px] xl:text-[16px] text-white font-[600] mt-2">
                    <div class="flex items-center gap-2">
                        {{-- {{ __('messages.contact') }} --}}
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="15" r="15" fill="#4FC9EE" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.73303 7.04305C8.95003 5.83305 10.954 6.04805 11.973 7.41005L13.235 9.09405C14.065 10.2021 13.991 11.7501 13.006 12.7291L12.768 12.9671C12.741 13.067 12.7383 13.1719 12.76 13.2731C12.823 13.6811 13.164 14.5451 14.592 15.9651C16.02 17.3851 16.89 17.7251 17.304 17.7891C17.4083 17.81 17.5161 17.807 17.619 17.7801L18.027 17.3741C18.903 16.5041 20.247 16.3411 21.331 16.9301L23.241 17.9701C24.878 18.8581 25.291 21.0821 23.951 22.4151L22.53 23.8271C22.082 24.2721 21.48 24.6431 20.746 24.7121C18.936 24.8811 14.719 24.6651 10.286 20.2581C6.14903 16.1441 5.35503 12.5561 5.25403 10.7881C5.20403 9.89405 5.62603 9.13805 6.16403 8.60405L7.73303 7.04305ZM10.773 8.30905C10.266 7.63205 9.32203 7.57805 8.79003 8.10705L7.22003 9.66705C6.89003 9.99505 6.73203 10.3571 6.75203 10.7031C6.83203 12.1081 7.47203 15.3451 11.344 19.1951C15.406 23.2331 19.157 23.3541 20.607 23.2181C20.903 23.1911 21.197 23.0371 21.472 22.7641L22.892 21.3511C23.47 20.7771 23.343 19.7311 22.525 19.2871L20.615 18.2481C20.087 17.9621 19.469 18.0561 19.085 18.4381L18.63 18.8911L18.1 18.3591C18.63 18.8911 18.629 18.8921 18.628 18.8921L18.627 18.8941L18.624 18.8971L18.617 18.9031L18.602 18.9171C18.5598 18.9562 18.5143 18.9917 18.466 19.0231C18.386 19.0761 18.28 19.1351 18.147 19.1841C17.877 19.2851 17.519 19.3391 17.077 19.2711C16.21 19.1381 15.061 18.5471 13.534 17.0291C12.008 15.5111 11.412 14.3691 11.278 13.5031C11.209 13.0611 11.264 12.7031 11.366 12.4331C11.4222 12.2811 11.5025 12.1393 11.604 12.0131L11.636 11.9781L11.65 11.9631L11.656 11.9571L11.659 11.9541L11.661 11.9521L11.949 11.6661C12.377 11.2391 12.437 10.5321 12.034 9.99305L10.773 8.30905Z"
                                fill="white" />
                        </svg>
                        {{ app()->getLocale() === 'km' ? 'ទូរស័ព្ទ :' : 'Phone :' }}
                    </div>
                    <p class="pl-10">{{ app()->getLocale() === 'km' ? 'ភ្នំពេញ :' : 'Phnom Penh :' }} <span
                            class="font-[400]">+855 81 737 459 | 85 737 459</span></p>
                    <p class="pl-10">{{ app()->getLocale() === 'km' ? 'សៀមរាប :' : 'Siem Reap :' }} <span
                            class="font-[400]">+855 81 737 459 | 85 737 459</span></p>
                </div>

                <div
                    class="text-[13px] sm:text-[14px] xl:text-[16px] text-white font-[600] flex items-center gap-2 transition-all duration-300 mt-3">
                    <div>
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="15" r="15" fill="#4FC9EE" />
                            <path
                                d="M25 9C25 7.9 24.1 7 23 7H7C5.9 7 5 7.9 5 9V21C5 22.1 5.9 23 7 23H23C24.1 23 25 22.1 25 21V9ZM23 9L15 14L7 9H23ZM23 21H7V11L15 16L23 11V21Z"
                                fill="white" />
                        </svg>
                    </div>

                    <p>{{ app()->getLocale() === 'km' ? 'អ៊ីមែល :' : 'Email :' }} <a href="mailto:info@biblecambodia.org"
                            class="font-[400] hover:underline hover:text-[#4FC9EE]">info@biblecambodia.org</a></p>
                </div>

                <div
                    class="text-[13px] sm:text-[14px] xl:text-[16px] text-white font-[400] flex items-center md:items-start lg:items-center gap-2 transition-all duration-300 mt-3">
                    <div>
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="15" r="15" fill="#4FC9EE" />
                            <path
                                d="M15 24C19.9706 24 24 19.9706 24 15C24 10.0294 19.9706 6 15 6C10.0294 6 6 10.0294 6 15C6 19.9706 10.0294 24 15 24Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 11V16H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>

                    <p>Office Hours: MON - FRI 08:00 AM - 4:30 PM</p>
                </div>

                <div
                    class="text-[13px] sm:text-[14px] xl:text-[16px] text-white font-[400] flex items-center md:items-start gap-2 transition-all duration-300 mt-3">
                    <div>
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="15" r="15" fill="#4FC9EE" />
                            <path
                                d="M15 6C12.8921 5.99989 10.8693 6.83176 9.37124 8.31479C7.87323 9.79782 7.02108 11.8122 7 13.92C7 19.4 14.05 25.5 14.35 25.76C14.5311 25.9149 14.7616 26.0001 15 26.0001C15.2384 26.0001 15.4689 25.9149 15.65 25.76C16 25.5 23 19.4 23 13.92C22.9789 11.8122 22.1268 9.79782 20.6288 8.31479C19.1307 6.83176 17.1079 5.99989 15 6ZM15 23.65C13.33 22.06 9 17.65 9 13.92C9 12.3287 9.63214 10.8026 10.7574 9.67736C11.8826 8.55214 13.4087 7.92 15 7.92C16.5913 7.92 18.1174 8.55214 19.2426 9.67736C20.3679 10.8026 21 12.3287 21 13.92C21 17.62 16.67 22.06 15 23.65Z"
                                fill="white" />
                            <path
                                d="M15 10C14.3078 10 13.6311 10.2053 13.0555 10.5899C12.4799 10.9744 12.0313 11.5211 11.7664 12.1606C11.5015 12.8001 11.4322 13.5039 11.5673 14.1828C11.7023 14.8618 12.0356 15.4854 12.5251 15.9749C13.0146 16.4644 13.6383 16.7977 14.3172 16.9327C14.9961 17.0678 15.6999 16.9985 16.3394 16.7336C16.9789 16.4687 17.5256 16.0201 17.9101 15.4445C18.2947 14.8689 18.5 14.1922 18.5 13.5C18.5 12.5717 18.1313 11.6815 17.4749 11.0251C16.8185 10.3687 15.9283 10 15 10ZM15 15C14.7033 15 14.4133 14.912 14.1666 14.7472C13.92 14.5824 13.7277 14.3481 13.6142 14.074C13.5007 13.7999 13.4709 13.4983 13.5288 13.2074C13.5867 12.9164 13.7296 12.6491 13.9393 12.4393C14.1491 12.2296 14.4164 12.0867 14.7074 12.0288C14.9983 11.9709 15.2999 12.0006 15.574 12.1142C15.8481 12.2277 16.0824 12.42 16.2472 12.6666C16.412 12.9133 16.5 13.2033 16.5 13.5C16.5 13.8978 16.342 14.2794 16.0607 14.5607C15.7794 14.842 15.3978 15 15 15Z"
                                fill="white" />
                        </svg>
                    </div>

                    <p>34, Street 104P6, Phnom Penh Thmey, Khan Sen Sok, Phnom Penh</p>
                </div>
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
