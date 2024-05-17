<div class="row">
    <div class="body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>USUÁRIO</th>
                    <th>LOGIN</th>
                    <th>UF</th>
                    <th>TELEFONE</th>
                    <th class="text-center">STATUS</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if($usuarios->isEmpty())
                    <tr>
                        <td colspan="6" class="font-bold col-pink text-center">
                            Nenhum usuário encontrado com esta forma de busca.
                        </td>
                    </tr>
                @else
                    @foreach($usuarios as $item)
                    <tr>
                        <td scope="row" class="vertical-align-middle">{{ $item->nome }}</td>
                        <td class="vertical-align-middle">{{ $item->email }}</td>
                        <td class="vertical-align-middle">{{ $item->uf }}</td>
                        <td class="vertical-align-middle">{{ $item->telefone }}</td>
                        <td class="text-center vertical-align-middle">
                            @if($item->ativo)
                                <span class="text-success">
                                    <i class="material-icons">toggle_on</i>
                                </span>
                            @else
                                <span class="text-danger">
                                    <i class="material-icons">toggle_off</i>
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info waves-effect modalUsuario"
                                data-toggle="modal"
                                data-target="#largeModal"
                                data-acao="atualizar"
                                data-id="{{ $item->id }}"
                                data-nome="{{ $item->nome }}"
                                data-email="{{ $item->email }}"
                                data-uf="{{ $item->uf }}"
                                data-telefone="{{ $item->telefone }}"
                                data-administrador="{{ $item->administrador }}"
                                data-ativo="{{ $item->ativo }}"
                            >
                                <i class="material-icons">visibility</i>
                                <span>VISUALIZAR</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" class="paginate text-center">
                        @include( 'sgo.inc.paginacao', ['item' => $usuarios])
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
