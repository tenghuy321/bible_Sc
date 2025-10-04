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

<div class="w-full h-[60vh] md:h-screen bg-gray-100 flex items-center justify-center"
    style="background-image: url('{{ asset('assets/images/Banners/aboutus.png') }}'); background-size: cover; background-position: center;">
    <div class="relative flex justify-between items-center max-w-[350px] md:max-w-[720px] xl:max-w-[1200px] md:space-x-[8rem] xl:space-x-[14rem] overflow-hidden">
        <div class="w-full">
            <p data-aos="fade-right" data-aos-duration="400"
                class="text-[14px] md:text-[30px] text-[#4FC9EE] font-light font-kantumruy">
                សមាគមព្រះគម្ពីរនៅកម្ពុជា
            </p>

            <h1 data-aos="fade-right" data-aos-duration="500"
                class="font-bold text-wrap text-[#ffffff]
                {{ $locale === 'km' ? 'text-[20px] md:text-[50px] xl:text-[5rem]' : 'text-[20px] leading-[20px] md:text-[50px] md:leading-[50px] xl:text-[5rem] xl:leading-[5rem]' }}">
                {{ __('messages.welcome') }}
            </h1>
        </div>

        <p data-aos="fade-left" data-aos-duration="600"
            class="w-full text-[14px] xl:text-[24px] text-[#ffffff] font-[400]">
            {{ __('messages.quote') }}
        </p>
    </div>
</div>

