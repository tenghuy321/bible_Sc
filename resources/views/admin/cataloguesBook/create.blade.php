<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold text-[#401457]">Create Catalogue Book</h2>
        <form action="{{ route('catabook-backend.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @component('admin.components.alert')
            @endcomponent

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label for="name_en" class="block text-sm font-medium text-[#000]">Name (English)</label>
                    <input type="text" name="name_en" id="name_en"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('name_en')" />
                </div>

                <div>
                    <label for="name_km" class="block text-sm font-medium text-[#000]">Name (Khmer)</label>
                    <input type="text" name="name_km" id="name_km"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('name_km')" />
                </div>
                <div>
                    <label for="type_en" class="block text-sm font-medium text-[#000]">Type (English)</label>
                    <input type="text" name="type_en" id="type_en"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('type_en')" />
                </div>

                <div>
                    <label for="type_km" class="block text-sm font-medium text-[#000]">Type (Khmer)</label>
                    <input type="text" name="type_km" id="type_km"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('type_km')" />
                </div>
                <div>
                    <label for="size_en" class="block text-sm font-medium text-[#000]">Size (English)</label>
                    <input type="text" name="size_en" id="size_en"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('size_en')" />
                </div>

                <div>
                    <label for="size_km" class="block text-sm font-medium text-[#000]">Size (Khmer)</label>
                    <input type="text" name="size_km" id="size_km"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('size_km')" />
                </div>
                <div>
                    <label for="code" class="block text-sm font-medium text-[#000]">Code</label>
                    <input type="text" name="code" id="code"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('code')" />
                </div>

                <div>
                    <label for="isbn" class="block text-sm font-medium text-[#000]">Isbn</label>
                    <input type="text" name="isbn" id="isbn"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                </div>
                <div>
                    <label for="version" class="block text-sm font-medium text-[#000]">Version</label>
                    <input type="text" name="version" id="version"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('version')" />
                </div>
            </div>

            <div>
                <label for="catalogueId" class="block text-sm font-medium text-gray-700">Catalogue</label>
                <select class="w-full rounded-md mt-1 focus:ring-[#000] focus:border-[#000] text-sm text-[#000]"
                    name="catalogueId" id="catalogueId">
                    <option value="">Select One</option>
                    @foreach ($cata as $c)
                        <option value="{{ $c->id }}">{{ $c->name_en }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('catalogueId')" />
            </div>

            <div>
                <h1 class="text-[#000]">Default Image</h1>
                <label for="dropzone-default_image" id="drop-area-default_image"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                    <div id="default_image-preview"
                        class="flex flex-col items-center justify-center pt-5 pb-6 w-full h-full bg-contain bg-center bg-no-repeat rounded-md text-center">
                        <p class="mb-2 text-[12px] sm:text-[14px] text-[#000]">
                            <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-[#000]">SVG, PNG, JPG or GIF (MAX. 5MB)</p>
                    </div>
                    <input id="dropzone-default_image" type="file" class="hidden" name="default_image"
                        accept="image/*" onchange="uploadDefaultImage(event)" />
                </label>
                <x-input-error class="mt-2" :messages="$errors->get('default_image')" />
            </div>

            <div class="mt-6">
                <label for="dropzone-file" id="drop-area"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                    <p class="mb-2 text-[12px] sm:text-[14px] text-[#000]">
                        <span class="font-semibold">Click to upload</span> or drag and drop multiple images
                    </p>
                    <p class="text-xs text-[#000]">SVG, PNG, JPG or GIF (MAX. 10MB each)</p>
                    <input id="dropzone-file" type="file" class="hidden" name="images[]" accept="image/*"
                        multiple onchange="uploadImages(event)" />
                </label>
                <x-input-error class="mt-2" :messages="$errors->get('images')" />
            </div>

            <div id="img-preview"
                class="flex flex-wrap gap-2 justify-center items-center w-full h-full bg-gray-50 rounded-md overflow-y-auto p-4 mt-4 min-h-[100px]">
                <p class="text-gray-400 text-sm">No images selected.</p>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('catabook-backend.index') }}"
                    class="border border-[#4FC9EE] hover:!bg-[#4FC9EE] hover:!text-[#ffffff] px-4 py-1 md:px-6 rounded-[5px] text-[#4FC9EE]">
                    Back
                </a>

                <button type="submit" class="bg-[#4FC9EE] text-white px-4 py-1 md:px-6 rounded-[5px]">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function uploadDefaultImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('default_image-preview');
            if (file) {
                const imgLink = URL.createObjectURL(file);
                preview.style.backgroundImage = `url(${imgLink})`;
                preview.style.backgroundSize = "contain";
                preview.style.backgroundPosition = "center";
                preview.innerHTML = ""; // remove default text
            }
        }

        const imageDropArea = document.getElementById('drop-area-default_image');
        const imageInput = document.getElementById('dropzone-default_image');

        imageDropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageDropArea.classList.add('border-blue-500');
        });
        imageDropArea.addEventListener('dragleave', () => {
            imageDropArea.classList.remove('border-blue-500');
        });
        imageDropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageDropArea.classList.remove('border-blue-500');
            const file = e.dataTransfer.files[0];
            if (file) {
                imageInput.files = e.dataTransfer.files;
                uploadDefaultImage({
                    target: {
                        files: [file]
                    }
                });
            }
        });
    </script>

    <script>
        const dropArea = document.getElementById('drop-area');
        const imageFileInput = document.getElementById('dropzone-file');
        const multiImagePreview = document.getElementById('img-preview');
        let selectedFiles = [];

        function uploadImages(event) {
            const files = Array.from(event.target.files);
            selectedFiles.push(...files);
            renderImagePreviews();
            syncInputFiles();
        }

        function renderImagePreviews() {
            multiImagePreview.innerHTML = '';

            if (selectedFiles.length === 0) {
                multiImagePreview.innerHTML = '<p class="text-gray-400 text-sm">No images selected.</p>';
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
                    'absolute top-0 right-0 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-700 transition';
                removeBtn.type = 'button';
                removeBtn.onclick = () => {
                    selectedFiles.splice(index, 1);
                    renderImagePreviews();
                    syncInputFiles();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                multiImagePreview.appendChild(wrapper);
            });

            initSortable();
        }

        function syncInputFiles() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            imageFileInput.files = dataTransfer.files;
        }

        // Drag & Drop
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
            imageFileInput.value = null; // reset selection
        });

        // Initialize SortableJS (ensure Sortable.js is loaded)
        function initSortable() {
            if (typeof Sortable === 'undefined') return;
            if (multiImagePreview.sortableInstance) {
                multiImagePreview.sortableInstance.destroy();
            }
            multiImagePreview.sortableInstance = Sortable.create(multiImagePreview, {
                animation: 150,
                onEnd: function(evt) {
                    const reordered = [];
                    Array.from(multiImagePreview.children).forEach(child => {
                        const idx = parseInt(child.dataset.index);
                        if (!isNaN(idx)) reordered.push(selectedFiles[idx]);
                    });
                    selectedFiles = reordered;
                    syncInputFiles();
                    renderImagePreviews();
                }
            });
        }
    </script>
</x-app-layout>
