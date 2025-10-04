<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2" x-data="chapterForm()" x-init="init()">
        <h1 class="text-2xl font-bold mb-6">Create Chapter</h1>

        <form id="chapterForm" action="{{ route('chapter.store') }}" method="POST" class="space-y-4">
            @csrf
            @component('admin.components.alert')
            @endcomponent

            <!-- Hidden filters -->
            <input type="hidden" name="versionId" value="{{ request('versionId') }}">
            <input type="hidden" name="bookId" value="{{ request('bookId') }}">
            <input type="hidden" name="page" value="{{ request('page', 1) }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Book Dropdown -->
                <div class="mb-4 col-span-1 md:col-span-2">
                    <label class="block mb-1 font-semibold">Book</label>
                    <select name="bookId" class="border p-2 w-full">
                        <template x-for="book in filteredBooks" :key="book.id">
                            <option :value="book.id"
                                :selected="book.id == '{{ request('bookId') ?? old('bookId') }}'" x-text="book.nameEn">
                            </option>
                        </template>
                    </select>
                </div>

                <!-- Number & Title Fields -->
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Number (English)</label>
                    <input type="text" name="nameEn" value="{{ old('nameEn') }}" class="border p-2 w-full">
                    <x-input-error class="mt-2" :messages="$errors->get('nameEn')" />
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Number (Khmer)</label>
                    <input type="text" name="nameKm" value="{{ old('nameKm') }}" class="border p-2 w-full">
                    <x-input-error class="mt-2" :messages="$errors->get('nameKm')" />
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Title (English)</label>
                    <input type="text" name="titleEn" value="{{ old('titleEn') }}" class="border p-2 w-full">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Title (Khmer)</label>
                    <input type="text" name="titleKm" value="{{ old('titleKm') }}" class="border p-2 w-full">
                </div>

                <!-- Content -->
                <div>
                    <label for="contentEn" class="block text-sm font-medium text-[#000]">Content (English for ពាក្យលំនាំ)</label>
                    <textarea name="contentEn" id="contentEn" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('contentEn') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('contentEn')" />
                </div>

                <div>
                    <label for="contentKm" class="block text-sm font-medium text-[#000]">Content (Khmer for ពាក្យលំនាំ)</label>
                    <textarea name="contentKm" id="contentKm" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('contentKm') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('contentKm')" />
                </div>

                <!-- Paragraphs -->
                <div>
                    <label for="paragraphEn" class="block text-sm font-medium text-[#000]">Paragraph (English)</label>
                    <textarea name="paragraphEn" id="paragraphEn" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('paragraphEn') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('paragraphEn')" />
                </div>

                <div>
                    <label for="paragraphKm" class="block text-sm font-medium text-[#000]">Paragraph (Khmer)</label>
                    <textarea name="paragraphKm" id="paragraphKm" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('paragraphKm') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('paragraphKm')" />
                </div>
            </div>

            <!-- Form buttons -->
            <div class="flex justify-between">
                <a href="{{ route('chapter.index', ['versionId' => request('versionId'), 'bookId' => request('bookId')]) }}"
                    class="border border-[#4FC9EE] hover:!bg-[#4FC9EE] hover:!text-white px-4 py-1 md:px-6 rounded-[5px] text-[#4FC9EE]">
                    Back
                </a>

                <button type="submit" class="bg-[#4FC9EE] text-white px-4 py-1 md:px-6 rounded-[5px]">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        let contentEnEditor, contentKmEditor, paragraphEnEditor, paragraphKmEditor;

        // Initialize CKEditors
        ClassicEditor.create(document.querySelector('#contentEn')).then(editor => contentEnEditor = editor).catch(console
            .error);
        ClassicEditor.create(document.querySelector('#contentKm')).then(editor => contentKmEditor = editor).catch(console
            .error);
        ClassicEditor.create(document.querySelector('#paragraphEn')).then(editor => paragraphEnEditor = editor).catch(
            console.error);
        ClassicEditor.create(document.querySelector('#paragraphKm')).then(editor => paragraphKmEditor = editor).catch(
            console.error);

        // Format paragraphs with verses
        function formatParagraphs(content) {
            const temp = document.createElement('div');
            temp.innerHTML = content;

            let result = '',
                currentVerse = '',
                currentLines = [],
                paragraph = [];

            function flushVerse() {
                if (currentVerse) {
                    paragraph.push(`<span>${currentVerse} ${currentLines.join('<br>')}</span>`);
                    currentVerse = '';
                    currentLines = [];
                }
            }

            function flushParagraph() {
                if (paragraph.length) {
                    result += `<p>${paragraph.join(' ')}</p>\n`;
                    paragraph = [];
                }
            }

            temp.childNodes.forEach(node => {
                if (node.nodeName === 'P' || node.nodeName === 'DIV') {
                    node.childNodes.forEach(child => {
                        if (child.nodeName === 'BR') currentLines.push('<br>');
                        else if (child.nodeName === 'STRONG') {
                            flushVerse();
                            flushParagraph();
                            result += `<p>${child.outerHTML}</p>\n`;
                        } else {
                            const textParts = child.textContent.split(/(?=\b\d+\b)/);
                            textParts.forEach(part => {
                                const match = part.match(/^(\d+)\s*(.*)/);
                                if (match) {
                                    flushVerse();
                                    currentVerse = match[1];
                                    if (match[2]) currentLines.push(match[2]);
                                } else if (part.trim()) currentLines.push(part.trim());
                            });
                        }
                    });
                    flushVerse();
                    flushParagraph();
                } else if (node.nodeName === 'STRONG') {
                    flushVerse();
                    flushParagraph();
                    result += `<p>${node.outerHTML}</p>\n`;
                } else {
                    const lines = node.textContent.split(/\r?\n/).map(l => l.trim()).filter(l => l);
                    lines.forEach(line => {
                        const match = line.match(/^(\d+)\s*(.*)/);
                        if (match) {
                            flushVerse();
                            currentVerse = match[1];
                            if (match[2]) currentLines.push(match[2]);
                        } else currentLines.push(line);
                    });
                    flushVerse();
                    flushParagraph();
                }
            });

            return result;
        }

        // Form submit
        document.getElementById('chapterForm').addEventListener('submit', function() {
            if (paragraphEnEditor) document.querySelector('textarea[name="paragraphEn"]').value = formatParagraphs(
                paragraphEnEditor.getData());
            if (paragraphKmEditor) document.querySelector('textarea[name="paragraphKm"]').value = formatParagraphs(
                paragraphKmEditor.getData());
            if (contentEnEditor) document.querySelector('textarea[name="contentEn"]').value = contentEnEditor
                .getData();
            if (contentKmEditor) document.querySelector('textarea[name="contentKm"]').value = contentKmEditor
                .getData();
        });

        // Alpine.js
        function chapterForm() {
            return {
                selectedVersion: '{{ request('versionId') }}',
                books: @json($books),
                filteredBooks: [],
                init() {
                    this.filterBooks();
                },
                filterBooks() {
                    this.filteredBooks = this.books.filter(book => !this.selectedVersion || book.versionId == this
                        .selectedVersion);
                }
            }
        }
    </script>


</x-app-layout>
