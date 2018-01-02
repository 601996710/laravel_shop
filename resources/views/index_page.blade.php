

@if ($paginator->hasPages())


    <div class="posts-nav">

        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a class='page-numbers' href='{{ $paginator->previousPageUrl() }}' style="width: auto">上一页</a>
        @endif
            <span class='page-numbers current' >{{$paginator->currentPage()}}</span>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class='page-numbers ' href='{{ $paginator->nextPageUrl() }}' style="width: auto">下一页</a>

        @endif

    </div>
@endif
