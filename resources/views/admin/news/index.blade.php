@extends('admin.layouts.app')
@section('header')
    News
@endsection
@section('content')
    <div class="">
        <div class="my-4 px-2 md:px-4 text-end">
            <a href="{{ route('news_backend.create') }}"
                class="hover:!bg-[#4FC9EE] hover:!text-[#ffffff] text-[#4FC9EE] px-4 py-2 my-3 rounded-[5px] border-2 border-[#4FC9EE] text-[12px] sm:text-[14px]">
                <span class="">Add new</span>
            </a>
        </div>

        @component('admin.components.alert')
        @endcomponent

        <div class="overflow-x-auto px-0 sm:px-2 md:px-4">
            <div class="border border-[#4FC9EE] max-h-[70vh] overflow-y-auto">
                <table class="min-w-full table-fixed">
                    <thead class="text-black sticky top-0 z-10">
                        <tr>
                            <th class="text-left py-3 px-4 text-xs border-r border-[#4FC9EE] w-[200px]">Image</th>
                            <th class="text-left py-3 px-4 text-xs border-r border-[#4FC9EE] w-[200px]">Title</th>
                            <th class="text-left py-3 px-4 text-xs border-r border-[#4FC9EE] w-[200px]">Content</th>
                            <th class="text-left py-3 px-4 text-xs border-r border-[#4FC9EE] w-[200px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($news as $index => $new)
                            <tr class="border-t border-[#4FC9EE]">
                                <td class="text-left py-3 px-4 text-[10px] md:text-[12px] border-r border-[#4FC9EE]">
                                    <div class="flex items-center h-full w-full">
                                        @php
                                            $images = json_decode($new->image, true); // decode to array
                                        @endphp
                                        @if (!empty($images) && isset($images[0]))
                                            <img src="{{ asset($images[0]) }}" alt=""
                                                class="w-20 h-12 object-contain object-center">
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-xs max-w-[200px] border-r border-[#4FC9EE]">
                                    <div class="flex flex-col truncate">
                                        <p>{{ $new->title_en ?? '' }}</p>
                                        <p>{{ $new->title_kh ?? '' }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-xs max-w-[200px] border-r border-[#4FC9EE]">
                                    <div class="flex flex-col">
                                        <div class="prose line-clamp-1">
                                            {!! $new->content_en ?? '' !!}
                                        </div>
                                        <div class="prose line-clamp-1">
                                            {!! $new->content_kh ?? '' !!}
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-xs border-r border-[#4FC9EE]">
                                    <div class="flex items-center space-x-1">
                                        <a href="{{ route('news_backend.delete', $new->id) }}" title="Delete"
                                            onclick="event.preventDefault(); deleteRecord('{{ route('news_backend.delete', $new->id) }}')">
                                            <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('news_backend.edit', $new->id) }}" title="Edit">
                                            <svg class="w-6 h-6 text-green-500 hover:text-green-700 transition"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
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
    </div>
@endsection
