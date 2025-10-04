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
                <select
                    class="w-full rounded-md mt-1 focus:ring-[#000] focus:border-[#000] text-sm text-[#000]"
                    name="catalogueId" id="catalogueId">
                    <option value="">Select One</option>
                    @foreach ($cata as $c)
                        <option value="{{ $c->id }}">{{ $c->name_en }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('catalogueId')" />
            </div>

            <div>
                <h1 class="text-[#000]">Image</h1>
                <label for="dropzone-image" id="drop-area-image"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                    <div id="img-preview"
                        class="flex flex-col items-center justify-center pt-5 pb-6 w-full h-full bg-contain bg-center bg-no-repeat rounded-md text-center">
                        <p class="mb-2 text-[12px] sm:text-[14px] text-[#000]">
                            <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-[#000]">SVG, PNG, JPG or GIF (MAX. 5MB)</p>
                    </div>
                    <input id="dropzone-image" type="file" class="hidden" name="image" accept="image/*"
                        onchange="uploadImage(event)" />
                </label>
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
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
        function uploadImage(event) {
            const file = event.target.files[0];
            if (file) {
                const imgLink = URL.createObjectURL(file);
                const preview = document.getElementById('img-preview');
                preview.style.backgroundImage = `url(${imgLink})`;
                preview.style.backgroundSize = "contain";
                preview.style.backgroundPosition = "center";
                preview.innerHTML = "";
            }
        }

        // Drag and drop for image
        const imageDropArea = document.getElementById('drop-area-image');
        const imageInput = document.getElementById('dropzone-image');
        const imagePreview = document.getElementById('image-preview');

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
                uploadImage({
                    target: {
                        files: [file]
                    }
                });
            }
        });
    </script>
</x-app-layout>
