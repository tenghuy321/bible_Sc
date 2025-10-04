@extends('layouts.master')

@section('content')
    @php
        $locale = app()->getLocale();

        function khmerToArabic($num)
        {
            $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
            $arabicDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            return intval(str_replace($khmerDigits, $arabicDigits, $num));
        }
    @endphp

    <div class="w-full h-[60vh] md:h-screen bg-gray-100 flex items-center justify-center "
        style="background-image: url('{{ asset('assets/images/Banners/aboutus.png') }}'); background-size: cover; background-position: center;">

        <div
            class="relative flex justify-between items-center max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] md:space-x-[8rem] xl:space-x-[14rem] overflow-hidden">
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

    <div class="w-full max-w-7xl mx-auto px-2 py-10">
        <h1 class="text-2xl font-bold mb-6">{{ $selectedVersionName }}</h1>

        <div class="w-full mt-6" x-data="{
            selectedBook: '{{ $books->first()->id ?? '' }}',
            selectedBookName: '{{ $locale === 'en' ? $books->first()->nameEn ?? '' : $books->first()->nameKm ?? '' }}',
            selectedChapter: '{{ $books->first()?->chapters->first()->id ?? '' }}',
            selectedChapterName: '{{ $locale === 'en' ? $books->first()?->chapters->first()->nameEn ?? '' : $books->first()?->chapters->first()->nameKm ?? '' }}',
            bookPopup: false,
            chapterPopup: false,
            closeAll() {
                this.bookPopup = false;
                this.chapterPopup = false;
            }
        }" @click.outside="closeAll()">

            <div class="w-full grid grid-cols-2 gap-4 sticky top-0 bg-white z-10">
                {{-- Book Dropdown --}}
                <div class="relative mb-4">
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ $locale === 'en' ? 'Select Book' : 'ជ្រើសរើសគម្ពីរ' }}
                    </label>

                    <button @click.stop="bookPopup = !bookPopup; chapterPopup = false"
                        class="w-full border rounded-md px-3 py-2 text-left bg-white hover:bg-gray-100">
                        <span
                            x-text="selectedBookName || '{{ $locale === 'en' ? 'Choose a book' : 'ជ្រើសរើសគម្ពីរ' }}'"></span>
                    </button>

                    <div x-show="bookPopup" x-transition x-cloak
                        class="absolute mt-1 w-full bg-white border rounded-md shadow-lg max-h-60 overflow-y-auto z-50">
                        @foreach ($books as $book)
                            <button class="w-full text-left px-3 py-2 hover:bg-blue-100"
                                @click="
                                selectedBook='{{ $book->id }}';
                                selectedBookName='{{ $locale === 'en' ? $book->nameEn : $book->nameKm }}';
                                selectedChapter='{{ $book->chapters->first()->id ?? '' }}';
                                selectedChapterName='{{ $locale === 'en' ? $book->chapters->first()->nameEn ?? '' : $book->chapters->first()->nameKm ?? '' }}';
                                bookPopup=false;
                            ">
                                {{ $locale === 'en' ? $book->nameEn : $book->nameKm }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Chapter Dropdown --}}
                <div class="relative mb-4">
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ $locale === 'en' ? 'Select Chapter' : 'ជ្រើសរើសជំពូក' }}
                    </label>

                    <template x-if="selectedBook !== ''">
                        <div>
                            <button @click.stop="chapterPopup = !chapterPopup; bookPopup = false"
                                class="w-full border rounded-md px-3 py-2 text-left bg-white hover:bg-gray-100">
                                <span
                                    x-text="selectedChapterName || '{{ $locale === 'en' ? 'Choose a chapter' : 'ជ្រើសរើសជំពូក' }}'"></span>
                            </button>

                            {{-- Chapter Popup --}}
                            <div x-show="chapterPopup" x-transition x-cloak
                                class="absolute mt-1 w-full bg-white border rounded-md shadow-lg max-h-60 overflow-y-auto z-50">
                                @foreach ($books as $book)
                                    <template x-if="selectedBook === '{{ $book->id }}'">
                                        <div>
                                            @foreach ($book->chapters->sortBy(function ($c) use ($locale) {
            return $locale === 'en' ? intval($c->nameEn) : khmerToArabic($c->nameKm);
        }) as $chapter)
                                                <button class="w-full text-left px-3 py-2 hover:bg-blue-100"
                                                    @click="
                                                    selectedChapter='{{ $chapter->id }}';
                                                    selectedChapterName='{{ $locale === 'en' ? $chapter->nameEn : $chapter->nameKm }}';
                                                    chapterPopup=false;
                                                ">
                                                    {{ $locale === 'en' ? $chapter->nameEn : $chapter->nameKm }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </template>
                                @endforeach
                            </div>
                        </div>
                    </template>

                    <template x-if="selectedBook === ''">
                        <button disabled class="w-full border rounded-md px-3 py-2 bg-gray-200 text-gray-500">
                            {{ $locale === 'en' ? 'Select a book first' : 'សូមជ្រើសរើសគម្ពីរ' }}
                        </button>
                    </template>
                </div>
            </div>

            {{-- Show Paragraph (Verse by Verse, selectable) --}}
            @foreach ($books as $book)
                @foreach ($book->chapters as $chapter)
                    <div x-show="selectedChapter === '{{ $chapter->id }}'" x-transition
                        class="mt-4 p-3 bg-gray-100 rounded text-gray-800" x-data="{ selectedVerse: null }">
                        @php
                            $paragraph = $locale === 'en' ? $chapter->paragraphEn ?? '' : $chapter->paragraphKm ?? '';

                            if (preg_match_all('/\d+\s.*?(?=\d+\s|$)/s', $paragraph, $matches)) {
                                $verses = $matches[0];
                            } else {
                                $verses = [$paragraph];
                            }
                        @endphp

                        @foreach ($verses as $index => $verse)
                            <span class="cursor-pointer mr-1" {{-- remove block and add margin between verses --}}
                                :class="{ 'underline': selectedVerse === {{ $index }} }"
                                @click="selectedVerse = {{ $index }}">
                                {!! trim($verse) !!}
                            </span>
                        @endforeach
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
