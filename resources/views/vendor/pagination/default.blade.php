@push('styles')
<style>
    /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 40px;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            background: white;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-btn:hover {
            background: #f3f4f6;
        }

        .page-btn.active {
            background: #dc2626;
            color: white;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
</style>
@endpush
@if ($paginator->hasPages())
    <nav>
        <div class="pagination">
            {{-- Previous Page Button --}}
            @if ($paginator->onFirstPage())
                <button class="page-btn" disabled aria-label="@lang('pagination.previous')">&lsaquo;</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <button class="page-btn">&lsaquo;</button>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <button class="page-btn" disabled>{{ $element }}</button>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="page-btn active" aria-current="page">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}">
                                <button class="page-btn">{{ $page }}</button>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <button class="page-btn">&rsaquo;</button>
                </a>
            @else
                <button class="page-btn" disabled aria-label="@lang('pagination.next')">&rsaquo;</button>
            @endif
        </div>
    </nav>
@endif
