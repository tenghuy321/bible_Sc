<x-app-layout>
    <div class="max-w-7xl mx-auto shadow-md rounded-lg p-6 my-2">
        <h2 class="text-2xl font-bold text-[#401457]">Edit Book</h2>
        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')
            @component('admin.components.alert')
            @endcomponent


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nameEn" class="block text-sm font-medium text-[#000]">Name (English)</label>
                    <input value="{{ old('nameEn', $book->nameEn) }}" type="text" name="nameEn" id="nameEn"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('nameEn')" />
                </div>

                <div>
                    <label for="nameKm" class="block text-sm font-medium text-[#000]">Name (Khmer)</label>
                    <input value="{{ old('nameEn', $book->nameKm) }}" type="text" name="nameKm" id="nameKm"
                        class="mt-1 block w-full p-2 border rounded-md text-[#000] text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('nameKm')" />
                </div>
            </div>

            {{-- <div>
                <label for="catalogueId" class="block text-sm font-medium text-gray-700">Catalogue</label>
                <select class="w-full rounded-md mt-1 focus:ring-[#000] focus:border-[#000] text-sm text-[#000]"
                    name="catalogueId" id="catalogueId">
                    <option value="">Select One</option>
                    @foreach ($cata as $c)
                        <option value="{{ $c->id }}" {{ $c->id == $catabook->catalogueId ? 'selected' : '' }}>
                            {{ $c->name_en }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('catalogueId')" />
            </div> --}}

            <div>
                <label for="versionId" class="block text-sm font-medium text-gray-700">Version</label>
                <select class="w-full rounded-md mt-1 focus:ring-[#000] focus:border-[#000] text-sm text-[#000]"
                    name="versionId" id="versionId">
                    <option value="">Select One</option>
                    @foreach ($versions as $v)
                        <option value="{{ $v->slug }}"
                            {{ isset($book) && $book->versionId === $v->slug ? 'selected' : '' }}>
                            {{ $v->titleEn }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('versionId')" />
            </div>

            <div class="flex justify-between">
                <a href="{{ route('book.index') }}"
                    class="border border-[#4FC9EE] hover:!bg-[#4FC9EE] hover:!text-[#ffffff] px-4 py-1 md:px-6 rounded-[5px] text-[#4FC9EE]">
                    Back
                </a>

                <button type="submit" class="bg-[#4FC9EE] text-white px-4 py-1 md:px-6 rounded-[5px]">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
