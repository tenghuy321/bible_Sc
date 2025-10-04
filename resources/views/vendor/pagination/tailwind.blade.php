@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center mt-6 space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded-lg bg-[#4FC9EE] text-gray-500 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="#fff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 12l10 0" />
                    <path d="M4 12l4 4" />
                    <path d="M4 12l4 -4" />
                    <path d="M20 4l0 16" />
                </svg>


            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 rounded-lg bg-[#4FC9EE] text-white hover:bg-[#3dcaf5]">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="#fff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 12l10 0" />
                    <path d="M4 12l4 4" />
                    <path d="M4 12l4 -4" />
                    <path d="M20 4l0 16" />
                </svg>

            </a>
        @endif

        {{-- Pagination Elements --}}
        @php
            $start = max($paginator->currentPage() - 2, 1);
            $end = min($start + 4, $paginator->lastPage());

            if ($end - $start < 4) {
                $start = max($end - 4, 1);
            }
        @endphp

        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}"
                class="px-3 py-1 rounded-lg bg-gray-300 hover:bg-[#4FC9EE] hover:text-white">1</a>
            @if ($start > 2)
                <span class="px-2">...</span>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $paginator->currentPage())
                <span class="px-3 py-1 rounded-lg bg-[#4FC9EE] text-white">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}"
                    class="px-3 py-1 rounded-lg bg-gray-300 hover:bg-[#4FC9EE] hover:text-white">{{ $i }}</a>
            @endif
        @endfor

        @if ($end < $paginator->lastPage())
            @if ($end < $paginator->lastPage() - 1)
                <span class="px-2">...</span>
            @endif
            <a href="{{ $paginator->url($paginator->lastPage()) }}"
                class="px-3 py-1 rounded-lg bg-gray-300 hover:bg-[#4FC9EE] hover:text-white">{{ $paginator->lastPage() }}</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-1 rounded-lg bg-[#4FC9EE] text-white hover:bg-[#3dcaf5]">

                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="#fff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 12l-10 0" />
                    <path d="M20 12l-4 4" />
                    <path d="M20 12l-4 -4" />
                    <path d="M4 4l0 16" />
                </svg>

            </a>
        @else
            <span class="px-3 py-1 rounded-lg bg-[#4FC9EE] text-gray-500 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="#fff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 12l-10 0" />
                    <path d="M20 12l-4 4" />
                    <path d="M20 12l-4 -4" />
                    <path d="M4 4l0 16" />
                </svg>

            </span>
        @endif
    </nav>
@endif
