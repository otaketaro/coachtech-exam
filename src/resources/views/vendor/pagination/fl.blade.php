@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation">
    <ul class="fl-pager">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
        <li class="fl-pager__arrow is-disabled"><span>&laquo;</span></li>
        @else
        <li class="fl-pager__arrow">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        </li>
        @endif

        {{-- Numbers --}}
        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="fl-pager__sep"><span>{{ $element }}</span></li>
        @endif
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="fl-pager__num is-current"><span>{{ $page }}</span></li>
        @else
        <li class="fl-pager__num"><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
        <li class="fl-pager__arrow">
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        </li>
        @else
        <li class="fl-pager__arrow is-disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</nav>
@endif