<div class="w-full max-w-7xl mx-auto px-2 py-10" x-data="{
    locale: '{{ $locale }}',
    // Restore from localStorage or default to first book/chapter
    selectedVersionName: '{{ $locale === 'en' ? $version->titleEn : $version->titleKm }}',
    selectedBook: localStorage.getItem('selectedBook') || '{{ $books->first()->id ?? '' }}',
    selectedBookName: localStorage.getItem('selectedBookName') || '{{ $locale === 'en' ? $books->first()->nameEn ?? '' : $books->first()->nameKm ?? '' }}',
    selectedChapter: localStorage.getItem('selectedChapter') || '{{ $books->first()?->chapters->first()?->id ?? '' }}',
    selectedChapterName: localStorage.getItem('selectedChapterName') || '{{ $locale === 'en' ? $books->first()?->chapters->first()?->nameEn ?? '' : $books->first()?->chapters->first()?->nameKm ?? '' }}',
    bookPopup: false,
    chapterPopup: false,
    versionPopup: false,
    booksData: [
        @foreach ($books as $book)
        {
            id: '{{ $book->id }}',
            nameEn: '{{ $book->nameEn }}',
            nameKm: '{{ $book->nameKm }}',
            chapters: [
                @foreach ($book->chapters->sortBy(function($c) use ($locale){ return $locale === "en" ? intval($c->nameEn) : khmerToArabic($c->nameKm); }) as $chapter)
                { id: '{{ $chapter->id }}', nameEn: '{{ $chapter->nameEn }}', nameKm: '{{ $chapter->nameKm }}' },
                @endforeach
            ]
        },
        @endforeach
    ],
    closeAll() {
        this.bookPopup = false;
        this.chapterPopup = false;
        this.versionPopup = false;
    },
    selectBook(book) {
        this.selectedBook = book.id;
        this.selectedBookName = this.locale === 'en' ? book.nameEn : book.nameKm;
        localStorage.setItem('selectedBook', this.selectedBook);
        localStorage.setItem('selectedBookName', this.selectedBookName);

        if(book.chapters.length > 0) {
            this.selectChapter(book.chapters[0]);
        }
        this.bookPopup = false;
    },
    selectChapter(chapter) {
        this.selectedChapter = chapter.id;
        this.selectedChapterName = this.locale === 'en' ? chapter.nameEn : chapter.nameKm;
        localStorage.setItem('selectedChapter', this.selectedChapter);
        localStorage.setItem('selectedChapterName', this.selectedChapterName);
        this.chapterPopup = false;
    },
    currentChapterIndex() {
        for(let i=0;i<this.booksData.length;i++){
            const book = this.booksData[i];
            const idx = book.chapters.findIndex(c => c.id == this.selectedChapter);
            if(idx !== -1) return { bookIndex: i, chapterIndex: idx };
        }
        return { bookIndex: 0, chapterIndex: 0 };
    },
    prevChapter() {
        let { bookIndex, chapterIndex } = this.currentChapterIndex();
        if(chapterIndex > 0) {
            this.selectChapter(this.booksData[bookIndex].chapters[chapterIndex-1]);
        } else if(bookIndex > 0) {
            const prevBook = this.booksData[bookIndex-1];
            this.selectBook(prevBook);
            this.selectChapter(prevBook.chapters[prevBook.chapters.length-1]);
        }
    },
    nextChapter() {
        let { bookIndex, chapterIndex } = this.currentChapterIndex();
        const book = this.booksData[bookIndex];
        if(chapterIndex < book.chapters.length-1) {
            this.selectChapter(book.chapters[chapterIndex+1]);
        } else if(bookIndex < this.booksData.length-1) {
            const nextBook = this.booksData[bookIndex+1];
            this.selectBook(nextBook);
            this.selectChapter(nextBook.chapters[0]);
        }
    }
}" @click.outside="closeAll()">

    {{-- Version Dropdown --}}
    <div class="relative mb-4">
        <label class="block mb-2 font-bold text-gray-700">
            {{ $locale === 'en' ? 'Select Version' : 'ជ្រើសរើសកំណែ' }}
        </label>
        <button @click.stop="versionPopup = !versionPopup"
                class="w-full border rounded-md px-3 py-2 flex items-center justify-between text-left bg-white hover:bg-gray-100">
            <span x-text="selectedVersionName"></span>
            <svg class="w-5 h-5 text-gray-500 transform transition-transform"
                :class="versionPopup ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="versionPopup" x-transition x-cloak
            class="absolute mt-1 w-full bg-white border rounded-md shadow-lg max-h-60 overflow-y-auto z-50">
            @foreach ($versions as $v)
            <button class="w-full text-left px-3 py-2 hover:bg-blue-100"
                    @click="window.location.href='{{ route('version.show', ['locale' => $locale, 'versionSlug' => $v->slug]) }}'">
                {{ $locale === 'en' ? $v->titleEn : $v->titleKm }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="sticky top-0 bg-white pt-4 pb-2 md:mb-4 z-10">
        {{-- Book & Chapter Dropdowns --}}
        <div class="w-full grid grid-cols-2 gap-4 mb-6">
            {{-- Book --}}
            <div class="relative" x-data="{ searchBook: '' }">
                <label class="block mb-2 font-bold text-gray-700">
                    {{ $locale === 'en' ? 'Select Book' : 'ជ្រើសរើសគម្ពីរ' }}
                </label>
                <button @click.stop="bookPopup = !bookPopup; chapterPopup=false"
                        class="w-full border rounded-md px-3 py-2 flex items-center justify-between bg-white hover:bg-gray-100">
                    <span x-text="selectedBookName"></span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="bookPopup ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="bookPopup" x-transition x-cloak
                    class="absolute mt-1 w-full bg-white border rounded-md shadow-lg max-h-72 overflow-y-auto z-50">

                    <!-- Search bar -->
                    <div class="sticky top-0 bg-white border-b px-2 py-2">
                        <input type="text" placeholder="{{ $locale === 'en' ? 'Search book...' : 'ស្វែងរកគម្ពីរ...' }}"
                            class="w-full border rounded px-2 py-1 text-sm focus:ring focus:border-blue-400"
                            x-model="searchBook">
                    </div>

                    <!-- Book list -->
                    <template x-for="book in booksData.filter(b => (locale==='en'?b.nameEn:b.nameKm).toLowerCase().includes(searchBook.toLowerCase()))" :key="book.id">
                        <button class="w-full text-left px-3 py-2 hover:bg-blue-100"
                                @click="selectBook(book)"
                                x-text="locale==='en'?book.nameEn:book.nameKm"></button>
                    </template>
                </div>
            </div>

            <!-- Chapter -->
            <div class="relative">
                <label class="block mb-2 font-bold text-gray-700">
                    {{ $locale === 'en' ? 'Select Chapter' : 'ជ្រើសរើសជំពូក' }}
                </label>
                <button @click.stop="chapterPopup = !chapterPopup; bookPopup=false"
                        class="w-full border rounded-md px-3 py-2 flex items-center justify-between bg-white hover:bg-gray-100">
                    <span x-text="selectedChapterName"></span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform"
                        :class="chapterPopup ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Chapter Grid -->
                <div x-show="chapterPopup" x-transition x-cloak
                    class="absolute mt-1 w-full bg-white border rounded-md shadow-lg max-h-80 overflow-y-auto z-50 p-3">

                    <template x-for="book in booksData" :key="book.id">
                        <template x-if="book.id === selectedBook">
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-2">
                                <template x-for="chapter in book.chapters" :key="chapter.id">
                                    <button class="border rounded-md px-2 py-2 text-center hover:bg-blue-100"
                                            @click="selectChapter(chapter)"
                                            x-text="locale==='en'?chapter.nameEn:chapter.nameKm"></button>
                                </template>
                            </div>
                        </template>
                    </template>
                </div>
            </div>

        </div>


        {{-- Navigation --}}
        {{-- <div class="flex items-center justify-between mb-4 bg-white py-2">
            <button @click="prevChapter()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Prev</button>
            <button @click="nextChapter()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Next</button>
        </div> --}}
    </div>


    {{-- Left button --}}
    <button
        @click="prevChapter()"
        class="fixed top-1/2 left-4 md:left-10 transform -translate-y-1/2 bg-gray-200 w-12 h-12 flex items-center justify-center rounded-full shadow hover:bg-gray-300 z-50"
    >
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="32"
        height="32"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M15 6l-6 6l6 6" />
        </svg>

    </button>

    {{-- Right button --}}
    <button
        @click="nextChapter()"
        class="fixed top-1/2 right-4 md:right-10 transform -translate-y-1/2 bg-gray-200 w-12 h-12 flex items-center justify-center rounded-full shadow hover:bg-gray-300 z-50"
    >
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="32"
        height="32"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#000000"
        stroke-width="1"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M9 6l6 6l-6 6" />
        </svg>

    </button>



    {{-- Display current selection --}}
    <div class="text-[16px] md:text-[20px] text-[#000] font-[600] text-center flex items-center justify-center gap-2 mb-4">
        <span x-text="selectedBookName"></span>
        <span x-text="selectedChapterName"></span>
    </div>

    {{-- Verses with popup --}}
    @foreach ($books as $book)
    @foreach ($book->chapters as $chapter)
        @php
// Prefer paragraph text, fallback to content if empty
$rawParagraphs = $locale==='en' ? ($chapter->paragraphEn ?? '') : ($chapter->paragraphKm ?? '');
$rawContent = $locale==='en' ? ($chapter->contentEn ?? '') : ($chapter->contentKm ?? '');

$contentToParse = trim($rawParagraphs) ?: $rawContent;

// Normalize line breaks
$contentToParse = str_replace(['<br>', '<br/>', '<br />'], "\n", $contentToParse);

// Extract <p>, <ul>, <ol> blocks
if (preg_match_all('/(<p.*?>.*?<\/p>|<ul.*?>.*?<\/ul>|<ol.*?>.*?<\/ol>)/s', $contentToParse, $matches)) {
    $paragraphContents = $matches[0];
} else {
    // Fallback: wrap entire content if no blocks found
    $paragraphContents = [$contentToParse];
}

$spanIndex = 0;
@endphp

        <div class="w-full max-w-4xl mx-auto px-2"
            x-show="selectedChapter==='{{ $chapter->id }}'"
            x-transition
            x-data="{
                selectedSpan: null,
                selectedText: '',
                highlightColors: {},
                showPopup: false,
                copied: false,
                toggleHighlight(index, color) {
                    this.highlightColors[index] = this.highlightColors[index] === color ? null : color;
                },
                copyText() {
                    if(!this.selectedText) return;
                    navigator.clipboard.writeText(this.selectedText)
                        .then(() => { this.copied = true; setTimeout(()=> this.copied = false, 1500); });
                },
shareText() {
    const pageUrl = window.location.href;

    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: pageUrl
        }).catch(() => {});
    } else {
        navigator.clipboard.writeText(pageUrl)
            .then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 1500);
            });
    }
},
closePopup() {
    this.showPopup = false;
    this.selectedSpan = null;
}

            }"
            class="relative mb-6"
        >
            <h1 class="text-[16px] md:text-[18px] text-[#000] font-[700] mb-4">{{ $locale==='en'? $chapter->titleEn:$chapter->titleKm }}</h1>

            @foreach ($paragraphContents as $pContent)
    @php
        // Capture full <span> or <strong> tags, or fallback to the paragraph
        preg_match_all('/(<span.*?>.*?<\/span>)|(<strong.*?>.*?<\/strong>)/s', $pContent, $matches);
        $spans = !empty($matches[0]) ? $matches[0] : [$pContent];
    @endphp

    <div class="mb-4">
        @foreach ($spans as $span)
            @php
                $span = trim($span);

                // If we already wrapped the number previously, skip
                if (strpos($span, 'text-red-500') === false) {
                    // Try to wrap a number that appears at the start of the fragment,
                    // possibly after one or more opening tags (e.g. <span><sup>1...)
                    $spanWithRedNumber = preg_replace_callback(
                        '/^\s*((?:<[^>]+>\s*)*)(\d+)/u',
                        function ($m) {
                            $prefix = $m[1] ?? '';
                            $num = $m[2];
                            return $prefix . '<span class="text-[#000] text-[14px] font-semibold">' . $num . '</span>';
                        },
                        $span,
                        1
                    );

                    // Fallback: if nothing changed (rare), just wrap the first standalone digits found
                    // if ($spanWithRedNumber === null || $spanWithRedNumber === $span) {
                    //     $spanWithRedNumber = preg_replace('/(\d+)/u', '<span class="text-red-500 font-bold">$1</span>', $span, 1);
                    // }
                } else {
                    $spanWithRedNumber = $span;
                }
            @endphp

            <span
                class="cursor-pointer align-baseline prose"
                data-text="{{ e(strip_tags(str_replace('<br>', "\n", $spanWithRedNumber))) }}"
                :class="{
                    'bg-[#fefe01]': highlightColors['{{ $spanIndex }}'] === 'yellow',
                    'bg-[#5dff79]': highlightColors['{{ $spanIndex }}'] === 'green',
                    'bg-[#00d6ff]': highlightColors['{{ $spanIndex }}'] === 'blue',
                    'underline decoration-dotted': selectedSpan === '{{ $spanIndex }}'
                }"
                @click="selectedSpan='{{ $spanIndex }}'; selectedText=$event.currentTarget.dataset.text; showPopup=true;"
            >
                {!! $spanWithRedNumber !!}
            </span>

            @php($spanIndex++)
        @endforeach
    </div>
