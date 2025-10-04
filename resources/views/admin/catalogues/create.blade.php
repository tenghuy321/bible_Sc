<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold text-[#401457]">Create Catalogue</h2>
        <form action="{{ route('catalogues-backend.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
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
                <a href="{{ route('catalogues-backend.index') }}"
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
