@extends('layouts.master')
@section('content')
    @php $locale = app()->getLocale(); @endphp

    {{-- Banner --}}
    {{-- <div class="w-full h-[60vh] md:h-screen bg-gray-100 flex items-center justify-center"
        style="background-image: url('{{ asset('assets/images/Banners/cata_banner.png') }}'); background-size: cover; background-position: center;">
        <div class="text-center max-w-[800px] mx-auto">
            <p class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">
                សមាគមព្រះគម្ពីរនៅកម្ពុជា
            </p>
            <h1
                class="font-bold text-white {{ $locale === 'km' ? 'text-[20px] md:text-[50px] xl:text-[5rem]' : 'text-[20px] md:text-[50px] xl:text-[5rem]' }}">
                {{ __('messages.welcome') }}
            </h1>
            <p class="text-[#fff] text-[14px] xl:text-[24px] font-[400]">{{ __('messages.quote') }}</p>
        </div>
    </div> --}}
    <section class="w-full h-[60vh] lg:h-screen big-hight flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/cata_banner.png') }}'); background-size: cover; background-position: center;">
    </section>

    <div class="w-full min-h-[70vh] max-w-7xl mx-auto p-4 my-10" x-data="bookOrder()">

        <div x-data="{
            open: false,
            mode: '',
            selectedBook: {
                name: '',
                type: '',
                size: '',
                code: '',
                isbn: '',
                images: []
            },
            openDetailsModal(name, type, size, code, isbn, images) {
                this.open = true;
                this.mode = 'details';
                this.selectedBook = {
                    name,
                    type,
                    size,
                    code,
                    isbn,
                    images: JSON.parse(images || '[]')
                };
                this.$nextTick(() => {
                    if (window.MissionSwiperInstance) window.MissionSwiperInstance.destroy();
                    window.MissionSwiperInstance = new Swiper('.MissionSwiper', {
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        loop: true,
                    });
                });
            },
            closeModal() {
                this.open = false;
                this.mode = '';
            }
        }">

            {{-- Catalogue List --}}
            @forelse($catalogues as $catalogue)
                <div class="mb-10">
                    <div class="flex items-center gap-4 {{ $catalogue->id !== 'cmdmthruw000656ensuaq6dm8' ? 'mt-4 md:mt-[12rem]' : 'mt-4' }} mt-40 mb-10">
                        <h2 class="text-[#000] text-[22px] md:text-[28px] font-bold">
                            {{ $locale === 'km' ? $catalogue->name_km : $catalogue->name_en }}
                        </h2>
                    </div>

                    {{-- Book Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @forelse($catalogue->catabooks as $book)
                            @php
                                $name = $locale === 'km' ? $book->name_km : $book->name_en;
                                $type = $locale === 'km' ? $book->type_km : $book->type_en;
                                $size = $locale === 'km' ? $book->size_km : $book->size_en;
                                $images = json_encode(json_decode($book->images ?? '[]'));
                            @endphp

                            <div class="relative flex flex-col items-stretch text-start p-6">

                                @if ($loop->iteration % 4 == 1 || $loop->iteration % 4 == 3)
                                    <div class="absolute top-0 right-0 h-full w-[1px] bg-[#000] hidden xl:block"></div>
                                @endif

                                <div class="w-[300px] h-[300px] flex justify-center sm:justify-start">
                                    <img src="{{ asset($book->default_image) }}" alt="{{ $name }}"
                                        class="w-[200px] h-[300px] object-contain">
                                </div>

                                <div class="mt-3 flex-grow flex flex-col justify-between">
                                    <div>
                                        <h4 class="text-[16px] md:text-[18px] font-semibold leading-tight min-h-[48px]">{{ $name }}
                                        </h4>
                                        <ul
                                            class="text-[14px] md:text-[16px] text-[#000] mt-1 space-y-1 text-left inline-block min-h-[40px]">
                                            @if ($type)
                                                <li>- {{ $type }}</li>
                                            @endif
                                            {{-- @if ($size)
                                                <li>- {{ $size }}</li>
                                            @endif
                                            @if ($book->isbn)
                                                <li>- {{ $book->isbn }}</li>
                                            @endif --}}
                                        </ul>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-center gap-2 mt-3 w-full">
                                    <a href="https://t.me/thebiblesocietyincambodia" target="_blank"
                                        class="flex-1 py-2 bg-[#32CDF0] text-white rounded-full text-center">
                                        {{ $locale === 'km' ? 'ជាវឥឡូវនេះ' : 'Buy Now' }}
                                    </a>

                                    <button
                                        @click="openDetailsModal(
                                    '{{ $name }}',
                                    '{{ $type }}',
                                    '{{ $size }}',
                                    '{{ $book->code ?? '' }}',
                                    '{{ $book->isbn ?? '' }}',
                                    '{{ $images }}'
                                )"
                                        class="flex-1 py-2 border-2 border-[#32CDF0] text-[#32CDF0] rounded-full">
                                        {{ $locale === 'km' ? 'ព័ត៍មានបន្ថែម' : 'Details' }}
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 col-span-full text-center py-6">
                                {{ $locale === 'km' ? 'មិនមានសៀវភៅទេ។' : 'No books found.' }}
                            </p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-black text-center text-lg">
                    {{ $locale === 'km' ? 'មិនមានប្រភេទទេ។' : 'No categories found.' }}
                </p>
            @endforelse

            {{-- Order Modal --}}
            {{-- <div x-show="open && mode==='order'"
            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 px-2" x-cloak>
            <div @click.away="closeModal()" class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-xl font-semibold mb-4" x-text="`Order: ${selectedBook.name}`"></h2>
                <form @submit.prevent="sendOrder()">
                    <div class="mb-3">
                        <label class="block text-sm font-medium">{{ $locale === 'km' ? 'ឈ្មោះ' : 'Name' }}</label>
                        <input type="text" x-model="name" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label
                            class="block text-sm font-medium">{{ $locale === 'km' ? 'លេខទូរស័ព្ទ' : 'Phone Number' }}</label>
                        <input type="tel" x-model="phone" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium">{{ $locale === 'km' ? 'ទីតាំង' : 'Location' }}</label>
                        <input type="text" x-model="location" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeModal()" class="px-4 py-2 bg-gray-300 rounded-md">
                            {{ $locale === 'km' ? 'បោះបង់' : 'Cancel' }}
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                            {{ $locale === 'km' ? 'ផ្ញើ' : 'Send' }}
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}

            {{-- Details Modal --}}
            <div x-show="open && mode==='details'"
                class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 px-2" x-cloak>
                <div @click.away="closeModal()"
                    class="relative bg-white rounded-[30px] px-4 py-12 md:px-4 md:py-10 lg:p-20 max-w-5xl mx-auto w-full flex flex-col md:flex-row items-center gap-[1rem]">

                    <!-- Book Images -->
                    <div class="w-full md:w-[48%] mb-4">
                        <template x-if="selectedBook.images.length > 0">
                            <div class="swiper MissionSwiper w-full h-full">
                                <div class="swiper-wrapper w-full h-full">
                                    <template x-for="(img, index) in selectedBook.images" :key="index">
                                        <div class="swiper-slide w-full h-full">
                                            <img :src="`${img}`" alt=""
                                                class="w-full h-[300px] rounded-[30px] object-cover object-bottom">
                                        </div>
                                    </template>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </template>

                        <div x-show="!selectedBook.images.length" class="text-gray-500 text-center py-4">
                            {{ $locale === 'km' ? 'មិនមានរូបភាពទេ។' : 'No images available.' }}
                        </div>
                    </div>

                    <!-- Book Details -->
                    <div class="w-full md:w-[48%] text-[16px] md:text-[18px] text-[#000] px-10">
                        <h2 class="text-[20px] md:text-[25px] lg:text-[30px] text-[#4FC9EE] mb-4">
                            {{ $locale === 'km' ? 'ព័ត៌មានលម្អិត' : 'Details' }}</h2>
                        <p>{{ $locale === 'km' ? 'ឈ្មោះ' : 'Name' }}: <span class="font-light"
                                x-text="selectedBook.name"></span></p>
                        <p>{{ $locale === 'km' ? 'ប្រភេទ' : 'Type' }}: <span class="font-light"
                                x-text="selectedBook.type"></span></p>
                        <p>{{ $locale === 'km' ? 'ទំហំ' : 'Size' }}: <span class="font-light"
                                x-text="selectedBook.size"></span></p>
                        <p>{{ $locale === 'km' ? 'លេខកូដ' : 'Code' }}: <span class="font-light"
                                x-text="selectedBook.code"></span></p>
                        <p>{{ $locale === 'km' ? 'លេខ ISBN' : 'ISBN' }}: <span class="font-light"
                                x-text="selectedBook.isbn"></span></p>

                    </div>

                    <div class="absolute top-2 md:top-4 right-2 md:right-4">
                        <button @click="closeModal()">
                            <svg width="43" height="43" viewBox="0 0 43 43" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21.5" cy="21.5" r="21.5" fill="#F0F0F0" />
                                <path
                                    d="M28.34 29H24.88L21.56 23.6L18.24 29H15L19.74 21.64L15.3 14.72H18.64L21.72 19.86L24.74 14.72H28L23.52 21.8L28.34 29Z"
                                    fill="#D30000" />
                            </svg>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function bookOrder() {
            return {
                open: false,
                mode: '',
                selectedBook: {
                    name: '',
                    type: '',
                    size: '',
                    code: '',
                    isbn: ''
                },
                name: '',
                location: '',
                phone: '',
                openOrderModal(bookName, bookType) {
                    this.mode = 'order';
                    this.selectedBook.name = bookName;
                    this.selectedBook.type = bookType;
                    this.open = true;
                },
                openDetailsModal(bookName, bookType, bookSize, bookCode, bookIsbn) {
                    this.mode = 'details';
                    this.selectedBook = {
                        name: bookName,
                        type: bookType,
                        size: bookSize,
                        code: bookCode,
                        isbn: bookIsbn
                    };
                    this.open = true;
                },
                closeModal() {
                    this.open = false;
                    this.mode = '';
                    this.name = '';
                    this.location = '';
                },
                sendOrder() {
                    const locale = '{{ app()->getLocale() }}';
                    const messages = {
                        success: locale === 'km' ? 'ការបញ្ជាទិញបានផ្ញើជោគជ័យ!' : 'Order sent successfully!',
                        fail: locale === 'km' ? 'ការបញ្ជាទិញបរាជ័យ!' : 'Failed to send order!',
                        error: locale === 'km' ? 'មានបញ្ហាអ្វីមួយ!' : 'Something went wrong!'
                    };

                    fetch('{{ route('telegram.sendOrder') }}', {
                            method: 'POST',
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                name: this.name,
                                phone: this.phone,
                                location: this.location,
                                book: this.selectedBook.name,
                                type: this.selectedBook.type
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: data.success ? 'success' : 'error',
                                title: data.success ? messages.success : messages.fail,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                            if (data.success) this.closeModal();
                        })
                        .catch(() => {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: messages.error,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        });
                }
            }
        }
    </script>
@endsection
