<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold text-[#401457]">Edit Vlogs</h2>
        <form action="{{ route('vlog-backend.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @component('admin.components.alert')
            @endcomponent


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label for="title_en" class="block text-sm font-medium text-[#000]">Title (English)</label>
                    <input type="text" name="title_en" id="title_en"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('title_en')" />
                </div>

                <div>
                    <label for="title_km" class="block text-sm font-medium text-[#000]">Title (Khmer)</label>
                    <input type="text" name="title_km" id="title_km"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('title_km')" />
                </div>

                <div>
                    <label for="paragraph_en" class="block text-sm font-medium text-[#000]">Paragraph (English)</label>
                    <textarea name="paragraph_en" id="paragraph_en" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]"></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('paragraph_en')" />
                </div>

                <div>
                    <label for="paragraph_km" class="block text-sm font-medium text-[#000]">Paragraph (khmer)</label>
                    <textarea name="paragraph_km" id="paragraph_km" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]"></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('paragraph_km')" />
                </div>
            </div>

            <div>
                <div>
                    <label for="video_Url" class="block text-sm font-medium text-[#000]">YouTube URL</label>
                    <input type="text" name="video_Url" id="video_Url"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('video_Url')" />
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('vlog-backend.index') }}"
                    class="border border-[#401457] hover:!bg-[#401457] hover:!text-[#ffffff] px-4 py-1 md:px-6 rounded-[5px] text-[#401457]">
                    Back
                </a>

                <button type="submit" class="bg-[#401457] text-white px-4 py-1 md:px-6 rounded-[5px]">Submit</button>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#paragraph_en')).catch(console.error);
        ClassicEditor
            .create(document.querySelector('#paragraph_km')).catch(console.error);
    </script>
</x-app-layout>
