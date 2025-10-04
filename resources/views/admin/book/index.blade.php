@extends('admin.layouts.app')

@section('header')
    <h1>Book</h1>
@endsection

@section('content')
    <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between px-2 md:px-4">
        <a href="{{ route('book.create') }}"
            class="hover:!bg-[#4FC9EE] hover:!text-[#ffffff] text-[#4FC9EE] px-4 py-2 my-3 rounded-[5px] border-2 border-[#4FC9EE] text-[12px] sm:text-[14px]">
            <span class="">Add new</span>
        </a>

        <form method="GET" action="{{ route('book.index') }}" class="flex items-center gap-2">
            <select name="versionId" class="rounded-md text-sm border-gray-300 px-4 py-2 focus:ring-[#4FC9EE] focus:border-[#4FC9EE]"
                onchange="this.form.submit()">
                <option value="">All Versions</option>
                @foreach ($versions as $v)
                    <option value="{{ $v->slug }}" {{ request('versionId') == $v->slug ? 'selected' : '' }}>
                        {{ $v->titleEn }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>


    @component('admin.components.alert')
    @endcomponent

    <div class="overflow-x-auto px-0 sm:px-2 md:px-4">
        <div class="border border-[#fff]">
            <table class="min-w-full table-fixed">
                <thead class="text-[#fff] sticky top-0 z-10 bg-[#4FC9EE] border border-[#4FC9EE]">
                    <tr>
                        <th class="text-left py-3 px-4 text-xs w-[200px] border-r border-[#fff]">Title</th>
                        <th class="text-left py-3 px-4 text-xs w-[200px] border-r border-[#fff]">Version</th>
                        <th class="text-left py-3 px-4 text-xs w-[50px]">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($books as $book)
                        <tr class="border border-[#4FC9EE]">

                            <td class="py-4 px-4 text-xs max-w-[200px] border-r border-[#4FC9EE]">
                                <div class="flex flex-col truncate">
                                    <p>{{ $book->nameEn }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-xs max-w-[200px] border-r border-[#4FC9EE]">
                                <div class="flex flex-col truncate">
                                    <p>{{ $book->versionId }}</p>
                                </div>
                            </td>

                            <td class="py-4 px-4 text-xs max-w-[200px] border-r border-[#4FC9EE]">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('book.edit', $book->id) }}" title="Edit">
                                        <svg class="w-6 h-6 text-green-500 hover:text-green-700 transition"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </a>

                                    <a href="#" title="Delete"
                                        onclick="event.preventDefault(); deleteRecord('{{ route('book.delete', $book->id) }}')">
                                        <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <hr class="border-2 border-b-[#4FC9EE] my-3">
    <div class="pt-2 pb-4">
        {{ $books->links() }}
    </div>
@endsection
