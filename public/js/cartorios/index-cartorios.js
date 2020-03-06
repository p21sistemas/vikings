function validar() 
{
    $('#carregando').show();
}

function abrirInputFileModal() 
{
    $('#inputFileModalLong').modal('show');    
}

function importDataXML()
{
    $('#carregando').show();
    $('#formSearchCartorio').attr('action', top.urlDestroyContact + '/import-data-xml');
    $("#formSearchCartorio").submit();
}

function exportDataXML()
{
    // $('#carregando').show();
    $('#formSearchCartorio').attr('action', top.urlDestroyContact + '/export-data-excel');
    $("#formSearchCartorio").submit();
}

function searchCartorios()
{
    $("#formSearchContact").submit();
}

function confirmDestroy(id)
{
    top.id = id;
    Componentes.modalConfirmacao('Tem certeza que deseja excluir este contato?', destroyContact);
}

function destroyContact()
{
    $('#carregando').show();
    $('#formSearchCartorio').attr('action', top.urlDestroyContact + '/' + top.id);
    $("#_method").val('DELETE');
    $("#formSearchCartorio").submit();
}
