@if ($paginator->hasPages())
    <div class="join">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="join-item btn btn-disabled">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        @else
            <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $paginator->previousPageUrl() }}">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <button class="join-item btn btn-disabled">{{ $element }}</button>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="join-item btn border-red-600 bg-red-600 text-white hover:border-red-700 hover:bg-red-700">{{ $page }}</button>
                    @else
                        <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $paginator->nextPageUrl() }}">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <button class="join-item btn btn-disabled">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @endif
    </div>

    {{-- Page Info --}}
    <div class="mt-4 text-center text-sm text-gray-600">
        Hiển thị {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} trong tổng số {{ $paginator->total() }} kết quả
    </div>
@endif
