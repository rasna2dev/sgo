@if($item->lastPage() > 1)

    @if ($item->onFirstPage())
        <span title="Página 1">&lsaquo;&lsaquo;</span>&nbsp;&nbsp;
    @else
        <a href="{{ $item->url(1) }}" title="Página 1">&lsaquo;&lsaquo;</a>&nbsp;&nbsp;
    @endif

    @if ($item->currentPage() > 1)
        <a href="{{ $item->previousPageUrl() }}" title="Página 1">&lsaquo;</a>&nbsp;&nbsp;
    @endif

    {{-- &brvbar; --}}
    &nbsp;&nbsp;


    @php
        $ini = 1;
        $fim = 1;
        if($item->lastPage() == 2) {
            $ini = 1;
            $fim = 2;
        } elseif($item->lastPage() == 3) {
            $ini = 1;
            $fim = 3;
        } elseif($item->lastPage() > 3) {
            if($item->currentPage() <= 3) {
                $ini = 1;
                $fim = 3;
            } elseif($item->currentPage() == $item->lastPage()) {
                $ini = $item->lastPage() - 2;
                $fim = $item->lastPage();
            } else {
                $ini = $item->currentPage() - 1;
                $fim = $item->currentPage() + 1;
            }
        }
    @endphp

    @for($i = $ini; $i <= $fim; $i++)
        @if($i == $item->currentPage())
            <span title="Página {{ $i }}" class="active">{{ $i }}</span>&nbsp;&nbsp;
        @else
            <a href="{{ $item->url($i) }}" title="Página {{ $i }}">{{ $i }}</a>&nbsp;&nbsp;
        @endif
    @endfor


    {{-- &brvbar; --}}


    @if ($item->hasMorePages())
        &nbsp;&nbsp;<a href="{{ $item->nextPageUrl() }}">&rsaquo;</a>
    @endif

    @if ($item->onLastPage())
        &nbsp;&nbsp;<span title="Página {{ $item->lastPage() }}">&rsaquo;&rsaquo;</span>
    @else
        &nbsp;&nbsp;<a href="{{ $item->url($item->lastPage()) }}" title="Página {{ $item->lastPage() }}">&rsaquo;&rsaquo;</a>
    @endif
@endif

@if($item->count() > 0)
    <br>
    <strong style="font-weight: normal">
    @if($item->count() == 1)
        Exibindo registro de 1 a 1 de um total de 1.
    @else
        Exibindo registros de {{ $item->firstItem() }} a
        {{ $item->lastItem(); }} de um total de
        {{ $item->total() }}.
    @endif
    </strong>
@endif
