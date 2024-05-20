@if($item->lastPage() > 1)

    @if ($item->onFirstPage())
        <span title="Página 1">&lsaquo;&lsaquo;</span>&nbsp;&nbsp;
    @else
        <a href="{{ paginacao(1) }}" title="Página 1">&lsaquo;&lsaquo;</a>&nbsp;&nbsp;
    @endif

    @if ($item->currentPage() > 1)
        <a href="{{ paginacao($item->currentPage() - 1) }}" title="Página 1">&lsaquo;</a>&nbsp;&nbsp;
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
            {{-- @if(
                $item->currentPage() > 3 &&
                $i <= $item->lastPage() - 2
            ) --}}
                <select class="text-center" data-url="{{ paginacao(0) }}" id="combo_paginacao">
                    @for($k = 1 ; $k <= $item->lastPage(); $k++)
                        <option value="{{ $k }}" @if($i == $k) selected @endif>{{ $k }}</option>
                    @endfor
                </select>&nbsp;&nbsp;
            {{-- @else
                <span title="Página {{ $i }}" class="active">{{ $i }}</span>&nbsp;&nbsp;
            @endif --}}
        @else
            <a href="{{ paginacao($i) }}" title="Página {{ $i }}">{{ $i }}</a>&nbsp;&nbsp;
        @endif
    @endfor


    @if ($item->hasMorePages())
        &nbsp;&nbsp;<a href="{{ paginacao($item->currentPage()+1) }}">&rsaquo;</a>
    @endif

    @if ($item->onLastPage())
        &nbsp;&nbsp;<span title="Página {{ $item->lastPage() }}">&rsaquo;&rsaquo;</span>
    @else
        &nbsp;&nbsp;<a href="{{ paginacao($item->lastPage()) }}" title="Página {{ $item->lastPage() }}">&rsaquo;&rsaquo;</a>
    @endif
@endif

@if($item->count() > 0)
    <br>
    <strong style="font-weight: normal">
    @if($item->count() == 1)
        Exibindo 1-1 de 1.
    @else
        Exibindo {{ $item->firstItem() }}-{{ $item->lastItem() }} de {{ $item->total() }}.
    @endif
    </strong>
@endif
