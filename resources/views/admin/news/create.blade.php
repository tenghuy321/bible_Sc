<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold">Add News</h2>
        <form action="{{ route('news_backend.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @component('admin.components.alert')
            @endcomponent

            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-0 space-y-4">
                    <h1 class="text-[20px] font-[600] text-[#4FC9EE] uppercase">English</h1>
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title</label>
                        <input value="{{ old('title_en') }}" type="text" name="title_en" id="title_en"
                            class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                        <x-input-error class="mt-2" :messages="$errors->get('title_en')" />
                    </div>
                    <div>
                        <label for="content_en" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content_en" id="content_en" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">{{ old('content_en') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('content_en')" />
                    </div>

                </div>

                <div class="p-0 space-y-4">
                    <h1 class="text-[20px] font-[600] text-[#4FC9EE] uppercase">Khmer</h1>
                    <div>
                        <label for="title_kh" class="block text-sm font-medium text-gray-700">Title</label>
                        <input value="{{ old('title_kh') }}" type="text" name="title_kh" id="title_kh"
                            class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                        <x-input-error class="mt-2" :messages="$errors->get('title_kh')" />
                    </div>
                    <div>
                        <label for="content_kh" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content_kh" id="content_kh" rows="4"
                            class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">{{ old('content_kh') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('content_kh')" />
                    </div>
                </div>
            </div>

            <!-- Dropzone for Image -->
            <div>
                <label for="dropzone-file" id="drop-area"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">

                    <input id="dropzone-file" type="file" class="hidden" name="images[]" accept="image/*" multiple
                        onchange="uploadImages(event)" />
                </label>
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div id="img-preview"
                class="flex flex-wrap gap-2 justify-center items-center w-full h-full bg-gray-50 rounded-md overflow-y-auto p-4">
                <p class="text-gray-400 text-sm">No images selected.</p>
            </div>


            <div class="flex justify-between w-full">
                <a href="{{ route('news_backend.index') }}"
                    class="border border-[#4FC9EE] hover:!bg-[#4FC9EE] hover:!text-[#ffffff] px-4 py-1 md:px-6 rounded-[5px] text-[#4FC9EE]">
                    Back
                </a>

                <button type="submit"
                    class="bg-[#4FC9EE] text-white px-4 py-1 md:px-6 rounded-[5px] hover:!text-[#415464]">Submit</button>
            </div>
        </form>
    </div>


    <script>

        ClassicEditor
            .create(document.querySelector('#content_en'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                    'undo', 'redo', 'code', 'codeBlock'
                ]
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#content_kh'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                    'undo', 'redo', 'code', 'codeBlock'
                ]
            })
            .catch(error => {
                console.error(error);
            });

        const dropArea = document.getElementById('drop-area');
        const imageFileInput = document.getElementById('dropzone-file');
        const imagePreview = document.getElementById('img-preview');
        let selectedFiles = [];

        function uploadImages(event) {
            const files = Array.from(event.target.files);
            selectedFiles.push(...files);
            renderImagePreviews();
            syncInputFiles();
        }

        function renderImagePreviews() {
            imagePreview.innerHTML = '';

            if (selectedFiles.length === 0) {
                imagePreview.innerHTML = '<p class="text-gray-400 text-sm">No images selected.</p>';
                return;
            }

            selectedFiles.forEach((file, index) => {
                const imgLink = URL.createObjectURL(file);
                const wrapper = document.createElement('div');
                wrapper.className = 'relative draggable';
                wrapper.dataset.index = index;

                const img = document.createElement('img');
                img.src = imgLink;
                img.className = 'w-24 h-24 object-contain rounded border p-1';

                const removeBtn = document.createElement('button');
                removeBtn.textContent = '✕';
                removeBtn.className =
                    'absolute top-0 right-0 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs';
                removeBtn.type = 'button';
                removeBtn.onclick = () => {
                    selectedFiles.splice(index, 1);
                    renderImagePreviews();
                    syncInputFiles();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                imagePreview.appendChild(wrapper);
            });

            initSortable(); // Reinitialize Sortable after DOM update
        }

        function syncInputFiles() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            imageFileInput.files = dataTransfer.files;
        }

        // Drag-and-drop input
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('border-blue-500');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-blue-500');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('border-blue-500');

            const files = Array.from(event.dataTransfer.files);
            selectedFiles.push(...files);
            renderImagePreviews();
            syncInputFiles();
        });

        imageFileInput.addEventListener('click', () => {
            imageFileInput.value = null;
        });

        // Initialize SortableJS
        function initSortable() {
            Sortable.create(imagePreview, {
                animation: 150,
                onEnd: function(evt) {
                    const newFiles = [];
                    const order = Array.from(imagePreview.children).map(child => parseInt(child.dataset.index));
                    order.forEach(i => {
                        newFiles.push(selectedFiles[i]);
                    });
                    selectedFiles = newFiles;
                    syncInputFiles();
                    renderImagePreviews(); // Re-render to update remove buttons correctly
                }
            });
        }
    </script>

</x-app-layout>
