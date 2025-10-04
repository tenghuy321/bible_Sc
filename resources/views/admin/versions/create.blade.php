<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold text-[#401457]">Create Version</h2>
        <form action="{{ route('version-backend.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @component('admin.components.alert')
            @endcomponent

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label for="titleEn" class="block text-sm font-medium text-[#000]">Title (English)</label>
                    <input type="text" name="titleEn" id="titleEn"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('titleEn')" />
                </div>

                <div>
                    <label for="titleKm" class="block text-sm font-medium text-[#000]">Title (Khmer)</label>
                    <input type="text" name="titleKm" id="titleKm"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('titleKm')" />
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('version-backend.index') }}"
                    class="border border-[#4FC9EE] hover:!bg-[#4FC9EE] hover:!text-[#ffffff] px-4 py-1 md:px-6 rounded-[5px] text-[#4FC9EE]">
                    Back
                </a>

                <button type="submit" class="bg-[#4FC9EE] text-white px-4 py-1 md:px-6 rounded-[5px]">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
