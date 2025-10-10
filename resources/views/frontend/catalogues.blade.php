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
    <section class="w-full h-[60vh] md:h-screen flex items-center justify-center overflow-hidden"
        style="background-image: url('{{ asset('assets/images/Banners/cata_banner.png') }}'); background-size: cover; background-position: center;">
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

    {{-- Catalogue + Books --}}
    <div class="w-full min-h-[70vh] max-w-7xl mx-auto p-4 my-10" x-data="bookOrder()">

        @forelse($catalogues as $catalogue)
            {{-- Category Header --}}
            <div class="mb-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-[80px] h-[80px] bg-white rounded-[20px] flex items-center justify-center">
                        <img src="{{ $catalogue->image ? asset($catalogue->image) : 'https://ui-avatars.com/api/?name=' . urlencode($catalogue->name_en) }}"
                            class="w-[60px] h-[60px] object-contain" alt="">
                    </div>
                    <h2 class="text-[#4FC9EE] text-[22px] md:text-[28px] font-bold">
                        {{ $locale === 'km' ? $catalogue->name_km : $catalogue->name_en }}
                    </h2>
                </div>

                {{-- Book Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($catalogue->catabooks as $book)
                        @php
                            $name = $locale === 'km' ? $book->name_km : $book->name_en;
                            $type = $locale === 'km' ? $book->type_km : $book->type_en;
                            $size = $locale === 'km' ? $book->size_km : $book->size_en;
                        @endphp

                        <div class="w-full bg-white shadow-lg p-4 rounded-[20px] flex flex-col justify-between">
                            <div class="bg-[#E4E4E4] p-3 rounded-[15px]">
                                <img src="{{ asset($book->image) }}" alt="{{ $name }}"
                                    class="w-full h-[160px] object-contain rounded-[10px]">
                            </div>
                            <h4 class="mt-3 text-[16px] font-semibold">{{ $name }}</h4>
                            <p class="text-[14px] text-gray-600">{{ $type }}</p>

                            <div class="flex gap-2 mt-3">
                                {{-- <button @click="openOrderModal('{{ $name }}', '{{ $type }}')"
                                    class="w-full py-2 bg-[#32CDF0] text-white rounded-md">
                                    {{ $locale === 'km' ? 'ជាវឥឡូវនេះ' : 'Buy Now' }}
                                </button> --}}
                                <a href="https://t.me/thebiblesocietyincambodia" target="_blank"
                                    class="w-full py-2 bg-[#32CDF0] text-white rounded-md text-center">
                                    {{ $locale === 'km' ? 'ជាវឥឡូវនេះ' : 'Buy Now' }}
                                </a>

                                <button
                                    @click="openDetailsModal('{{ $name }}', '{{ $type }}', '{{ $size }}', '{{ $book->code ?? '' }}', '{{ $book->isbn ?? '' }}')"
                                    class="w-full py-2 bg-[#32CDF0] text-white rounded-md">
                                    {{ $locale === 'km' ? 'ព័ត៌មានលម្អិត' : 'Details' }}
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400">{{ $locale === 'km' ? 'មិនមានសៀវភៅទេ។' : 'No books found.' }}</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p class="text-black text-center text-lg">{{ $locale === 'km' ? 'មិនមានប្រភេទទេ។' : 'No categories found.' }}
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
            <div @click.away="closeModal()" class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-xl font-semibold mb-4">{{ $locale === 'km' ? 'ព័ត៌មានលម្អិត' : 'Details' }}</h2>
                <p>{{ $locale === 'km' ? 'ឈ្មោះ' : 'Name' }} : <span class="font-light" x-text="selectedBook.name"></span>
                </p>
                <p>{{ $locale === 'km' ? 'ប្រភេទ' : 'Type' }} : <span class="font-light" x-text="selectedBook.type"></span>
                </p>
                <p>{{ $locale === 'km' ? 'ទំហំ' : 'Size' }} : <span class="font-light" x-text="selectedBook.size"></span>
                </p>
                <p>{{ $locale === 'km' ? 'លេខកូដ' : 'Code' }} : <span class="font-light" x-text="selectedBook.code"></span>
                </p>
                <p>{{ $locale === 'km' ? 'លេខ ISBN' : 'ISBN' }} : <span class="font-light"
                        x-text="selectedBook.isbn"></span></p>
                <div class="flex justify-end mt-4">
                    <button @click="closeModal()" class="px-4 py-2 bg-gray-300 rounded-md">
                        {{ $locale === 'km' ? 'បិទ' : 'Close' }}
                    </button>
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
