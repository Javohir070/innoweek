@if ($paginator->hasPages())
<div class="pagination-area">
    <ul class="pagination">
       {{-- Previous Page Link --}}
       @if ($paginator->onFirstPage())
       <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <a class="page-link" href="#">
                <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
            </a>    
        </li>
        @else
        <li class="page-item" rel="prev" aria-label="@lang('pagination.previous')">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
            </a>
        </li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled page-item" aria-disabled="true"><a class="page-link" href="#">{{ $element }}</a></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="disabled page-item active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="disabled page-link" href="#" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                </a>
            </li>
        @endif
    </ul>
</div>
@endif
