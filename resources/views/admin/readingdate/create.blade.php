<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold text-[#401457]">Edit Vlogs</h2>
        <form action="{{ route('readingdate.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
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
            </div>

            <div class="flex justify-between">
                <a href="{{ route('readingdate.index') }}"
                    class="border border-[#4FC9EE] hover:!bg-[#4FC9EE] hover:!text-[#ffffff] px-4 py-1 md:px-6 rounded-[5px] text-[#4FC9EE]">
                    Back
                </a>

                <button type="submit" class="bg-[#4FC9EE] text-white px-4 py-1 md:px-6 rounded-[5px]">Submit</button>
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
