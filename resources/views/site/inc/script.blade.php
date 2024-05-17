<script>
    var url = "{{ url('') }}";
    @if(isset($req->busca_estado) && $req->busca_estado > 0)
        var busca_estado_id = {!! $req->busca_estado!!};
    @else
        var busca_estado_id = 0;
    @endif

    @if(isset($req->busca_cidade) && $req->busca_cidade > 0)
        var busca_cidade_id = {!! $req->busca_cidade !!};
    @else
        var busca_cidade_id = 0;
    @endif

    @if(isset($req->busca_bairro) && $req->busca_bairro > 0)
        var busca_bairro_id = {!! $req->busca_bairro !!};
    @else
        var busca_bairro_id = 0;
    @endif
</script>
<script src="{{ url('js/site.min.js') }}"></script>
