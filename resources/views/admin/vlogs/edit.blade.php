{{-- @section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Edit Vlog</h1>

        <form action="{{ route('vlog-backend.update', $vlog->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block">YouTube URL</label>
                <input type="url" name="video_Url" class="border p-2 w-full" value="{{ old('video_Url', $vlog->video_Url) }}" required>
            </div>

            <div>
                <label class="block">Title (English)</label>
                <input type="text" name="title_en" class="border p-2 w-full" value="{{ old('title_en', $vlog->title_en) }}" required>
            </div>

            <div>
                <label class="block">Title (Khmer)</label>
                <input type="text" name="title_km" class="border p-2 w-full" value="{{ old('title_km', $vlog->title_km) }}">
            </div>

            <div>
                <label class="block">Paragraph (English)</label>
                <textarea name="paragraph_en" class="border p-2 w-full">{{ old('paragraph_en', $vlog->paragraph_en) }}</textarea>
            </div>

            <div>
                <label class="block">Paragraph (Khmer)</label>
                <textarea name="paragraph_km" class="border p-2 w-full">{{ old('paragraph_km', $vlog->paragraph_km) }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
        </form>
    </div>
@endsection --}}


<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold text-[#401457]">Edit Vlogs</h2>
        <form action="{{ route('vlog-backend.update', $vlog->id) }}"  method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')
            @component('admin.components.alert')
            @endcomponent


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label for="title_en" class="block text-sm font-medium text-[#000]">Title (English)</label>
                    <input value="{{ old('title_en', $vlog->title_en) }}" type="text" name="title_en" id="title_en"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('title_en')" />
                </div>

                <div>
                    <label for="title_km" class="block text-sm font-medium text-[#000]">Title (Khmer)</label>
                    <input value="{{ old('title_km', $vlog->title_km) }}" type="text" name="title_km" id="title_km"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('title_km')" />
                </div>

                <div>
                    <label for="paragraph_en" class="block text-sm font-medium text-[#000]">Paragraph (English)</label>
                    <textarea name="paragraph_en" id="paragraph_en" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('paragraph_en', $vlog->paragraph_en) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('paragraph_en')" />
                </div>

                <div>
                    <label for="paragraph_km" class="block text-sm font-medium text-[#000]">Paragraph (khmer)</label>
                    <textarea name="paragraph_km" id="paragraph_km" rows="6"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-[12px]">{{ old('paragraph_km', $vlog->paragraph_km) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('paragraph_km')" />
                </div>
            </div>

            <div>
                <div>
                    <label for="video_Url" class="block text-sm font-medium text-[#000]">YouTube URL</label>
                    <input value="{{ old('video_Url', $vlog->video_Url) }}" type="text" name="video_Url" id="video_Url"
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
