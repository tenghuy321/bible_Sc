@extends('admin.layouts.app')
@section('header')
    Cata Book
@endsection
@section('content')
    <div class="">
        <div class="my-3 md:my-4 text-end">
            <a href="{{ route('catabook-backend.create') }}" class="hover:!bg-[#4FC9EE] hover:!text-[#ffffff] text-[#4FC9EE] px-4 py-2 my-3 rounded-[5px] border-2 border-[#4FC9EE] text-[12px] sm:text-[14px]">
                <span class="">Add new</span>
            </a>
        </div>

        @component('admin.components.alert')
        @endcomponent

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-[#4FC9EE] border border-[#4FC9EE] text-white">
                    <tr>
                        {{-- <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">#</th> --}}
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Image</th>
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Name</th>
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Code</th>
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Type</th>
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Size</th>
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Isbn</th>
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Catalogue</th>
                        <th class="text-left py-3 px-4 text-[12px] border-r border-[#fff]">Action</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">
                    @foreach ($cata_books as $index => $cata_book)
                        <tr class="border border-[#4FC9EE]">
                            {{-- <td class="text-left py-3 px-4 text-[10px] md:text-[12px] border-r border-[#4FC9EE]">{{ $cata_book->auto_number }}</td> --}}
                            <td class="text-left py-3 px-4 text-[10px] md:text-[12px] border-r border-[#4FC9EE]">
                                <img src="{{ asset($cata_book->image) }}" alt="" class="w-12 h-10">
                            </td>
                            <td class="text-left py-3 px-4 text-[10px] md:text-[12px] max-w-[100px] truncate border-r border-[#4FC9EE]">{{ $cata_book->name_en }}</td>
                            <td class="text-left py-3 px-4 text-[10px] md:text-[12px] max-w-[100px] truncate border-r border-[#4FC9EE]">{{ $cata_book->type_en }}</td>
                            <td class="text-left py-3 px-4 text-[10px] md:text-[12px] max-w-[100px] truncate border-r border-[#4FC9EE]">{{ $cata_book->size_en }}</td>
                            <td class="text-left py-3 px-4 text-[10px] md:text-[12px] max-w-[100px] truncate border-r border-[#4FC9EE]">{{ $cata_book->code }}</td>
                            <td class="text-left py-3 px-4 text-[10px] md:text-[12px] max-w-[100px] truncate border-r border-[#4FC9EE]">{{ $cata_book->isbn }}</td>
                            <td class="text-left py-3 px-4 text-[10px] md:text-[12px] max-w-[100px] truncate border-r border-[#4FC9EE]">{{ $cata_book->cname }}</td>
                            <td class="text-left py-3 px-4">
                             <div class="flex">
                                <a href="{{ route('catabook-backend.delete', $cata_book->id) }}" title="Delete"
                                    onclick="event.preventDefault(); deleteRecord('{{ route('catabook-backend.delete', $cata_book->id) }}')">
                                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M4 7l16 0"></path> <path d="M10 11l0 6"></path> <path d="M14 11l0 6"></path> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>
                                </a>
                                <a href="{{ route('catabook-backend.edit', $cata_book->id) }}" title="Edit">
                                    <svg class="w-6 h-6 text-green-500 hover:text-green-700 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path> <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path> <path d="M16 5l3 3"></path> </svg>
                                </a>
                             </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr class="border-2 border-b-[#4FC9EE] my-3">
        <div class="pt-2 pb-4">
            {{ $cata_books->links() }}
        </div>

    </div>
@endsection

