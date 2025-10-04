<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2" x-data="chapterForm()" x-init="init()">
        <h1 class="text-2xl font-bold mb-6">Edit Chapter</h1>

        <form id="chapterForm" action="{{ route('chapter.update', $chapter->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            @component('admin.components.alert')
            @endcomponent

            <input type="hidden" name="versionId" value="{{ $chapter->book->versionId }}">
            <input type="hidden" name="bookId" value="{{ $chapter->bookId }}">
            <input type="hidden" name="page" value="{{ request('page', 1) }}">


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Book Dropdown -->
                <div class="mb-4 col-span-1 md:col-span-2">
                    <label class="block mb-1 font-semibold">Book</label>
                    <select name="bookId" class="border p-2 w-full">
                        <template x-for="book in filteredBooks" :key="book.id">
                            <option :value="book.id"
                                :selected="book.id == '{{ old('bookId', $chapter->bookId) }}'" x-text="book.nameEn">
                            </option>
                        </template>
                    </select>
                </div>

                <!-- Number & Title Fields -->
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Number (English)</label>
                    <input type="text" name="nameEn" value="{{ old('nameEn', $chapter->nameEn) }}"
                        class="border p-2 w-full">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Number (Khmer)</label>
                    <input type="text" name="nameKm" value="{{ old('nameKm', $chapter->nameKm) }}"
                        class="border p-2 w-full">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Title (English)</label>
                    <input type="text" name="titleEn" value="{{ old('titleEn', $chapter->titleEn) }}"
                        class="border p-2 w-full">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Title (Khmer)</label>
                    <input type="text" name="titleKm" value="{{ old('titleKm', $chapter->titleKm) }}"
                        class="border p-2 w-full">
                </div>

                <!-- Content -->
                <div>
                    <label for="contentEn" class="block text-sm font-medium text-[#000]">Content (English for ពាក្យលំនាំ)</label>
                    <textarea name="contentEn" id="contentEn" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('contentEn', $chapter->contentEn) }}</textarea>
                </div>

                <div>
                    <label for="contentKm" class="block text-sm font-medium text-[#000]">Content (Khmer for ពាក្យលំនាំ)</label>
                    <textarea name="contentKm" id="contentKm" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('contentKm', $chapter->contentKm) }}</textarea>
                </div>

                <!-- Paragraphs -->
                <div>
                    <label for="paragraphEn" class="block text-sm font-medium text-[#000]">Paragraph (English)</label>
                    <textarea name="paragraphEn" id="paragraphEn" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('paragraphEn', $chapter->paragraphEn) }}</textarea>
                </div>

                <div>
                    <label for="paragraphKm" class="block text-sm font-medium text-[#000]">Paragraph (Khmer)</label>
                    <textarea name="paragraphKm" id="paragraphKm" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('paragraphKm', $chapter->paragraphKm) }}</textarea>
                </div>
            </div>

            <!-- Form buttons -->
            <div class="flex justify-between">
                <a href="{{ route('chapter.index', [
                    'versionId' => $chapter->book->versionId,
                    'bookId' => $chapter->bookId,
                    'page' => request('page', 1), // keep current page
                ]) }}"
                    class="border border-[#4FC9EE] hover:!bg-[#4FC9EE] hover:!text-white px-4 py-1 md:px-6 rounded-[5px] text-[#4FC9EE]">
                    Back
                </a>


                <button type="submit" class="bg-[#4FC9EE] text-white px-4 py-1 md:px-6 rounded-[5px]">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        let contentEnEditor, contentKmEditor, paragraphEnEditor, paragraphKmEditor;

        // Content editors (no formatting applied)
        ClassicEditor.create(document.querySelector('#contentEn'))
            .then(editor => contentEnEditor = editor)
            .catch(console.error);

        ClassicEditor.create(document.querySelector('#contentKm'))
            .then(editor => contentKmEditor = editor)
            .catch(console.error);

        // Paragraph editors (will be formatted before submit)
        ClassicEditor.create(document.querySelector('#paragraphEn'))
            .then(editor => paragraphEnEditor = editor)
            .catch(console.error);

        ClassicEditor.create(document.querySelector('#paragraphKm'))
            .then(editor => paragraphKmEditor = editor)
            .catch(console.error);

        /**
         * Format text into HTML with verses:
         * - Each verse in <span>
         * - Lines inside verse joined with <br>
         * - New <p> if a verse starts on a new line
         * - Verse number inline with first line
         */
        function formatParagraphs(content) {
            const temp = document.createElement('div');
            temp.innerHTML = content;

            let result = '';
            let paragraph = [];
            let currentVerse = '';
            let currentLines = [];

            function flushVerse() {
                if (currentVerse) {
                    const spanHTML = `<span>${currentVerse} ${currentLines.join('<br>')}</span>`;
                    paragraph.push(spanHTML);
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
                if (node.nodeName === 'P') {
                    node.childNodes.forEach(child => {
                        if (child.nodeName === 'BR') {
                            currentLines.push('<br>');
                        } else if (child.nodeName === 'STRONG') {
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
                                    if (match[2]) currentLines.push(match[2].trim());
                                } else {
                                    currentLines.push(part.trim());
                                }
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
                        } else {
                            currentLines.push(line);
                        }
                    });
                    flushVerse();
                    flushParagraph();
                }
            });

            return result;
        }

        // Handle submit
        document.getElementById('chapterForm').addEventListener('submit', function() {
            // Paragraphs → format
            if (paragraphEnEditor) {
                document.querySelector('textarea[name="paragraphEn"]').value =
                    formatParagraphs(paragraphEnEditor.getData());
            }
            if (paragraphKmEditor) {
                document.querySelector('textarea[name="paragraphKm"]').value =
                    formatParagraphs(paragraphKmEditor.getData());
            }

            // Content → save as-is
            if (contentEnEditor) {
                document.querySelector('textarea[name="contentEn"]').value = contentEnEditor.getData();
            }
            if (contentKmEditor) {
                document.querySelector('textarea[name="contentKm"]').value = contentKmEditor.getData();
            }
        });



        // Alpine.js book filtering
        function chapterForm() {
            return {
                selectedVersion: '{{ $chapter->book->versionId }}',
                books: @json($books),
                filteredBooks: [],
                init() {
                    this.filterBooks();
                },
                filterBooks() {
                    this.filteredBooks = this.books.filter(book =>
                        this.selectedVersion === '' || book.versionId == this.selectedVersion
                    );
                }
            }
        }
    </script>

</x-app-layout>
