<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 my-4">
        <h2 class="text-2xl font-bold mb-4">Add News</h2>

        <form action="{{ route('news_backend.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @component('admin.components.alert') @endcomponent

            {{-- ========== SECTION 1: TITLE + CONTENT ========== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- English --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-[#4FC9EE] uppercase">English</h3>

                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">
                        <x-input-error class="mt-2" :messages="$errors->get('title_en')" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content_en" id="content_en" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">{{ old('content_en') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Middle Content</label>
                        <textarea name="middle_content_en" id="middle_content_en" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">{{ old('middle_content_en') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Content</label>
                        <textarea name="end_content_en" id="end_content_en" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">{{ old('end_content_en') }}</textarea>
                    </div>
                </div>

                {{-- Khmer --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-[#4FC9EE] uppercase">Khmer</h3>

                    <div>
                        <label for="title_kh" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title_kh" id="title_kh" value="{{ old('title_kh') }}"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">
                        <x-input-error class="mt-2" :messages="$errors->get('title_kh')" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content_kh" id="content_kh" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">{{ old('content_kh') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Middle Content</label>
                        <textarea name="middle_content_kh" id="middle_content_kh" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">{{ old('middle_content_kh') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Content</label>
                        <textarea name="end_content_kh" id="end_content_kh" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-sm text-black">{{ old('end_content_kh') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ========== IMAGE SECTIONS ========== --}}
            @foreach (['image' => 'Main', 'middle_image' => 'Middle', 'end_image' => 'End'] as $name => $label)
                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-[#4FC9EE]">{{ $label }} Image</h3>

                    <label for="dropzone-{{ $name }}" id="drop-area-{{ $name }}"
                        class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:border-blue-400">
                        <div class="text-gray-500 text-center">
                            <p>Click or drag & drop images for {{ strtolower($label) }} section</p>
                            <p class="text-xs text-gray-400">Multiple images allowed</p>
                        </div>
                        <input id="dropzone-{{ $name }}" type="file" class="hidden" name="{{ $name }}[]" accept="image/*" multiple />
                    </label>

                    <div id="preview-{{ $name }}"
                        class="flex flex-wrap gap-2 justify-center items-center w-full min-h-[100px] bg-gray-50 rounded-md p-4 overflow-y-auto">
                        <p class="text-gray-400 text-sm">No images selected.</p>
                    </div>
                </div>
            @endforeach

            {{-- ========== BUTTONS ========== --}}
            <div class="flex justify-between w-full mt-6">
                <a href="{{ route('news_backend.index') }}"
                    class="border border-[#4FC9EE] hover:bg-[#4FC9EE] hover:text-white px-6 py-2 rounded text-[#4FC9EE]">
                    Back
                </a>

                <button type="submit"
                    class="bg-[#4FC9EE] text-white px-6 py-2 rounded hover:bg-[#38bdf8]">Submit</button>
            </div>
        </form>
    </div>

    {{-- Include Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <script>
        // ✅ CKEditor initialization
        ['content_en', 'content_kh', 'middle_content_en', 'middle_content_kh', 'end_content_en', 'end_content_kh']
            .forEach(id => {
                ClassicEditor.create(document.querySelector('#' + id), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
                }).catch(error => console.error(error));
            });

        // ✅ Multi Dropzone Image Upload (Generic for all sections)
        ['image', 'middle_image', 'end_image'].forEach(section => {
            const dropArea = document.getElementById(`drop-area-${section}`);
            const input = document.getElementById(`dropzone-${section}`);
            const preview = document.getElementById(`preview-${section}`);
            let files = [];

            const renderPreview = () => {
                preview.innerHTML = '';
                if (files.length === 0) {
                    preview.innerHTML = '<p class="text-gray-400 text-sm">No images selected.</p>';
                    return;
                }

                files.forEach((file, index) => {
                    const imgLink = URL.createObjectURL(file);
                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative w-24 h-24';
                    wrapper.dataset.index = index;

                    const img = document.createElement('img');
                    img.src = imgLink;
                    img.className = 'w-24 h-24 object-contain rounded border p-1';

                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '✕';
                    removeBtn.className =
                        'absolute top-0 right-0 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs';
                    removeBtn.onclick = () => {
                        files.splice(index, 1);
                        syncFiles();
                        renderPreview();
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    preview.appendChild(wrapper);
                });
            };

            const syncFiles = () => {
                const dt = new DataTransfer();
                files.forEach(f => dt.items.add(f));
                input.files = dt.files;
            };

            input.addEventListener('change', e => {
                files.push(...Array.from(e.target.files));
                syncFiles();
                renderPreview();
            });

            dropArea.addEventListener('dragover', e => {
                e.preventDefault();
                dropArea.classList.add('border-blue-500');
            });
            dropArea.addEventListener('dragleave', () => dropArea.classList.remove('border-blue-500'));
            dropArea.addEventListener('drop', e => {
                e.preventDefault();
                dropArea.classList.remove('border-blue-500');
                files.push(...Array.from(e.dataTransfer.files));
                syncFiles();
                renderPreview();
            });

            Sortable.create(preview, {
                animation: 150,
                onEnd: e => {
                    const newOrder = Array.from(preview.children).map(c => parseInt(c.dataset.index));
                    files = newOrder.map(i => files[i]);
                    syncFiles();
                    renderPreview();
                }
            });
        });
    </script>
</x-app-layout>
