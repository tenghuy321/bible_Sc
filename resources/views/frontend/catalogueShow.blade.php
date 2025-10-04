@extends('layouts.master')
@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="w-full h-[60vh] md:h-screen bg-gray-100 flex items-center justify-center "
        style="background-image: url('{{ asset('assets/images/Banners/cata_banner.png') }}'); background-size: cover; background-position: center;">

        <div class="relative flex justify-between items-center max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] md:space-x-[8rem] xl:space-x-[14rem] overflow-hidden">
            <div class="w-full">
                <p data-aos="fade-right" data-aos-duration="400"
                    class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">
                    សមាគមព្រះគម្ពីរនៅកម្ពុជា
                </p>

                <h1 data-aos="fade-right" data-aos-duration="500"
                    class="font-bold text-wrap text-[#ffffff]
                    {{ $locale === 'km'
                        ? 'text-[20px] md:text-[50px] xl:text-[5rem]'
                        : 'text-[20px] leading-[20px] md:text-[50px] md:leading-[50px] xl:text-[5rem] xl:leading-[5rem]' }}">
                    {{ __('messages.welcome') }}
                </h1>
            </div>

            <p data-aos="fade-left" data-aos-duration="600"
                class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400]">
                {{ __('messages.quote') }}
            </p>
        </div>
    </div>

    <div class="w-full min-h-[70vh] max-w-7xl mx-auto p-4 my-10">
        {{-- Version Tabs --}}
        {{-- <div class="w-full flex gap-3 pb-2 justify-center items-center">
            @foreach ($versions as $vs)
                <a href="{{ url('catalogue/' . $catalogue->slug . '?version=' . $vs->slug) }}"
                    class="w-full text-center text-md md:text-xl px-2 py-[7px] md:py-[12px] rounded-full
                          {{ request('version') == $vs->slug ? 'bg-[#32CDF0] text-white' : 'bg-white text-black border border-[#32CDF0]' }}">
                    {{ app()->getLocale() === 'km' ? $vs->name_km : $vs->name_en }}
                </a>
            @endforeach
        </div> --}}

        {{-- Book List --}}
        <div x-data="bookOrder()"
            class="w-full h-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-4 justify-center my-2">
            @forelse($catabooks as $cata)
                @php
                    $name = app()->getLocale() === 'km' ? $cata->name_km : $cata->name_en;
                    $type = app()->getLocale() === 'km' ? $cata->type_km : $cata->type_en;
                    $size = app()->getLocale() === 'km' ? $cata->size_km : $cata->size_en;
                @endphp
                <div class="w-full bg-white shadow drop-shadow-lg p-4 rounded-[20px] flex flex-col justify-between">
                    <div class="w-full h-fit mx-auto bg-[#E4E4E4] p-3 rounded-[20px]">
                        <img src="{{ asset($cata->image) }}"
                            alt="{{ $name }}"
                            class="w-[15vh] h-[15vh] md:w-[16vh] md:h-[16vh] xl:w-[20vh] xl:h-[20vh] mx-auto object-contain object-center">
                    </div>

                    <h1 class="text-[16px] md:text-[18px] xl:text-[20px] text-[#000] font-semibold mt-4">
                        {{ $name }}
                    </h1>

                    <div class="flex flex-row gap-2 mt-1">
                        <button @click="openOrderModal('{{ $name }}', '{{ $type }}')"
                            class="w-full px-6 py-2 bg-[#32CDF0] text-white mt-3 rounded-md">
                            {{ app()->getLocale() === 'km' ? 'ជាវឥឡូវនេះ' : 'Buy Now' }}
                        </button>

                        <button
                            @click="openDetailsModal('{{ $name }}', '{{ $type }}', '{{ $size }}', '{{ $cata->code ?? '' }}', '{{ $cata->isbn ?? '' }}')"
                            class="w-full px-6 py-2 bg-[#32CDF0] text-white mt-3 rounded-md">
                            {{ app()->getLocale() === 'km' ? 'ព័ត៌មានលម្អិត' : 'Details' }}
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-black text-center text-sm md:text-xl">
                    {{ app()->getLocale() === 'km' ? 'មិនមានសៀវភៅទេ។' : 'No books found.' }}
                </p>
            @endforelse

            <!-- Order Modal -->
            <div x-show="open && mode==='order'"
                class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 px-2" x-cloak>
                <div @click.away="closeModal()" class="bg-white rounded-lg p-6 w-96">
                    <h2 class="text-xl font-semibold mb-4" x-text="`Order: ${selectedBook.name}`"></h2>
                    <form @submit.prevent="sendOrder()">
                        <div class="mb-3">
                            <label
                                class="block text-sm font-medium">{{ app()->getLocale() === 'km' ? 'ឈ្មោះ' : 'Name' }}</label>
                            <input type="text" x-model="name" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>
                        <div class="mb-3">
                            <label
                                class="block text-sm font-medium">{{ app()->getLocale() === 'km' ? 'ទីតាំង' : 'Location' }}</label>
                            <input type="text" x-model="location" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="closeModal()"
                                class="px-4 py-2 bg-gray-300 rounded-md">{{ app()->getLocale() === 'km' ? 'បោះបង់' : 'Cancel' }}</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md">{{ app()->getLocale() === 'km' ? 'ផ្ញើ' : 'Send' }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Details Modal -->
            <div x-show="open && mode==='details'"
                class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 px-2" x-cloak>
                <div @click.away="closeModal()" class="bg-white rounded-lg font-semibold p-6 w-96">
                    <h2 class="text-xl font-semibold mb-4">{{ app()->getLocale() === 'km' ? 'ព័ត៌មានលម្អិត' : 'Details' }}</h2>
                    <p>{{ app()->getLocale() === 'km' ? 'ឈ្មោះ' : 'Name' }} : <span class="font-light" x-text="selectedBook.name"></span></p>
                    <p>{{ app()->getLocale() === 'km' ? 'ប្រភេទ' : 'Type' }} : <span class="font-light" x-text="selectedBook.type"></span></p>
                    <p>{{ app()->getLocale() === 'km' ? 'ទំហំ' : 'Size' }} : <span class="font-light" x-text="selectedBook.size"></span></p>
                    <p>{{ app()->getLocale() === 'km' ? 'លេខកូដ' : 'Code' }} : <span class="font-light" x-text="selectedBook.code"></span></p>
                    <p>{{ app()->getLocale() === 'km' ? 'Isbn' : 'Isbn' }} : <span class="font-light" x-text="selectedBook.isbn"></span></p>
                    <div class="flex justify-end mt-4">
                        <button @click="closeModal()"
                            class="px-4 py-2 bg-gray-300 rounded-md">{{ app()->getLocale() === 'km' ? 'បិទ' : 'Close' }}</button>
                    </div>
                </div>
            </div>

        </div>


        <div class="mt-6 md:mt-10">
            <a href="{{ route('cata') }}" class="py-3 px-8 bg-[#32CDF0] text-[#fff] font-[600] rounded-md">
                {{ app()->getLocale() === 'km' ? 'ត្រឡប់ក្រោយ' : 'Back' }}
            </a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function bookOrder() {
            return {
                open: false,
                mode: '', // 'order' or 'details'
                selectedBook: {
                    name: '',
                    type: '',
                    size: '',
                    code: '',
                    isbn: ''
                },
                name: '',
                location: '',
                openOrderModal(bookName, bookType) {
                    this.mode = 'order';
                    this.selectedBook.name = bookName;
                    this.selectedBook.type = bookType;
                    this.open = true;
                },
                openDetailsModal(bookName, bookType, bookSize, bookCode, bookIsbn) {
                    this.mode = 'details';
                    this.selectedBook.name = bookName;
                    this.selectedBook.type = bookType;
                    this.selectedBook.size = bookSize;
                    this.selectedBook.code = bookCode;
                    this.selectedBook.isbn = bookIsbn;
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
                                location: this.location,
                                book: this.selectedBook.name,
                                type: this.selectedBook.type
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: messages.success,
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                                this.closeModal();
                            } else {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: messages.fail,
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                            }
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