@endforeach


            {{-- Bottom Popup --}}
            <div
                x-show="showPopup"
                x-cloak
                x-transition:enter="transition transform ease-out duration-300"
                x-transition:enter-start="translate-y-20 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition transform ease-in duration-200"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-20 opacity-0"
                @click.outside="closePopup()"
                class="fixed bottom-4 left-1/2 w-[90%] md:w-[400px] transform -translate-x-1/2 z-50 bg-white border shadow-lg rounded-md p-3 flex gap-2 items-center"
            >
                <div class="w-full max-w-md mx-auto bg-white rounded-xl flex flex-col gap-4 px-2 pt-12 pb-4 relative">
                    <!-- Header: Highlight -->
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2 text text-[14px] md:text-[16px] text-[#000] font-semibold">
                            <svg class="w-4 h-4 md:w-6 md:h-6 text-[#000]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="m3.161 16.367 3-3a2.015 2.015 0 0 1 .525-1.939l6.717-6.717a4.516 4.516 0 0 1 6.386 6.386l-7.07 7.07a1.516 1.516 0 0 1-1.716.302l-1.876 1.876c-.381.381-.898.595-1.437.595H5.703a2.031 2.031 0 0 1-1.436-.595L3.16 19.24a2.031 2.031 0 0 1 0-2.873Zm4.254-1.381-2.817 2.817 1.105 1.106H7.69l1.824-1.824-2.1-2.1Zm4.243 1.37 6.695-6.695a2.484 2.484 0 1 0-3.514-3.514l-6.695 6.695 3.514 3.514Z" fill="currentColor"></path>
                            </svg>
                            <span>{{ __('messages.highlight') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="w-8 h-8 rounded-full bg-[#fefe01] hover:ring-2 hover:ring-yellow-400 transition" @click="toggleHighlight(selectedSpan,'yellow')"></button>
                            <button class="w-8 h-8 rounded-full bg-[#5dff79] hover:ring-2 hover:ring-green-400 transition" @click="toggleHighlight(selectedSpan,'green')"></button>
                            <button class="w-8 h-8 rounded-full bg-[#00d6ff] hover:ring-2 hover:ring-blue-400 transition" @click="toggleHighlight(selectedSpan,'blue')"></button>
                        </div>
                    </div>

                    <!-- Actions: Copy & Share -->
                    <div class="flex flex-col gap-2">
                        <button class="flex items-center gap-2 py-2 text-[14px] md:text-[16px] text-[#000] font-semibold" @click="shareText()">
                            <svg class="w-4 h-4 md:w-6 md:h-6 text-[#000]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 6.414V9h-1c-2.26 0-4.995.786-7.17 2.409-1.233.919-2.28 2.099-2.966 3.558 1.105-1.177 2.21-2.039 3.387-2.65C10.313 11.244 12.481 11 15 11h1v2.585L19.586 10 16 6.414Zm-2-1.81c0-1.114 1.346-1.672 2.134-.884l5.22 5.22a1.5 1.5 0 0 1 0 2.12l-5.22 5.22c-.783.784-2.134.237-2.134-.883v-2.38c-1.914.065-3.424.345-4.826 1.074-1.643.854-3.253 2.384-5.16 5.194-.58.853-2.042.52-2.01-.646.113-3.985 2.064-6.92 4.63-8.834C8.862 8.144 11.569 7.238 14 7.041V4.604Z" fill="currentColor"></path>
                            </svg>
                            <span>{{ __('messages.share') }}</span>
                        </button>
                        <button class="flex items-center gap-2 py-2 text-[14px] md:text-[16px] text-[#000] font-semibold" @click="copyText()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-6 md:h-6 text-[#000]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                <path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" />
                            </svg>
                            <span>{{ __('messages.copy') }} </span> <span x-show="copied" class="text-green-600 text-sm mt-1">{{ __('messages.copy') }}!</span>
                        </button>
                    </div>

                    <!-- Close Button -->
                    <button class="absolute top-0 right-2 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 transition" @click="closePopup()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    @endforeach
@endforeach

</div>

@endsection
