@extends('layouts.app')

@section('content')
@php
$name_email_psq = "";
$totalPage = 25;
@endphp
@if (isset($data))
    @php
    $name_email_psq = $data['name_email_psq'];
    $totalPage = $data['totalPage'];
    @endphp
@endif
<script>
    top.urlDestroyContact = "{{ url('/cartorios/') }}";
</script>
<script type="text/javascript" src="{{ asset('/js/cartorios/index-cartorios.js') }}"></script>
<style>
    .uper {
        margin-top: 40px;
    }
</style>

<div class="content-wrapper">

    <div class="card uper">

        <div class="card-header">
            <b>Lista de Cartórios</b>
            <a href="{{ url('/cartorios/create') }}" class="float-right" onclick="return validar()">
                <i class="fa fa-plus"></i> Adicionar Cartório
            </a>
            <a href="#" class="float-right" onclick="exportDataXML()">
                <i class="fa fa-arrow-circle-up"></i> Exportar Excel |&nbsp;
            </a>
            <a href="#" class="float-right" onclick="abrirInputFileModal()">
                <i class="fa fa-arrow-circle-down"></i> Importar XML |&nbsp;
            </a>
        </div>

        <div class="card-body">

            @if(count($errors))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Ops!</strong> Houve alguns problemas com seus campos.<br/>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @if(session()->get('success'))
            <div class="alert alert-success">
                <b>{{ session()->get('success') }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            @endif

            <form id="formSearchCartorio" class="form-horizontal" role="form" 
                method="POST" action="{{ route('cartorios.search') }}" enctype="multipart/form-data">
                <input type="hidden" id="_method" name="_method" value="">
                @csrf

                @include('cartorios.modals.input-file-modal')

                <div class="form-group row">
                    <div class="col-md-10" id="divFormNameEmail">
                        <label for="name_email_psq" class="control-label">Nome, Documento ou E-mail :</label>
                        <input type="text" id="name_email_psq" name="name_email_psq" 
                                class="form-control" value="{{ $name_email_psq }}" 
                                placeholder="Informe Nome, Documento ou Email do Cartório" autofocus>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"
                                onclick="return validar();" style="margin-top: 30px; width: 100%;">
                            <i class="fa fa-btn fa-search"></i> Procurar
                        </button>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td><b>Cadastrado em</b></td>
                                    <td><b>Nome</b></td>
                                    <td><b>Documento</b></td>
                                    <td><b>Cidade</b></td>
                                    <td><b>UF</b></td>
                                    <td><b>Email</b></td>
                                    <td><b>Telefone</b></td>
                                    <td><b>Tabelião</b></td>
                                    <td><b>Ativo</b></td>
                                    <td><b>Ação</b></td>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($cartorios) > 0)

                                @foreach($cartorios as $cartorio)
                                <tr>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($cartorio->created_at)) }}</td>
                                    <td>{{ limitaCaracteres($cartorio->cartorio_nome, 75) }}</td>
                                    <td>{{ $cartorio->cartorio_documento }}</td>
                                    <td>{{ $cartorio->cartorio_cidade }}</td>
                                    <td>{{ $cartorio->cartorio_uf }}</td>
                                    <td>{{ $cartorio->cartorio_email }}</td>
                                    <td>{{ $cartorio->cartorio_telefone }}</td>
                                    <td>{{ $cartorio->cartorio_tabeliao }}</td>
                                    <td>{{ $cartorio->cartorio_status != "" ? "SIM" : "NÃO" }}</td>
                                    <td>
                                        <a href="{{ route('cartorios.edit', $cartorio->id) }}" onclick="return validar()">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="10">Nenhum registro encontrado!</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>

                @if (isset($data))
                <div class="form-group row">
                    <div class="col-md-2">
                        Registros por página :
                        <input id="totalPage" name="totalPage" type="text" value="{{ $totalPage }}" 
                        class="form-control" size="10" style="text-align: right;" onblur="searchCartorios()">
                    </div>
                    <div class="col-md-10">
                        <div style="margin-top: 23px;">{{  $cartorios->appends($data)->links() }}</div>
                    </div>
                </div>
                @else
                <div class="form-group row">
                    <div class="col-md-2">
                        Registros por página :
                        <input id="totalPage" name="totalPage" type="text" value="{{ $totalPage }}" 
                        class="form-control" size="10" style="text-align: right;" onblur="searchCartorios()">
                    </div>
                    <div class="col-md-10">
                        <div style="margin-top: 23px;">{{ $cartorios->links() }}</div>
                    </div>
                </div>
                @endif

            </form>

        </div>
    </div>

</div>

@endsection
