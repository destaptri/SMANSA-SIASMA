<style>
    .custom-pagination {
    list-style: none;
    display: flex;
    justify-content: center;
    padding: 0;
}

.custom-pagination li {
    margin: 0 5px;
}

.custom-pagination li a,
.custom-pagination li span {
    display: inline-block;
    padding: 8px 12px;
    color: #062A61;
    text-decoration: none;
}

.custom-pagination li a:hover {
    background-color: #f0f0f0;
}

.custom-pagination li.active span {
    background-color: #062A61;
    color: #fff;
    border-color: #062A61;
}

.custom-pagination li.disabled span {
    color: #aaa;
    border-color: #ddd;
    cursor: not-allowed;
}

</style>
@if ($paginator->hasPages())
    <nav>
        <ul class="custom-pagination">
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&lsaquo;</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a></li>
            @endif

            {{-- Elemen pagination --}}
            @foreach ($elements as $element)
                {{-- Jika elemen adalah string (misalnya "…") --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Jika elemen berupa array dari link --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a></li>
            @else
                <li class="disabled"><span>&rsaquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
